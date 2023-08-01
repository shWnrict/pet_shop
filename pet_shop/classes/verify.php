<?php

//include the database connection file
include_once 'DBConnection.php';

//get the email and activation code from the query string
$email = $_GET['email'];
$activation_code = $_GET['activation_code'];

//check the activation code in the database
$sql = "SELECT * FROM `clients` where `email` = '{$email}' and `activation_code` = '{$activation_code}'";
$result = $conn->query($sql);

//if the activation code is valid, activate the user's account
if($result->num_rows > 0){
    $row = $result->fetch_assoc();
    $id = $row['id'];

    //activate the user's account
    $sql = "UPDATE `clients` set `activation_code` = NULL, `active` = 1 where `id` = '{$id}'";
    $conn->query($sql);

    //redirect the user to the home page
    header('Location: /');
}else{
    //the activation code is invalid
    echo "Invalid activation code.";
}

?>
