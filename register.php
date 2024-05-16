<?php
require_once 'db_config.php';

if(isset($_POST['login']) && isset($_POST['passwd']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['newsletter'])) {
    $login = $_POST['login'];
    $passwd = $_POST['passwd'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $newsletter = $_POST['newsletter'];

    $sql = "INSERT INTO P2User (Login, Passwd, FirstName, LastName, Email, NewsLetter) VALUES (:login, :passwd, :firstname, :lastname, :email, :newsletter)";
    $stmt = $pdo->prepare($sql);
    
    $stmt->execute(['login' => $login, 'passwd' => $passwd, 'firstname' => $firstname, 'lastname' => $lastname, 'email' => $email, 'newsletter' => $newsletter]); 

    echo "User registered successfully.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <form method="post" action="register.php">
        <label for="login">Login:</label><br>
        <input type="text" id="login" name="login" required><br>
        <label for="passwd">Password:</label><br>
        <input type="password" id="passwd" name="passwd" required><br>
        <label for="firstname">First Name:</label><br>
        <input type="text" id="firstname" name="firstname" required><br>
        <label for="lastname">Last Name:</label><br>
        <input type="text" id="lastname" name="lastname" required><br>
        <label for="email">Email:</label><br>
        <input type="text" id="email" name="email" required><br>
        <label for="newsletter">Newsletter:</label><br>
        <input type="radio" id="yes" name="newsletter" value="Yes">
        <label for="yes">Yes</label><br>
        <input type="radio" id="no" name="newsletter" value="No">
        <label for="no">No</label><br>
        <input type="submit" value="Register">
    </form>
</body>
</html>
