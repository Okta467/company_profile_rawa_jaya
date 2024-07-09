<?php
    include_once 'config/connection.php';
    
    $nik = $_POST['nik'];

    if (!$nik) {
        echo json_encode(array());
        mysqli_close($connection);
        return;
    }

    $stmt = mysqli_stmt_init($connection);
    $query = 
    "SELECT
        a.id AS id_penduduk, a.nik, a.nama_lengkap, a.jk, a.tmp_lahir, a.tgl_lahir, a.warga_negara, a.agama, a.pekerjaan, a.alamat, a.email, a.status_validasi AS status_validasi_penduduk, a.keterangan_validasi AS keterangan_validasi_penduduk,
        b.id AS id_surat_keramaian, b.perihal, b.status_pengajuan, b.keterangan_pengajuan, b.created_at AS tgl_pengajuan
    FROM tbl_penduduk AS a
    LEFT JOIN tbl_surat_keramaian AS b
        ON a.id = b.id_penduduk
    WHERE a.nik=?";

    mysqli_stmt_prepare($stmt, $query);
    mysqli_stmt_bind_param($stmt, 'i', $nik);
    mysqli_stmt_execute($stmt);

	$result = mysqli_stmt_get_result($stmt);

    $surat_keramaians = !$result
        ? array()
        : mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_stmt_close($stmt);
    mysqli_close($connection);

    echo json_encode($surat_keramaians);
    return;
?>