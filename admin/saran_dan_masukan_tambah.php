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
    
    $nama_lengkap  = htmlspecialchars($purifier->purify($_POST['xnama_lengkap']));
    $email         = $_POST['xemail'];
    $perihal       = htmlspecialchars($purifier->purify($_POST['xperihal']));
    $status_dibaca = $_POST['xstatus_dibaca'] ?? 0;
    $pesan         = htmlspecialchars($purifier->purify($_POST['xpesan']));

    $stmt = mysqli_stmt_init($connection);
    $query = 
        "INSERT INTO tbl_saran_dan_masukan
        (
            nama_lengkap
            , email
            , perihal
            , status_dibaca
            , pesan
        )
        VALUES (?, ?, ?, ?, ?)";

    mysqli_stmt_prepare($stmt, $query);
    mysqli_stmt_bind_param($stmt, 'sssis', $nama_lengkap, $email, $perihal, $status_dibaca, $pesan);

    $insert = mysqli_stmt_execute($stmt);

    !$insert
        ? $_SESSION['msg'] = 'other_error'
        : $_SESSION['msg'] = 'save_success';

    mysqli_stmt_close($stmt);
    mysqli_close($connection);

    echo "<meta http-equiv='refresh' content='0;saran_dan_masukan.php?go=saran_dan_masukan'>";
?>