<?php
    /**
     * Get all penduduk with 
     * id_kartu_keluarga IS NULL
     * AND nik_kepala_keluarga IS NULL
     */
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
        "SELECT a.nama_lengkap, a.nik, b.nik_kepala_keluarga
        FROM tbl_penduduk AS a
        LEFT JOIN tbl_kartu_keluarga AS b
            ON a.nik = b.nik_kepala_keluarga
        WHERE a.id_kartu_keluarga IS NULL AND b.nik_kepala_keluarga IS NULL";

    mysqli_stmt_prepare($stmt, $query);
    mysqli_stmt_execute($stmt);

	$result = mysqli_stmt_get_result($stmt);

    $penduduks = !$result
        ? array()
        : mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_stmt_close($stmt);
    mysqli_close($connection);

    echo json_encode($penduduks);

?>