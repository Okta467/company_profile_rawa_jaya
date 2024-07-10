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
    
    $id_kartu_keluarga    = $_POST['xid_kartu_keluarga'];
    $status_pengajuan     = $_POST['xstatus_pengajuan'];
    $is_status_pengajuan  = in_array($status_pengajuan, ['belum_diproses', 'sudah_diproses']);
    $keterangan_pengajuan = htmlspecialchars($purifier->purify($_POST['xketerangan_pengajuan']));

    $stmt = mysqli_stmt_init($connection);

    mysqli_stmt_prepare($stmt, "INSERT INTO tbl_dokumen_kk (id_kartu_keluarga, status_pengajuan, keterangan_pengajuan) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt, 'iss', $id_kartu_keluarga, $status_pengajuan, $keterangan_pengajuan);

    $insert = mysqli_stmt_execute($stmt);

    !$insert
        ? $_SESSION['msg'] = mysqli_stmt_error($stmt)
        : $_SESSION['msg'] = 'save_success';

    mysqli_stmt_close($stmt);
    mysqli_close($connection);

    echo "<meta http-equiv='refresh' content='0;dokumen_kk.php?go=dokumen_kk'>";
?>