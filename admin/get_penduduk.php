<?php
    include_once '../helpers/isAccessAllowedHelper.php';

    // cek apakah user yang mengakses adalah admin?
    if (!isAccessAllowed('admin')) {
        session_destroy();
        echo "<meta http-equiv='refresh' content='0;" . base_url_return('index.php?msg=other_error') . "'>";
        return;
    }

    include_once '../config/connection.php';

    $id_penduduk = $_POST['id_penduduk'];
    
    $stmt = mysqli_stmt_init($connection);
    $query = 
        "SELECT
            a.id AS id_penduduk, a.nik, a.nama_lengkap, a.jk, a.tmp_lahir, a.tgl_lahir, a.warga_negara, a.agama, a.pekerjaan, a.alamat, a.email, a.status_validasi, a.keterangan_validasi,
            b.id AS id_kartu_keluarga, b.nomor_kk, b.nik_kepala_keluarga
        FROM tbl_penduduk AS a
        LEFT JOIN tbl_kartu_keluarga AS b
            ON b.id = a.id_kartu_keluarga
        WHERE a.id=?";

    mysqli_stmt_prepare($stmt, $query);
    mysqli_stmt_bind_param($stmt, 'i', $id_penduduk);
    mysqli_stmt_execute($stmt);

	$result = mysqli_stmt_get_result($stmt);

    $penduduks = !$result
        ? array()
        : mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_stmt_close($stmt);
    mysqli_close($connection);

    echo json_encode($penduduks);

?>