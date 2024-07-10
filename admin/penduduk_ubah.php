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
    
    $id_penduduk         = $_POST['xid_penduduk'];
    $id_kartu_keluarga   = $_POST['xid_kartu_keluarga'] !== '' ? $_POST['xid_kartu_keluarga'] : null;
    $nik                 = $_POST['xnik'];
    $nama_lengkap        = htmlspecialchars($purifier->purify($_POST['xnama_lengkap']));
    $jk                  = $_POST['xjk'];
    $tmp_lahir           = htmlspecialchars($purifier->purify($_POST['xtmp_lahir']));
    $tgl_lahir           = $_POST['xtgl_lahir'];
    $warga_negara        = $_POST['xwarga_negara'];
    $agama               = $_POST['xagama'];
    $pekerjaan           = htmlspecialchars($purifier->purify($_POST['xpekerjaan']));
    $alamat              = htmlspecialchars($purifier->purify($_POST['xalamat']));
    $email               = $_POST['xemail'];
    $status_validasi     = $_POST['xstatus_validasi'];
    $keterangan_validasi = htmlspecialchars($purifier->purify($_POST['xketerangan_validasi']));

    $is_allowed_agama = $agama && in_array($agama, ['islam', 'kristen_protestan', 'kristen_katolik', 'hindu', 'buddha', 'konghucu', 'lainnya']);

    if (!$is_allowed_agama) {
        $_SESSION['msg'] = 'Agama tidak ada pada daftar!';
        echo "<meta http-equiv='refresh' content='0;penduduk.php?go=penduduk'>";
        return;
    }

    $is_allowed_status_validasi = $status_validasi && in_array($status_validasi, ['belum_divalidasi', 'sudah_divalidasi']);

    if (!$is_allowed_status_validasi) {
        $_SESSION['msg'] = 'Status validasi tidak ada pada daftar!';
        echo "<meta http-equiv='refresh' content='0;penduduk.php?go=penduduk'>";
        return;
    }

    $stmt = mysqli_stmt_init($connection);
    $query = "UPDATE tbl_penduduk SET
        id_kartu_keluarga=?
        , nik=?
        , nama_lengkap=?
        , jk=?
        , tmp_lahir=?
        , tgl_lahir=?
        , warga_negara=?
        , agama=?
        , pekerjaan=?
        , alamat=?
        , email=?
        , status_validasi=?
        , keterangan_validasi=?
    WHERE id=?";

    mysqli_stmt_prepare($stmt, $query);
    mysqli_stmt_bind_param($stmt, 'sisssssssssssi', $id_kartu_keluarga, $nik, $nama_lengkap, $jk, $tmp_lahir, $tgl_lahir, $warga_negara, $agama, $pekerjaan, $alamat, $email, $status_validasi, $keterangan_validasi, $id_penduduk);

    $update = mysqli_stmt_execute($stmt);

    !$update
        ? $_SESSION['msg'] = mysqli_stmt_error($stmt)
        : $_SESSION['msg'] = 'update_success';

    mysqli_stmt_close($stmt);
    mysqli_close($connection);

    echo "<meta http-equiv='refresh' content='0;penduduk.php?go=penduduk'>";
?>