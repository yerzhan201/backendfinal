<?php
session_start();
require_once 'db_config.php';

if(!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

if(isset($_POST['ShippingID']) && isset($_POST['Name']) && isset($_POST['Address']) && isset($_POST['City']) && isset($_POST['State']) && isset($_POST['Zip'])) {
    $login = $_SESSION['user']['Login'];
    $ShippingID = $_POST['ShippingID'];
    $Name = $_POST['Name'];
    $Address = $_POST['Address'];
    $City = $_POST['City'];
    $State = $_POST['State'];
    $Zip = $_POST['Zip'];

    $sql = "INSERT INTO P2Shipping (ShippingID, Login, Name, Address, City, State, Zip) VALUES (:ShippingID, :login, :Name, :Address, :City, :State, :Zip)";
    $stmt = $pdo->prepare($sql);
    
    $stmt->execute(['ShippingID' => $ShippingID, 'login' => $login, 'Name' => $Name, 'Address' => $Address, 'City' => $City, 'State' => $State, 'Zip' => $Zip]); 

    echo "Shipping address added successfully.";
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Shipping</title>
</head>
<body>
    <h2>Add Shipping Address</h2>
    <form method="post" action="shipping.php">
        <label for="ShippingID">Shipping ID:</label><br>
        <input type="text" id="ShippingID" name="ShippingID" required><br>
        <label for="Name">Name:</label><br>
        <input type="text" id="Name" name="Name" required><br>
        <label for="Address">Address:</label><br>
        <input type="text" id="Address" name="Address" required><br>
        <label for="City">City:</label><br>
        <input type="text" id="City" name="City" required><br>
        <label for="State">State:</label><br>
        <input type="text" id="State" name="State" required><br>
        <label for="Zip">Zip:</label><br>
        <input type="text" id="Zip" name="Zip" required><br>
        <input type="submit" value="Add Address">
    </form>
    <a href="account.php">Back to Account</a><br>
    <a href="billing.php">Manage Billing Addresses</a>
</body>
</html>
