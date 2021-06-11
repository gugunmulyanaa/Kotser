<?php
$conn = mysqli_connect('10.20.30.118', 'c46diskominfo', 'bpkad@123.', 'c16bpkadv2');
$query = mysqli_query($conn, 'SELECT post.id_post, title, seotitle, picture, date FROM `post` JOIN post_description ON post.id_post = post_description.id_post ORDER BY id_post DESC LIMIT 1');
$row = mysqli_fetch_assoc($query);
echo json_encode($row);
