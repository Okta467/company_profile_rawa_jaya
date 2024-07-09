<?php
    include_once 'config/connection.php';
    
    $stmt = mysqli_stmt_init($connection);
    $query = 
        "SELECT
            a.id AS id_penduduk, a.nama_lengkap, a.jk, a.warga_negara, a.agama, a.pekerjaan, a.alamat, a.email, a.status_validasi, a.keterangan_validasi,
            c.id AS id_dokumen_ktp, c.status_pengajuan, c.keterangan_pengajuan, c.created_at AS tgl_pengajuan
        FROM tbl_penduduk AS a
        LEFT JOIN tbl_dokumen_ktp AS c
            ON a.id = c.id_penduduk
        ORDER BY c.id DESC";

    mysqli_stmt_prepare($stmt, $query);
    mysqli_stmt_execute($stmt);

	$result = mysqli_stmt_get_result($stmt);

    $dokumen_ktpss['data'] = !$result
        ? array()
        : mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_stmt_close($stmt);
    mysqli_close($connection);

    echo json_encode($dokumen_ktpss);
    return;
?>