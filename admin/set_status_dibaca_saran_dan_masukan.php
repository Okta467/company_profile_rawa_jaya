<?php
    include_once '../helpers/isAccessAllowedHelper.php';

    // cek apakah user yang mengakses adalah admin?
    if (!isAccessAllowed('admin')) {
        session_destroy();
        echo "<meta http-equiv='refresh' content='0;" . base_url_return('index.php?msg=other_error') . "'>";
        return;
    }

    include_once '../config/connection.php';
    
    $id_saran_dan_masukan = $_POST['id_saran_dan_masukan'];
    $status_dibaca = $_POST['status_dibaca'] ?? 0;

    $stmt = mysqli_stmt_init($connection);
    $query = "UPDATE tbl_saran_dan_masukan SET status_dibaca=? WHERE id=?";

    mysqli_stmt_prepare($stmt, $query);
    mysqli_stmt_bind_param($stmt, 'ii', $status_dibaca, $id_saran_dan_masukan);

    $success = mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);
    mysqli_close($connection);

    echo json_encode($success);

?>