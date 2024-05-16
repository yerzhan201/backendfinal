<?php
session_start();
require_once 'db_config.php';

if(!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

if(isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['passwd']) && isset($_POST['email']) && isset($_POST['newsletter'])) {
    $login = $_SESSION['user']['Login'];
    $passwd = $_POST['passwd'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $newsletter = $_POST['newsletter'];

    $sql = "UPDATE P2User SET Passwd = :passwd, FirstName = :firstname, LastName = :lastname, Email = :email, NewsLetter = :newsletter WHERE Login = :login";
    $stmt = $pdo->prepare($sql);
    
    $stmt->execute(['login' => $login, 'passwd' => $passwd, 'firstname' => $firstname, 'lastname' => $lastname, 'email' => $email, 'newsletter' => $newsletter]); 

    echo "User information updated successfully.";
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Account</title>
</head>
<body>
    <h2>User Information</h2>
    <form method="post" action="account.php">
        <label for="login">Login:</label><br>
        <input type="text" id="login" name="login" value="<?php echo $user['Login']; ?>" disabled><br>
        <label for="passwd">Password:</label><br>
        <input type="password" id="passwd" name="passwd" value="<?php echo $user['Passwd']; ?>" required><br>
        <label for="firstname">First Name:</label><br>
        <input type="text" id="firstname" name="firstname" value="<?php echo $user['FirstName']; ?>" required><br>
        <label for="lastname">Last Name:</label><br>
        <input type="text" id="lastname" name="lastname" value="<?php echo $user['LastName']; ?>" required><br>
        <label for="email">Email:</label><br>
        <input type="text" id="email" name="email" value="<?php echo $user['Email']; ?>" required><br>
        <label for="newsletter">Newsletter:</label><br>
        <input type="radio" id="yes" name="newsletter" value="Yes" <?php if($user['NewsLetter'] == 'Yes') echo 'checked'; ?>>
        <label for="yes">Yes</label><br>
        <input type="radio" id="no" name="newsletter" value="No" <?php if($user['NewsLetter'] == 'No') echo 'checked'; ?>>
        <label for="no">No</label><br>
        <input type="submit" value="Update">
    </form>
    <a href="shipping.php">Manage Shipping Addresses</a><br>
    <a href="billing.php">Manage Billing Addresses</a>
</body>
</html>
