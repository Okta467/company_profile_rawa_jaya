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
    
    $id_proyek     = $_POST['xid_proyek'];
    $nama_proyek   = htmlspecialchars($purifier->purify($_POST['xnama_proyek']));
    $tujuan        = htmlspecialchars($purifier->purify($_POST['xtujuan']));
    $manfaat       = htmlspecialchars($purifier->purify($_POST['xmanfaat']));
    $tahapan       = str_replace('`', '\`', $purifier->purify($_POST['xtahapan']));
    $detail        = str_replace('`', '\`', $purifier->purify($_POST['xdetail']));
    $status_proyek = $_POST['xstatus_proyek'];
    $tgl_proyek    = $_POST['xtgl_proyek'];

    $stmt = mysqli_stmt_init($connection);
    $query = 
        "UPDATE tbl_proyek SET
            nama_proyek=?
            , tujuan=?
            , manfaat=?
            , tahapan=?
            , detail=?
            , status_proyek=?
            , tgl_proyek=?
        WHERE id=?";

    mysqli_stmt_prepare($stmt, $query);
    mysqli_stmt_bind_param($stmt, 'sssssssi', $nama_proyek, $tujuan, $manfaat, $tahapan, $detail, $status_proyek, $tgl_proyek, $id_proyek);

    $insert = mysqli_stmt_execute($stmt);

    !$insert
        ? $_SESSION['msg'] = 'other_error'
        : $_SESSION['msg'] = 'update_success';

    mysqli_stmt_close($stmt);
    mysqli_close($connection);

    echo "<meta http-equiv='refresh' content='0;proyek.php?go=proyek'>";
?>