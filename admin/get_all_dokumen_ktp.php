<?php
    include_once '../helpers/isAccessAllowedHelper.php';

    // cek apakah user yang mengakses adalah admin?
    if (!isAccessAllowed('admin')) {
        session_destroy();
        echo "<meta http-equiv='refresh' content='0;" . base_url_return('index.php?msg=other_error') . "'>";
        return;
    }

    include_once '../config/connection.php';
    
    $stmt = mysqli_stmt_init($connection);
    $query = 
    $query = 
        "SELECT
            a.id AS id_dokumen_ktp, a.status_pengajuan, a.keterangan_pengajuan, a.created_at AS tgl_pengajuan,
            b.id AS id_penduduk, b.nik, b.nama_lengkap, b.jk, b.tmp_lahir, b.tgl_lahir, b.warga_negara, b.agama, b.pekerjaan, b.alamat, b.email, b.status_validasi, b.keterangan_validasi
        FROM tbl_dokumen_ktp AS a
        INNER JOIN tbl_penduduk AS b
            ON b.id = a.id_penduduk
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