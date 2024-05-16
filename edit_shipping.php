<?php
session_start();
require_once 'db_config.php';

if(!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$login = $_SESSION['user']['Login'];

if(isset($_POST['ShippingID']) && isset($_POST['Name']) && isset($_POST['Address']) && isset($_POST['City']) && isset($_POST['State']) && isset($_POST['Zip'])) {
    $ShippingID = $_POST['ShippingID'];
    $Name = $_POST['Name'];
    $Address = $_POST['Address'];
    $City = $_POST['City'];
    $State = $_POST['State'];
    $Zip = $_POST['Zip'];

    // Update operation
    if(isset($_POST['update'])) {
        $sql = "UPDATE P2Shipping SET Name = :Name, Address = :Address, City = :City, State = :State, Zip = :Zip WHERE ShippingID = :ShippingID AND Login = :login";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['ShippingID' => $ShippingID, 'login' => $login, 'Name' => $Name, 'Address' => $Address, 'City' => $City, 'State' => $State, 'Zip' => $Zip]);
        echo "Shipping address updated successfully.";
    }

    // Delete operation
    else if(isset($_POST['delete'])) {
        $sql = "DELETE FROM P2Shipping WHERE ShippingID = :ShippingID AND Login = :login";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['ShippingID' => $ShippingID, 'login' => $login]);
        echo "Shipping address deleted successfully.";
    }

    // Insert operation
    else {
        $sql = "INSERT INTO P2Shipping (ShippingID, Login, Name, Address, City, State, Zip) VALUES (:ShippingID, :login, :Name, :Address, :City, :State, :Zip)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['ShippingID' => $ShippingID, 'login' => $login, 'Name' => $Name, 'Address' => $Address, 'City' => $City, 'State' => $State, 'Zip' => $Zip]);
        echo "Shipping address added successfully.";
    }
}

$user = $_SESSION['user'];
?>
