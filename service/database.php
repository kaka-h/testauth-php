<?php

$hostname = "localhost";
$username = "root";
$password = "";
$database_name = "testauth";

$db = mysqli_connect($hostname, $username, $password, $database_name);

if ($db -> connect_error) {
    echo "Koneksi Gagal";
    die('error!');
}

?>