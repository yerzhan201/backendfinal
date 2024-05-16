<?php
session_start();
require_once 'db_config.php';

if(isset($_POST['login']) && isset($_POST['passwd'])) {
    $login = $_POST['login'];
    $passwd = $_POST['passwd'];

    $sql = "SELECT * FROM P2User WHERE Login = :login AND Passwd = :passwd";
    $stmt = $pdo->prepare($sql);
    
    $stmt->execute(['login' => $login, 'passwd' => $passwd]); 
    $user = $stmt->fetch();

    if($user) {
        $_SESSION['user'] = $user;
        header("Location: account.php");
        exit;
    } else {
        echo "Invalid login or password.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <form method="post" action="login.php">
        <label for="login">Login:</label><br>
        <input type="text" id="login" name="login" required><br>
        <label for="passwd">Password:</label><br>
        <input type="password" id="passwd" name="passwd" required><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
