<?php

    require_once "../includes/autoload.php";
    session_start();

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $username = $_POST["username"];
        $password = $_POST["password"];

        $errors = [];
        if(empty($username)){
            $errors["username"] = "Provide username!";
        }
        if(empty($password)){
            $errors["password"] = "Provide password!";
        }

            $user = new User();
            $userDetails = $user->getUser($username);
            if($userDetails){
                if(password_verify($password, $userDetails["pass_word"])){
                    $_SESSION["user"] = $userDetails;
                    header("Location: ../user/dashboard.php");
                    exit();
                }else{
                    $errors["username"] = "Username or password error. Note that passwords are case sensitve!";
                }
            }else{
                $errors["username"] = "Username not found!";
            }
        
        if($errors){
            $_SESSION["errors"] = $errors;
            header("Location: ../login.php");
            exit();
        }

    }else{
        header("Location: ../login.php");
    }
?>