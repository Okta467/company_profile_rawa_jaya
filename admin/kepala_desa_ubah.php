<?php
    include_once '../helpers/isAccessAllowedHelper.php';

    // cek apakah user yang mengakses adalah admin?
    if (!isAccessAllowed('admin')) {
        session_destroy();
        echo "<meta http-equiv='refresh' content='0;" . base_url_return('index.php?msg=other_error') . "'>";
        return;
    }

    require_once '../vendor/htmlpurifier/HTMLPurifier.auto.php';
    include_once '../config/connection.php';

    // to sanitize user input
    $config   = HTMLPurifier_Config::createDefault();
    $purifier = new HTMLPurifier($config);
    
    $id_kepala_desa      = $_POST['xid_kepala_desa'];
    $id_pengguna         = $_POST['xid_pengguna'];
    $nip                 = $_POST['xnip'];
    $nama_kepala_desa    = htmlspecialchars($purifier->purify($_POST['xnama_kepala_desa']));
    $username            = $nip;
    $password            = $_POST['xpassword'] ? password_hash($_POST['xpassword'], PASSWORD_DEFAULT) : null;
    $hak_akses           = 'kepala_desa';
    $jk                  = $_POST['xjk'];
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
        // Kepala Desa statement preparation and execution
        $stmt_kepala_desa  = mysqli_stmt_init($connection);
        $query_kepala_desa = "UPDATE tbl_kepala_desa SET
            id_pangkat_golongan = ?
            , id_pendidikan = ?
            , id_jurusan_pendidikan = ?
            , nip = ?
            , nama_kepala_desa = ?
            , jk = ?
            , alamat = ?
            , tmp_lahir = ?
            , tgl_lahir = ?
            , tahun_ijazah = ?
        WHERE id = ?";
        
        if (!mysqli_stmt_prepare($stmt_kepala_desa, $query_kepala_desa)) {
            $_SESSION['msg'] = 'Statement Kepala Desa preparation failed: ' . mysqli_stmt_error($stmt_kepala_desa);
            echo "<meta http-equiv='refresh' content='0;kepala_desa.php?go=kepala_desa'>";
            return;
        }
        
        mysqli_stmt_bind_param($stmt_kepala_desa, 'iiiisssssii', $id_pangkat_golongan, $id_pendidikan, $id_jurusan, $nip, $nama_kepala_desa, $jk, $alamat, $tmp_lahir, $tgl_lahir, $tahun_ijazah, $id_kepala_desa);
        
        if (!mysqli_stmt_execute($stmt_kepala_desa)) {
            $_SESSION['msg'] = 'Statement Kepala Desa preparation failed: ' . mysqli_stmt_error($stmt_kepala_desa);
            echo "<meta http-equiv='refresh' content='0;kepala_desa.php?go=kepala_desa'>";
            return;
        }

        // Pengguna statement preparation and execution
        $stmt_pengguna  = mysqli_stmt_init($connection);
        $query_pengguna = !$password
            ? "UPDATE tbl_pengguna SET username=?, hak_akses=? WHERE id=?"
            : "UPDATE tbl_pengguna SET username=?, hak_akses=?, password=? WHERE id=?";
        
        if (!mysqli_stmt_prepare($stmt_pengguna, $query_pengguna)) {
            $_SESSION['msg'] = 'Statement Pengguna preparation failed: ' . mysqli_stmt_error($stmt_pengguna);
            echo "<meta http-equiv='refresh' content='0;kepala_desa.php?go=kepala_desa'>";
            return;
        }
        
        !$password
            ? mysqli_stmt_bind_param($stmt_pengguna, 'ssi', $username, $hak_akses, $id_pengguna)
            : mysqli_stmt_bind_param($stmt_pengguna, 'sssi', $username, $hak_akses, $password, $id_pengguna);
        
        if (!mysqli_stmt_execute($stmt_pengguna)) {
            $_SESSION['msg'] = 'Statement Pengguna preparation failed: ' . mysqli_stmt_error($stmt_pengguna);
            echo "<meta http-equiv='refresh' content='0;kepala_desa.php?go=kepala_desa'>";
            return;
        }

        // Commit the transaction if all statements succeed
        if (!mysqli_commit($connection)) {
            $_SESSION['msg'] = 'Transaction commit failed: ' . mysqli_stmt_error($stmt_pengguna);
            echo "<meta http-equiv='refresh' content='0;kepala_desa.php?go=kepala_desa'>";
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
    mysqli_stmt_close($stmt_pengguna);

    // Turn autocommit mode back on
    mysqli_autocommit($connection, true);

    // Close the connection
    mysqli_close($connection);

    echo "<meta http-equiv='refresh' content='0;kepala_desa.php?go=kepala_desa'>";
?>
