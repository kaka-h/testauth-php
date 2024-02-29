<?php

    include "service/database.php";
    session_start();

    $register_message = "";
    if (isset ($_SESSION['isLogin'])) {
        header ("Location: dashboard.php");
    }

        
    if (isset($_POST['register'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
    
        // Pengecekan apakah username dan password tidak kosong
        if (empty($username) || empty($password)) {
            $register_message = "Username dan Password Tidak Boleh Kosong";
        } else {
            $hash_password = hash("sha256", $password);
    
            try {
                $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hash_password')";
    
                if ($db->query($sql)) {
                    $register_message = "Register Berhasil, Silahkan Login";
                } else {
                    $register_message = "Register Gagal, Coba Lagi";
                }
            } catch (mysqli_sql_exception $e) {
                // Tangkap kesalahan yang disebabkan oleh SQL
                if ($e->getCode() === "23000") { // Ini kode untuk kesalahan duplikasi entri (tergantung pada database)
                    $register_message = "Username sudah digunakan";
                } else {
                    $register_message = "Error: " . $e->getMessage();
                }
            }
        }
        $db->close();
    }
    
?>    


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php include "layout/header.html" ?>

    <h3>Register Akun</h3>
    <form action="register.php" method='POST'>
        <p><?= $register_message ?></p>
        <input type="text" placeholder='username' name='username' >
        <input type="password" placeholder='password' name='password' >
        <button type='Submit' name='register'>Daftar Sekarang</button>
    </form>

    <?php include "layout/footer.html" ?>
</body>
</html>