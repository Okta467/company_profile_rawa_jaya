<?php
    include_once 'config/connection.php';
    require_once 'vendor/htmlpurifier/HTMLPurifier.auto.php';

    // to sanitize user input
    $config   = HTMLPurifier_Config::createDefault();
    $purifier = new HTMLPurifier($config);
    
    $nik = htmlspecialchars($purifier->purify($_POST['nik']));
    
    if (!$nik) {
        echo json_encode(array());
        mysqli_close($connection);
        return;
    }

    $stmt1 = mysqli_stmt_init($connection);
    $query = 
        "SELECT
            a.id AS id_penduduk, a.nik, a.nama_lengkap, a.jk, a.tmp_lahir, a.tgl_lahir, a.warga_negara, a.agama, a.pekerjaan, a.alamat, a.email, a.status_validasi, a.keterangan_validasi,
            c.id AS id_dokumen_ktp, c.status_pengajuan, c.keterangan_pengajuan, c.created_at AS tgl_pengajuan
        FROM tbl_penduduk AS a
        LEFT JOIN tbl_dokumen_ktp AS c
            ON a.id = c.id_penduduk
        WHERE a.nik=?";

    mysqli_stmt_prepare($stmt1, $query);
    mysqli_stmt_bind_param($stmt1, 'i', $nik);
    mysqli_stmt_execute($stmt1);

	$result = mysqli_stmt_get_result($stmt1);

    $dokumen_ktps = !$result
        ? array()
        : mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_stmt_close($stmt1);
    mysqli_close($connection);

    echo json_encode($dokumen_ktps);
    return;
?>