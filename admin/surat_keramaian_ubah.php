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
    
    $id_surat_keramaian   = $_POST['xid_surat_keramaian'];
    $id_penduduk          = $_POST['xid_penduduk'];
    $perihal              = $_POST['xperihal'];
    $status_pengajuan     = $_POST['xstatus_pengajuan'];
    $is_status_pengajuan  = in_array($status_pengajuan, ['belum_diproses', 'sudah_diproses']);
    $keterangan_pengajuan = htmlspecialchars($purifier->purify($_POST['xketerangan_pengajuan']));

    if (!$is_status_pengajuan) {
        $_SESSION['msg'] = 'Status pengajuan tidak ada pada daftar!';
        echo "<meta http-equiv='refresh' content='0;surat_keramaian.php?go=surat_keramaian'>";
        return;
    }
    
    $stmt = mysqli_stmt_init($connection);

    mysqli_stmt_prepare($stmt, "UPDATE tbl_surat_keramaian SET id_penduduk=?, perihal=?, status_pengajuan=?, keterangan_pengajuan=? WHERE id=?");
    mysqli_stmt_bind_param($stmt, 'isssi', $id_penduduk, $perihal, $status_pengajuan, $keterangan_pengajuan, $id_surat_keramaian);

    $update = mysqli_stmt_execute($stmt);

    !$update
        ? $_SESSION['msg'] = mysqli_stmt_error($stmt)
        : $_SESSION['msg'] = 'update_success';

    mysqli_stmt_close($stmt);
    mysqli_close($connection);

    echo "<meta http-equiv='refresh' content='0;surat_keramaian.php?go=surat_keramaian'>";
?>