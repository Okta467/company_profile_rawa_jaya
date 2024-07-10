<?php
    include_once 'config/connection.php';
    require_once 'vendor/htmlpurifier/HTMLPurifier.auto.php';

    // to sanitize user input
    $config   = HTMLPurifier_Config::createDefault();
    $purifier = new HTMLPurifier($config);
    
    $nomor_kk = htmlspecialchars($purifier->purify($_POST['nomor_kk']));

    if (!$nomor_kk) {
        echo json_encode(array());
        mysqli_close($connection);
        return;
    }

    $stmt1 = mysqli_stmt_init($connection);
    $query = 
        "SELECT
            a.id AS id_kartu_keluarga, a.nomor_kk, a.nik_kepala_keluarga,
            b.id AS id_penduduk, b.nik, b.nama_lengkap, b.jk, b.tmp_lahir, b.tgl_lahir, b.warga_negara, b.agama, b.pekerjaan, b.alamat, b.email, b.status_validasi AS status_validasi_penduduk, b.keterangan_validasi AS keterangan_validasi_penduduk,
            c.id AS id_dokumen_kk, c.status_pengajuan, c.keterangan_pengajuan, c.created_at AS tgl_pengajuan
        FROM tbl_kartu_keluarga AS a
        LEFT JOIN tbl_penduduk AS b
            ON b.nik = a.nik_kepala_keluarga
        LEFT JOIN tbl_dokumen_kk AS c
            ON a.id = c.id_kartu_keluarga
        WHERE a.nomor_kk=?";

    mysqli_stmt_prepare($stmt1, $query);
    mysqli_stmt_bind_param($stmt1, 'i', $nomor_kk);
    mysqli_stmt_execute($stmt1);

	$result = mysqli_stmt_get_result($stmt1);

    $dokumen_kks = !$result
        ? array()
        : mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_stmt_close($stmt1);
    mysqli_close($connection);

    echo json_encode($dokumen_kks);
    return;
?>