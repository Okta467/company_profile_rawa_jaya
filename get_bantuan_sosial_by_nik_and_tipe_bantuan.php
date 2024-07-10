<?php
    include_once 'config/connection.php';
    require_once 'vendor/htmlpurifier/HTMLPurifier.auto.php';

    // to sanitize user input
    $config   = HTMLPurifier_Config::createDefault();
    $purifier = new HTMLPurifier($config);
    
    $nik = htmlspecialchars($purifier->purify($_POST['nik']));
    $tipe_bantuan = htmlspecialchars($purifier->purify($_POST['tipe_bantuan']));
    
    if (!$nik || !$tipe_bantuan) {
        echo json_encode(array());
        mysqli_close($connection);
        return;
    }

    $stmt = mysqli_stmt_init($connection);
    $query =
        "SELECT
            a.id AS id_penduduk, a.nik, a.nama_lengkap, a.jk, a.tmp_lahir, a.tgl_lahir, a.warga_negara, a.agama, a.pekerjaan, a.alamat, a.email, a.status_validasi AS status_validasi_penduduk, a.keterangan_validasi AS keterangan_validasi_penduduk,
            b.id AS id_kartu_keluarga, b.nomor_kk, b.nik_kepala_keluarga,
            c.id AS id_bantuan_sosial, c.tipe_bantuan, c.status_pengajuan, c.keterangan_pengajuan, c.created_at AS tgl_pengajuan
        FROM tbl_penduduk AS a
        LEFT JOIN tbl_kartu_keluarga AS b
            ON b.id = a.id_kartu_keluarga
        LEFT JOIN tbl_bantuan_sosial AS c
            ON a.id = c.id_penduduk
        WHERE a.nik=? AND c.tipe_bantuan=?";

    mysqli_stmt_prepare($stmt, $query);
    mysqli_stmt_bind_param($stmt, 'is', $nik, $tipe_bantuan);
    mysqli_stmt_execute($stmt);

	$result = mysqli_stmt_get_result($stmt);

    $bantuan_sosials = !$result
        ? array()
        : mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_stmt_close($stmt);
    mysqli_close($connection);

    echo json_encode($bantuan_sosials);
    return;
?>