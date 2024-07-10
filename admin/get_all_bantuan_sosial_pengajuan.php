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
        "SELECT
        a.id AS id_bantuan_sosial, a.tipe_bantuan, a.status_pengajuan, a.keterangan_pengajuan, a.created_at AS tgl_pengajuan,
        b.id AS id_penduduk, b.nik, b.nama_lengkap, b.jk, b.tmp_lahir, b.tgl_lahir, b.warga_negara, b.agama, b.pekerjaan, b.alamat, b.email, b.status_validasi, b.keterangan_validasi,
        c.id AS id_kartu_keluarga, c.nomor_kk, c.nik_kepala_keluarga
        FROM tbl_bantuan_sosial AS a
        LEFT JOIN tbl_penduduk AS b
        ON b.id = a.id_penduduk
        LEFT JOIN tbl_kartu_keluarga AS c
        ON c.id = b.id_kartu_keluarga
        ORDER BY a.id DESC";

    mysqli_stmt_prepare($stmt, $query);
    mysqli_stmt_execute($stmt);

	$result = mysqli_stmt_get_result($stmt);

    $bantuan_sosials['data'] = !$result
        ? array()
        : mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_stmt_close($stmt);
    mysqli_close($connection);

    echo json_encode($bantuan_sosials);

?>