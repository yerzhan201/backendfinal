<?php
session_start();
require_once 'db_config.php';

if(!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

if(isset($_POST['BillingID']) && isset($_POST['BillName']) && isset($_POST['BillAddress']) && isset($_POST['BillCity']) && isset($_POST['BillState']) && isset($_POST['BillZip']) && isset($_POST['CardType']) && isset($_POST['CardNumber']) && isset($_POST['ExpDate'])) {
    $login = $_SESSION['user']['Login'];
    $BillingID = $_POST['BillingID'];
    $BillName = $_POST['BillName'];
    $BillAddress = $_POST['BillAddress'];
    $BillCity = $_POST['BillCity'];
    $BillState = $_POST['BillState'];
    $BillZip = $_POST['BillZip'];
    $CardType = $_POST['CardType'];
    $CardNumber = $_POST['CardNumber'];
    $ExpDate = $_POST['ExpDate'];

    $sql = "UPDATE P2Billing SET BillName = :BillName, BillAddress = :BillAddress, BillCity = :BillCity, BillState = :BillState, BillZip = :BillZip, CardType = :CardType, CardNumber = :CardNumber, ExpDate = :ExpDate WHERE BillingID = :BillingID AND Login = :login";
    $stmt = $pdo->prepare($sql);
    
    $stmt->execute(['BillingID' => $BillingID, 'login' => $login, 'BillName' => $BillName, 'BillAddress' => $BillAddress, 'BillCity' => $BillCity, 'BillState' => $BillState, 'BillZip' => $BillZip, 'CardType' => $CardType, 'CardNumber' => $CardNumber, 'ExpDate' => $ExpDate]); 

    echo "Billing address updated successfully.";
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Billing Address</title>
</head>
<body>
    <h2>Edit Billing Address</h2>
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
