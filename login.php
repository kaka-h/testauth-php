<?php
    include "service/database.php";
    session_start();

    $login_message = "";
    if (isset ($_SESSION['isLogin'])) {
        header ("Location: dashboard.php");
    }

    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $hash_password = hash("sha256", $password);

        $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$hash_password'";
        $result = $db -> query($sql);

        if ($result -> num_rows > 0) {
            $data = $result -> fetch_assoc();
            
            $_SESSION['username'] = $data['username'];
            $_SESSION['isLogin'] = true;
            header("Location: dashboard.php");
        } else {
            $login_message = "Akun Tidak Ditemukan, Coba Lagi";
    }

    $db -> close();
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

    <h3>Login Akun</h3>
    <form action="login.php" method='POST'>
        <p><?= $login_message ?></p>
        <input meth type="text" placeholder='username' name='username' >
        <input type="password" placeholder='password' name='password' >
        <button type='Submit' name='login'>Login</button>
    </form>

    <?php include "layout/footer.html"?>
</body>
</html>