<?php
	session_start();
	include_once 'config/connection.php';

	// cek apakah tombol submit ditekan
	if (!isset($_POST['xsubmit'])) {
		$_SESSION['msg'] = 'other_error';
		echo "<meta http-equiv='refresh' content='0;index.php'>";
		return;
	}
    
    require_once 'vendor/htmlpurifier/HTMLPurifier.auto.php';

    // to sanitize user input
    $config   = HTMLPurifier_Config::createDefault();
    $purifier = new HTMLPurifier($config);
    
    $nama_lengkap = htmlspecialchars($purifier->purify($_POST['xnama_lengkap']));
    $perihal = htmlspecialchars($purifier->purify($_POST['xperihal']));
    $email = $_POST['xemail'];
    $pesan = htmlspecialchars($purifier->purify($_POST['xpesan']));

    $stmt = mysqli_stmt_init($connection);

    mysqli_stmt_prepare($stmt, "INSERT INTO tbl_saran_dan_masukan (nama_lengkap, perihal, email, pesan) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, 'ssss', $nama_lengkap, $perihal, $email, $pesan);

    $insert = mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);
    mysqli_close($connection);
    
    echo json_encode($insert);
    return;
?>