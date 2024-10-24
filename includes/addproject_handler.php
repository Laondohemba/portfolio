<?php

require_once "autoload.php";

if($_SERVER["REQUEST_METHOD"] === "POST"){
    
    $projectName = htmlspecialchars($_POST["name"]);
    $briefDescription = htmlspecialchars($_POST["brief_description"]);
    $projectDetails = htmlspecialchars($_POST["details"]);
    $image = $_FILES["project_image"];

    // Handle image
    $image_name = $image["name"];
    $image_tmp_name = $image["tmp_name"];
    $upload_directory = '../uploads/'; // Define the upload directory

    // Ensure the upload directory exists
    if (!is_dir($upload_directory)) {
        mkdir($upload_directory, 0755, true);
    }

    // Clean up the file name
    $image_name = str_replace(' ', '_', $image_name); // Replace spaces with underscores
    $image_name = preg_replace('/[^A-Za-z0-9_\-\.]/', '', $image_name); // Remove special characters

    // Move the uploaded image to the desired folder
    $image_upload_path = $upload_directory . basename($image_name);

    if(move_uploaded_file($image_tmp_name, $image_upload_path)){

        echo $projectName . "<br>";
        echo $briefDescription . "<br>";
        echo $projectDetails . "<br>";

        // Display the image
        echo "<img src='../uploads/" . $image_upload_path . "' width='300'><br>";
    } else {
        echo "Failed to upload image.";
    }

    $project = new Project();
    $project->insertProject($projectName, $briefDescription, $projectDetails, $image_upload_path);
    echo "Project inserted successfully";
}else{
    header("Location: ../admin/addproject.php");
}
