<?php

require_once "../includes/autoload.php";
session_start();

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $image = $_FILES["image"];
    $userID = $_SESSION["user"]["id"];

    // Handle image
    $image_name = $image["name"];
    $image_tmp_name = $image["tmp_name"];
    $upload_directory = 'cover_photos/'; // Define the upload directory

    // Ensure the upload directory exists
    if (!is_dir($upload_directory)) {
        mkdir($upload_directory, 0755, true);
    }

    // Clean up the file name
    $image_name = str_replace(' ', '_', $image_name); // Replace spaces with underscores
    $image_name = preg_replace('/[^A-Za-z0-9_\-\.]/', '', $image_name); // Remove special characters

    // Move the uploaded image to the desired folder
    $image_upload_path = $upload_directory . basename($image_name);
    move_uploaded_file($image_tmp_name, $image_upload_path);

    $title = htmlspecialchars($_POST["title"]);
    $edtailIintroduction = htmlspecialchars($_POST["details"]);

    $user = new User();
    if($user->getProfile($userID)){
        $user->updateProfile($userID, $image_upload_path, $title, $edtailIintroduction);
        header("Location: ../user/editintroduction.php?message=profileupdated");
    }else{
        $user->insertIintroduction($userID, $image_upload_path, $title, $edtailIintroduction);
        header("Location: ../user/editintroduction.php?message=profileupdated");
    }

}else{
    header("Location: ../user/editintroduction.php");
}