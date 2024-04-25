<?php 
require 'database.php';

$message = '';

if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $sql = "INSERT INTO users (email, password) VALUES (:email, :password)"; 
    $stmt = $conn->prepare($sql); // Agregué el punto y coma que falta al final de la línea
    $stmt->bindParam(':email', $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $password); // Quité el espacio en blanco antes de ':password'

    if ($stmt->execute()) {
        $message = 'Successfully created new user';
    } else {
        $message = 'Sorry there must have been an issue creating your account'; // Corregí errores de ortografía y agregué punto y coma al final de la línea
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>SignUp</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jacquard+12+Charted&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<?php require 'partials/header.php'?>

<?php if(!empty($message)): ?>
    <p><?php echo $message ?></p> <!-- Añadí "echo" para mostrar el mensaje correctamente -->
<?php endif; ?>

<h1>SignUp</h1>
<span>or <a href="login.php">Login</a></span>
<form action="signup.php" method="post">
    <input type="text" name="email" placeholder="Enter your mail">
    <input type="password" name="password" placeholder="Enter your password">
    <input type="password" name="confirm_password" placeholder="Confirm your password"> <!-- Corregí el texto "Comfirm" a "Confirm" -->

    <input type="submit" value="Send">
</form>
</body>
</html>
