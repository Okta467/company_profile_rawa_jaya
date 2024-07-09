<?php
	session_start();
	include_once 'config/connection.php';

	// cek apakah tombol submit ditekan sebelum memproses
	if (!isset($_POST['xsubmit'])) {
		$_SESSION['msg'] = 'other_error';
		echo "<meta http-equiv='refresh' content='0;dokumen_ktp.php'>";
		return;
	}

    require_once 'vendor/htmlpurifier/HTMLPurifier.auto.php';

    // to sanitize user input
    $config   = HTMLPurifier_Config::createDefault();
    $purifier = new HTMLPurifier($config);
    
    $nik = htmlspecialchars($purifier->purify($_POST['xnik_pengajuan_baru']));

    $stmt_penduduk = mysqli_stmt_init($connection);

    mysqli_stmt_prepare($stmt_penduduk, "SELECT id, nik FROM tbl_penduduk WHERE nik=?");
    mysqli_stmt_bind_param($stmt_penduduk, 'i', $nik);
    mysqli_stmt_execute($stmt_penduduk);

    $result = mysqli_stmt_get_result($stmt_penduduk);
    $penduduk = mysqli_fetch_assoc($result);

    if (!$penduduk) {
        $_SESSION['msg'] = 'NIK tidak ditemukan!';
        echo "<meta http-equiv='refresh' content='0;dokumen_ktp.php'>";
        return;
    }

    $stmt_insert = mysqli_stmt_init($connection);

    $id_penduduk = $penduduk['id'];
    $status_pengajuan = 'belum_diproses';

    mysqli_stmt_prepare($stmt_insert, "INSERT INTO tbl_dokumen_ktp (id_penduduk, status_pengajuan) VALUES (?, ?)");
    mysqli_stmt_bind_param($stmt_insert, 'is', $id_penduduk, $status_pengajuan);

    $insert = mysqli_stmt_execute($stmt_insert);

    !$insert
        ? $_SESSION['msg'] = mysqli_stmt_error($stmt_insert)
        : $_SESSION['msg'] = 'save_success';

    mysqli_stmt_close($stmt_penduduk);
    mysqli_stmt_close($stmt_insert);
    mysqli_close($connection);

    echo "<meta http-equiv='refresh' content='0;dokumen_ktp.php'>";
?>