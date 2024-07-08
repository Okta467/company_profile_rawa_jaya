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
    
    $id_kepala_desa       = $_POST['xid_kepala_desa'] ?? NULL;
    $username             = htmlspecialchars($purifier->purify($_POST['xusername']));
    $password             = password_hash($_POST['xpassword'], PASSWORD_DEFAULT);
    $is_allowed_hak_akses = in_array($_POST['xhak_akses'], ['kepala_desa', 'admin']); 
    $hak_akses            = $is_allowed_hak_akses ? $_POST['xhak_akses'] : NULL;

    if (!$is_allowed_hak_akses) {
        $_SESSION['msg'] = 'Hak akses yang diinput tidak diperbolehkan!';
        echo "<meta http-equiv='refresh' content='0;pengguna.php?go=pengguna'>";
        return;
    }

    mysqli_autocommit($connection, false);

    $success = true;
    
    if ($hak_akses === 'admin'):
        
        $stmt_pengguna = mysqli_stmt_init($connection);

        mysqli_stmt_prepare($stmt_pengguna, "INSERT INTO tbl_pengguna (username, password, hak_akses) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmt_pengguna, 'sss', $username, $password, $hak_akses);

        if (!mysqli_stmt_execute($stmt_pengguna)):
            $success = false;
            $_SESSION['msg'] = 'Statement Pengguna preparation failed: ' . mysqli_stmt_error($stmt_pengguna);
        endif;
    
    elseif ($hak_akses === 'kepala_desa'):

        $stmt_pengguna = mysqli_stmt_init($connection);

        mysqli_stmt_prepare($stmt_pengguna, "INSERT INTO tbl_pengguna (username, password, hak_akses) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmt_pengguna, 'sss', $username, $password, $hak_akses);

        if (!mysqli_stmt_execute($stmt_pengguna)):
            $success = false;
            $_SESSION['msg'] = 'Statement Pengguna preparation failed: ' . mysqli_stmt_error($stmt_pengguna);
        endif;

        $stmt_kepala_desa = mysqli_stmt_init($connection);
        $id_pengguna = mysqli_insert_id($connection);

        mysqli_stmt_prepare($stmt_kepala_desa, "UPDATE tbl_kepala_desa SET id_pengguna=? WHERE id=?");
        mysqli_stmt_bind_param($stmt_kepala_desa, 'ii', $id_pengguna, $id_kepala_desa);

        if (!mysqli_stmt_execute($stmt_kepala_desa)):
            $success = false;
            $_SESSION['msg'] = 'Statement Kepala Desa preparation failed: ' . mysqli_stmt_error($stmt_kepala_desa);
        endif;
    
    endif;
    
    !$success
        ? mysqli_rollback($connection)
        : mysqli_commit($connection);

    !$success
        ? ''
        : $_SESSION['msg'] = 'save_success';

    mysqli_stmt_close($stmt_pengguna);

    !isset($stmt_kepala_desa)
        ? ''
        : mysqli_stmt_close($stmt_kepala_desa);

    mysqli_autocommit($connection, true);
    
    mysqli_close($connection);

    echo "<meta http-equiv='refresh' content='0;pengguna.php?go=pengguna'>";
?>