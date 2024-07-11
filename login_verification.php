<?php
	session_start();
	include_once 'config/connection.php';

	// cek apakah tombol submit ditekan sebelum memproses verifikasi login
	if (!isset($_POST['xsubmit'])) {
		$_SESSION['msg'] = 'other_error';
		echo "<meta http-equiv='refresh' content='0;login.php'>";
		return;
	}

	$username = $_POST['xusername'];
	$password = $_POST['xpassword'];


	// jalankan mysql prepare statement untuk mencegah SQL Inject
	$stmt = mysqli_stmt_init($connection);

	mysqli_stmt_prepare($stmt, "SELECT * FROM tbl_pengguna WHERE username=?");
	mysqli_stmt_bind_param($stmt, 's', $username);
	mysqli_stmt_execute($stmt);

	$result = mysqli_stmt_get_result($stmt);
	$user   = mysqli_fetch_assoc($result);

	mysqli_stmt_close($stmt);


	// redirect ke halaman login jika pengguna tidak ditemukan
	if (!$user) {
		$_SESSION['msg'] = 'user_not_found';
		echo "<meta http-equiv='refresh' content='0;login.php'>";
		return;
	}

	// cek apakah passwordnya benar?
	if (!password_verify($password, $user['password'])) {
		$_SESSION['msg'] = 'wrong_password';
		echo "<meta http-equiv='refresh' content='0;login.php'>";
		return;
	}

    // Get id_kepala_desa if hak akses is kepala_desa
    if ($user['hak_akses'] === 'kepala_desa') {
        $query_kepala_desa = mysqli_query($connection, "SELECT id, nama_kepala_desa FROM tbl_kepala_desa WHERE id_pengguna = {$user['id']} LIMIT 1");
        $kepala_desa = mysqli_fetch_assoc($query_kepala_desa);
    }

	// set sesi user sekarang
	$_SESSION['id_pengguna']      = $user['id'];
	$_SESSION['id_kepala_desa']   = $kepala_desa['id'] ?? null;
	$_SESSION['nama_kepala_desa'] = $kepala_desa['nama_kepala_desa'] ?? null;
	$_SESSION['username']         = $user['username'];
	$_SESSION['hak_akses']        = $user['hak_akses'];
	$_SESSION['email']            = $alumni['email'] ?? 'default_email@gmail.com';

	// Update last login user
	$last_login = date('Y-m-d H:i:s');
	$query_update = mysqli_query($connection, "UPDATE tbl_pengguna SET last_login = '{$last_login}' WHERE id = {$user['id']}");

	// alihkan user ke halamannya masing-masing
	switch ($user['hak_akses']) {
		case 'admin':
			header("location:admin?go=dashboard");
			break;

		case 'kepala_desa':
			header("location:kepala_desa/?go=dashboard");
			break;
		
		default:
			$_SESSION['msg'] = 'hak akses not found!';
			header("location:logout.php");
			break;
	}
?>