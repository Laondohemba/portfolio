<?php

require_once "autoload.php";
session_start();

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $projectID = $_SESSION["id"];
   require_once "files_handler.php";
    $project = new Project();
    $project->editProject($UserID, $projectID, $projectName, $briefDescription, $projectDetails, $image_upload_path);
    header("Location: ../user/projects.php?message=projecteditedsuccess");
}else{
    header("Location: ../user/projects.php");
}
