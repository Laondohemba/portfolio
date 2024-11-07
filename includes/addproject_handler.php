<?php

require_once "autoload.php";

if($_SERVER["REQUEST_METHOD"] === "POST"){
    
   require_once "files_handler.php";
    $project = new Project();
    $project->insertProject($UserID, $projectName, $briefDescription, $projectDetails, $image_upload_path);
    echo "Project inserted successfully";
    header("Location: ../user/dashboard.php?message=projectadded");
}else{
    header("Location: ../user/dashboard.php");
}
