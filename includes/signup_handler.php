<?php

require_once "../includes/autoload.php";
session_start();

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $username = htmlspecialchars($_POST["username"]);
    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);
    $confirmPassword = htmlspecialchars($_POST["confirmpassword"]);

    $user = new User();

    // errors
    $errors = [];
    if(empty($username)){
        $errors["username"] = "Username is empty";
    }elseif($user->getUser($username)){
        $errors["username"] = "Username already taken!";
    }
    if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors["email"] = "Email error";
    }
    // function to check valid password
    function isValidPassword($password) {
        if (preg_match('/[A-Z]/', $password) &&     // At least one uppercase letter
            preg_match('/[a-z]/', $password) &&     // At least one lowercase letter
            preg_match('/[0-9]/', $password) &&     // At least one digit
            preg_match('/[\W]/', $password) &&      // At least one special character
            strlen($password) >= 8) {               // At least 8 characters long
            return true;
        }
        return false;
    }


    if(empty($password)){
        $errors["password"] = "Password is empty";
    }
    elseif(!isValidPassword($password)){
        $errors["password"] = "Password must contain lower-case, upper-case, numeric and special character";
    }elseif($password != $confirmPassword){
        $errors["password"] = "Please confirm password";
    }

    if($errors){
        $_SESSION["errors"] = $errors;
        $_SESSION["data"] = $_POST;
        header("Location: ../signup.php");
        exit();
    }else{
        $options = [
            12
        ];
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT, $options);

        $user->createUser($username, $email, $hashedPassword);
        $_SESSION["user"] = $user->getUser($username);
        header("Location: ../signup.php?message=success");
        exit();

    }
}else{
    header("Location: ../signup.php");
}