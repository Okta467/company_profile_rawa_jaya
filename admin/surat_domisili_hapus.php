<?php
    include_once '../helpers/isAccessAllowedHelper.php';

    // cek apakah user yang mengakses adalah admin?
    if (!isAccessAllowed('admin')) {
        session_destroy();
        echo "<meta http-equiv='refresh' content='0;" . base_url_return('index.php?msg=other_error') . "'>";
        return;
    }

    include_once '../config/connection.php';
    
    $id_surat_domisili = $_GET['xid_surat_domisili'];

    $stmt = mysqli_stmt_init($connection);

    mysqli_stmt_prepare($stmt, "DELETE FROM tbl_surat_domisili WHERE id=?");
    mysqli_stmt_bind_param($stmt, 'i', $id_surat_domisili);

    $delete = mysqli_stmt_execute($stmt);

    !$delete
        ? $_SESSION['msg'] = mysqli_stmt_error($stmt)
        : $_SESSION['msg'] = 'delete_success';

    mysqli_stmt_close($stmt);
    mysqli_close($connection);

    echo "<meta http-equiv='refresh' content='0;surat_domisili.php?go=surat_domisili'>";
?>