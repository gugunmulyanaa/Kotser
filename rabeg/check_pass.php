<?php
    // konfigurasi database
    $host       =   "103.102.250.19";
    $user       =   "rabeg";
    $password   =   "1q2w3e4r";
    $database   =   "egov";
    // perintah php untuk akses ke database
    $koneksi = mysqli_connect($host, $user, $password, $database);

    if(isset($_POST["user_name"]) AND isset($_POST["pass_word"])){
        $username = mysqli_real_escape_string($koneksi, $_POST["user_name"]);
        $password = mysqli_real_escape_string($koneksi, $_POST["pass_word"]);
        $sql = "Select * FROM rbg_user_publik WHERE USERID = '$username' AND PASSWORD = '$password'";
        $result = mysqli_query($koneksi, $sql);
        echo mysqli_num_rows($result);
    }
?>