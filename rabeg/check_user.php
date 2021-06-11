<?php
    // konfigurasi database
    $host       =   "103.102.250.19";
    $user       =   "rabeg";
    $password   =   "1q2w3e4r";
    $database   =   "egov";
    // perintah php untuk akses ke database
    $koneksi = mysqli_connect($host, $user, $password, $database);

    if(isset($_POST["user_name"])){
        $username = mysqli_real_escape_string($koneksi, $_POST["user_name"]);
        $sql = "Select * FROM rbg_user_publik WHERE USERID = '".$username."'";
        $result = mysqli_query($koneksi, $sql);
        echo mysqli_num_rows($result);
    }

?>