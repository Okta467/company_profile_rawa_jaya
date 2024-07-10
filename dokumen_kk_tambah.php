<?php
	session_start();
	include_once 'config/connection.php';

	// cek apakah tombol submit ditekan sebelum memproses
	if (!isset($_POST['xsubmit'])) {
		$_SESSION['msg'] = 'other_error';
		echo "<meta http-equiv='refresh' content='0;dokumen_kk.php?go=administrasi'>";
		return;
	}

    require_once 'vendor/htmlpurifier/HTMLPurifier.auto.php';

    // to sanitize user input
    $config   = HTMLPurifier_Config::createDefault();
    $purifier = new HTMLPurifier($config);
    
    $nomor_kk = htmlspecialchars($purifier->purify($_POST['xnomor_kk']));

    $stmt_kartu_keluarga = mysqli_stmt_init($connection);

    mysqli_stmt_prepare($stmt_kartu_keluarga, "SELECT id, nomor_kk FROM tbl_kartu_keluarga WHERE nomor_kk=?");
    mysqli_stmt_bind_param($stmt_kartu_keluarga, 'i', $nomor_kk);
    mysqli_stmt_execute($stmt_kartu_keluarga);

    $result = mysqli_stmt_get_result($stmt_kartu_keluarga);
    $kartu_keluarga = mysqli_fetch_assoc($result);

    if (!$kartu_keluarga) {
        $_SESSION['msg'] = 'KK tidak ditemukan!';
        echo "<meta http-equiv='refresh' content='0;dokumen_kk.php?go=administrasi'>";
        return;
    }

    $stmt_insert = mysqli_stmt_init($connection);

    $id_kartu_keluarga = $kartu_keluarga['id'];
    $status_pengajuan = 'belum_diproses';

    mysqli_stmt_prepare($stmt_insert, "INSERT INTO tbl_dokumen_kk (id_kartu_keluarga, status_pengajuan) VALUES (?, ?)");
    mysqli_stmt_bind_param($stmt_insert, 'is', $id_kartu_keluarga, $status_pengajuan);

    $insert = mysqli_stmt_execute($stmt_insert);

    !$insert
        ? $_SESSION['msg'] = mysqli_stmt_error($stmt_insert)
        : $_SESSION['msg'] = 'save_success';

    mysqli_stmt_close($stmt_kartu_keluarga);
    mysqli_stmt_close($stmt_insert);
    mysqli_close($connection);

    echo "<meta http-equiv='refresh' content='0;dokumen_kk.php?go=administrasi'>";
?>