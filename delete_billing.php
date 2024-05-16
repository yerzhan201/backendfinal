<?php
session_start();
require_once 'db_config.php';

if(!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

if(isset($_POST['BillingID'])) {
    $login = $_SESSION['user']['Login'];
    $BillingID = $_POST['BillingID'];

    $sql = "DELETE FROM P2Billing WHERE BillingID = :BillingID AND Login = :login";
    $stmt = $pdo->prepare($sql);
    
    $stmt->execute(['BillingID' => $BillingID, 'login' => $login]); 

    echo "Billing address deleted successfully.";
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Billing Address</title>
</head>
<body>
    <h2>Delete Billing Address</h2>
    <form method="post" action="billing.php">
        <label for="BillingID">Billing ID:</label><br>
        <input type="text" id="BillingID" name="BillingID" required><br>
        <label for="BillName">Name:</label><br>
        <input type="text" id="BillName" name="BillName" required><br>
        <label for="BillAddress">Address:</label><br>
        <input type="text" id="BillAddress" name="BillAddress" required><br>
        <label for="BillCity">City:</label><br>
        <input type="text" id="BillCity" name="BillCity" required><br>
        <label for="BillState">State:</label><br>
        <input type="text" id="BillState" name="BillState" required><br>
        <label for="BillZip">Zip:</label><br>
        <input type="text" id="BillZip" name="BillZip" required><br>
        <label for="CardType">Card Type:</label><br>
        <select id="CardType" name="CardType">
            <option value="Visa">Visa</option>
            <option value="MasterCard">MasterCard</option>
            <option value="Discover">Discover</option>
            <option value="American Express">American Express</option>
        </select><br>
        <label for="CardNumber">Card Number:</label><br>
        <input type="text" id="CardNumber" name="CardNumber" required><br>
        <label for="ExpDate">Expiration Date:</label><br>
        <input type="text" id="ExpDate" name="ExpDate" required><br>
        <input type="submit" value="Add Address">
    <a href="account.php">Back to Account</a><br>
    <a href="shipping.php">Manage Shipping Addresses</a>
</body>
</html>