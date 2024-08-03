<?php
    include_once '../helpers/isAccessAllowedHelper.php';

    // cek apakah user yang mengakses adalah kepala_desa?
    if (!isAccessAllowed('kepala_desa')) {
        session_destroy();
        echo "<meta http-equiv='refresh' content='0;" . base_url_return('index.php?msg=other_error') . "'>";
        return;
    }

    require_once '../vendor/htmlpurifier/HTMLPurifier.auto.php';
    include_once '../config/connection.php';

    // to sanitize user input
    $config   = HTMLPurifier_Config::createDefault();
    $purifier = new HTMLPurifier($config);
    
    $id_kepala_desa      = $_SESSION['id_kepala_desa'];
    $id_pengguna         = $_SESSION['id_pengguna'];
    $password            = $_POST['xpassword'] ? password_hash($_POST['xpassword'], PASSWORD_DEFAULT) : null;
    $alamat              = htmlspecialchars($purifier->purify($_POST['xalamat']));
    $tmp_lahir           = htmlspecialchars($purifier->purify($_POST['xtmp_lahir']));
    $tgl_lahir           = $_POST['xtgl_lahir'];
    $tahun_ijazah        = $_POST['xtahun_ijazah'];
    $id_pangkat_golongan = $_POST['xid_pangkat_golongan'];
    $id_pendidikan       = $_POST['xid_pendidikan'];
    $id_jurusan          = $_POST['xid_jurusan'] ?? null;

    // Turn off autocommit mode
    mysqli_autocommit($connection, false);

    // Initialize the success flag
    $success = true;

    // Begin the transaction
    try {
        // Pegawai statement preparation and execution
        $stmt_kepala_desa  = mysqli_stmt_init($connection);
        $query_kepala_desa = "UPDATE tbl_kepala_desa SET
            id_pangkat_golongan = ?
            , id_pendidikan = ?
            , id_jurusan_pendidikan = ?
            , alamat = ?
            , tmp_lahir = ?
            , tgl_lahir = ?
            , tahun_ijazah = ?
        WHERE id = ?";
        
        if (!mysqli_stmt_prepare($stmt_kepala_desa, $query_kepala_desa)) {
            $_SESSION['msg'] = 'Statement Pegawai preparation failed: ' . mysqli_stmt_error($stmt_kepala_desa);
            echo "<meta http-equiv='refresh' content='0;profil.php?go=profil'>";
            return;
        }
        
        mysqli_stmt_bind_param($stmt_kepala_desa, 'iiisssii', $id_pangkat_golongan, $id_pendidikan, $id_jurusan, $alamat, $tmp_lahir, $tgl_lahir, $tahun_ijazah, $id_kepala_desa);
        
        if (!mysqli_stmt_execute($stmt_kepala_desa)) {
            $_SESSION['msg'] = 'Statement Pegawai preparation failed: ' . mysqli_stmt_error($stmt_kepala_desa);
            echo "<meta http-equiv='refresh' content='0;profil.php?go=profil'>";
            return;
        }

        if ($password) {
            // Pengguna statement preparation and execution
            $stmt_pengguna  = mysqli_stmt_init($connection);
            $query_pengguna = "UPDATE tbl_pengguna SET password=? WHERE id=?";
            
            if (!mysqli_stmt_prepare($stmt_pengguna, $query_pengguna)) {
                $_SESSION['msg'] = 'Statement Pengguna preparation failed: ' . mysqli_stmt_error($stmt_pengguna);
                echo "<meta http-equiv='refresh' content='0;profil.php?go=profil'>";
                return;
            }
            
            mysqli_stmt_bind_param($stmt_pengguna, 'si', $password, $id_pengguna);
            
            if (!mysqli_stmt_execute($stmt_pengguna)) {
                $_SESSION['msg'] = 'Statement Pengguna preparation failed: ' . mysqli_stmt_error($stmt_pengguna);
                echo "<meta http-equiv='refresh' content='0;profil.php?go=profil'>";
                return;
            }
        }

        // Commit the transaction if all statements succeed
        if (!mysqli_commit($connection)) {
            $_SESSION['msg'] = 'Transaction commit failed: ' . mysqli_stmt_error($stmt_pengguna);
            echo "<meta http-equiv='refresh' content='0;profil.php?go=profil'>";
            return;
        }

    } catch (Exception $e) {
        // Roll back the transaction if any statement fails
        $success = false;
        mysqli_rollback($connection);
        $_SESSION['msg'] = 'Transaction failed: ' . $e->getMessage();
    }

    !$success
        ? ''
        : $_SESSION['msg'] = 'save_success';

    // Close the statements
    mysqli_stmt_close($stmt_kepala_desa);

    !$password
        ? ''
        : mysqli_stmt_close($stmt_pengguna);

    // Turn autocommit mode back on
    mysqli_autocommit($connection, true);

    // Close the connection
    mysqli_close($connection);

    echo "<meta http-equiv='refresh' content='0;profil.php?go=profil'>";
?>
