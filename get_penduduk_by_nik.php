<?php
    include_once 'config/connection.php';
    
    $nik = $_POST['nik'];

    $stmt1 = mysqli_stmt_init($connection);
    $query = 
    "SELECT
        a.id AS id_penduduk, a.nik, a.nama_lengkap, a.jk, a.tmp_lahir, a.tgl_lahir, a.warga_negara, a.agama, a.pekerjaan, a.alamat, a.email, a.status_validasi AS status_validasi_penduduk, a.keterangan_validasi AS keterangan_validasi_penduduk,
        b.id AS id_kartu_keluarga, b.nomor_kk, b.nik_kepala_keluarga
    FROM tbl_penduduk AS a
    LEFT JOIN tbl_kartu_keluarga AS b
        ON b.id = a.id_kartu_keluarga
    WHERE a.nik=?";

    mysqli_stmt_prepare($stmt1, $query);
    mysqli_stmt_bind_param($stmt1, 'i', $nik);
    mysqli_stmt_execute($stmt1);

	$result = mysqli_stmt_get_result($stmt1);

    $penduduks = !$result
        ? array()
        : mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_stmt_close($stmt1);
    mysqli_close($connection);

    echo json_encode($penduduks);
    return;
?>