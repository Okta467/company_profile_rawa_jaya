<?php
    include_once '../helpers/isAccessAllowedHelper.php';

    // cek apakah user yang mengakses adalah kepala_desa?
    if (!isAccessAllowed('kepala_desa')) {
        session_destroy();
        echo "<meta http-equiv='refresh' content='0;" . base_url_return('index.php?msg=other_error') . "'>";
        return;
    }

    include_once '../config/connection.php';
    
    $stmt = mysqli_stmt_init($connection);
    $query = 
        "SELECT
            a.id AS id_dokumen_kk, a.status_pengajuan, a.keterangan_pengajuan, a.created_at AS tgl_pengajuan,
            b.id AS id_kartu_keluarga, b.nomor_kk, b.nik_kepala_keluarga,
            c.id AS id_penduduk, c.nik, c.nama_lengkap, c.jk, c.tmp_lahir, c.tgl_lahir, c.warga_negara, c.agama, c.pekerjaan, c.alamat, c.email, c.status_validasi AS status_validasi, c.keterangan_validasi AS keterangan_validasi
        FROM tbl_dokumen_kk AS a
        INNER JOIN tbl_kartu_keluarga AS b
            ON b.id = a.id_kartu_keluarga
        LEFT JOIN tbl_penduduk AS c
            ON c.nik = b.nik_kepala_keluarga
        ORDER BY a.id DESC";

    mysqli_stmt_prepare($stmt, $query);
    mysqli_stmt_execute($stmt);

	$result = mysqli_stmt_get_result($stmt);

    $surat_keramaians['data'] = !$result
        ? array()
        : mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_stmt_close($stmt);
    mysqli_close($connection);

    echo json_encode($surat_keramaians);

?>