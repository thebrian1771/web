<?php 

session_start();

require 'database.php';

if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE id = :id'); // Corregí el nombre de la tabla a 'users'
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $user = $records->fetch(PDO::FETCH_ASSOC); // Cambié el nombre de la variable de $records a $user
}
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Welcome to Thebrian_tattoo</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Jacquard+12+Charted&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/style.css">
    </head>
    <body>

        <?php require 'partials/header.php'?>

        <?php if(!empty($user)): ?>
        <br>Welcome. <?= $user['email']?>
        <br>You are Successfully logged In
        <a href="logout.php">Logout</a>
        <?php else: ?> 


        <h1>Please Login or SignUp</h1>

        <a href="login.php">Login</a> or
        <a href="signup.php">SignUp</a>
        <?php endif; ?>
    </body>
</html>
