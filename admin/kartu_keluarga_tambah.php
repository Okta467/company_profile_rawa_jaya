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
    
    $nomor_kk = htmlspecialchars($purifier->purify($_POST['xnomor_kk']));
    $nik_kepala_keluarga = htmlspecialchars($purifier->purify($_POST['xnik_kepala_keluarga']));

    $stmt = mysqli_stmt_init($connection);

    mysqli_stmt_prepare($stmt, "INSERT INTO tbl_kartu_keluarga (nomor_kk, nik_kepala_keluarga) VALUES (?, ?)");
    mysqli_stmt_bind_param($stmt, 'ii', $nomor_kk, $nik_kepala_keluarga);

    $insert = mysqli_stmt_execute($stmt);

    !$insert
        ? $_SESSION['msg'] = mysqli_stmt_error($stmt)
        : $_SESSION['msg'] = 'save_success';

    mysqli_stmt_close($stmt);
    mysqli_close($connection);

    echo "<meta http-equiv='refresh' content='0;kartu_keluarga.php?go=kartu_keluarga'>";
?>