<?php
    // konfigurasi database
    $host       =   "103.102.250.19";
    $user       =   "rabeg";
    $password   =   "1q2w3e4r";
    $database   =   "egov";
    // perintah php untuk akses ke database
    $koneksi = mysqli_connect($host, $user, $password, $database);

    if(isset($_POST["user_name"]) != ""){
        $username = mysqli_real_escape_string($koneksi, $_POST["user_name"]);
        $judul = mysqli_real_escape_string($koneksi, $_POST["post_judul"]);
        $isi = mysqli_real_escape_string($koneksi, $_POST["post_isi"]);
        $kategori = mysqli_real_escape_string($koneksi, $_POST["post_kategori"]);
        $alamat = mysqli_real_escape_string($koneksi, $_POST["post_alamat"]);
        $tanggal = date("Y-m-d H:i:s");
        $sql = "INSERT INTO rbg_aduan (PELAPOR, TGL_ADUAN, KD_MEDIA, KD_KAT, JUDUL_ADUAN, ISI_ADUAN, 
                LOKASI) VALUES ('$username', '$tanggal', 'WEB', '$kategori', '$judul', '$isi', '$alamat')";
        if(mysqli_query($koneksi, $sql)){
            echo "Posting anda Berhasil. </br> Kami akan segera merespon postingan anda";
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($koneksi);
        }
    }

    // Close connection
    mysqli_close($koneksi);
?>