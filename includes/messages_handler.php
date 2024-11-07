<?php

session_start();
require_once "../includes/autoload.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $message = htmlspecialchars($_POST["message"]);
    $userID = htmlspecialchars($_GET["id"]);

    $errors = [];
    if(empty($name)){
        $errors["name_error"] = "Name not provided";
    }
    if(empty($email)){
        $errors["email_error"] = "Email not provided";
    }
    if(empty($message)){
        $errors["message_error"] = "Provide message content";
    }

    if(!empty($errors)){
        $_SESSION["errors"] = $errors;
        header("Location: ../profiles.php?id=$userID#contactform");
        exit();
    }else{
        $messages = new Messages();
        $messages->insertMessage($userID, $name, $email, $message);
    
        header("Location: ../profiles.php?id=$userID&message=success");
    }

} else {
    header("Location: ../profiles.php?id=$userID");
}
