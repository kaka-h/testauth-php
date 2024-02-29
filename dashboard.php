<?php 

    session_start();
    if (isset($_POST['logout'])) {
        session_destroy();
        session_unset();

        header("Location: register.php");
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

    <h3>Selamat Datang <?= $_SESSION["username"] ?> </h3>
    <p>Anda Sudah Login</p>

    <form method="POST" action="dashboard.php">
        <button type='submit' name='logout' >Logout</button>
    </form>

    <?php include "layout/footer.html" ?>
</body>
</html>