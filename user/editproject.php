<?php
require_once "../includes/autoload.php";
session_start();
$project = [];
if (isset($_SESSION["id"])) {
  $projectID = $_SESSION["id"];

  $projects = new Project();
  $project = $projects->getProjectForEdit($projectID);
  // var_dump($project);
}

if (isset($_GET["id"])) {
  $id = $_GET["id"];
  $user = new User();
  $profile = $user->getFullUserProfile($id);
}
if (!isset($_SESSION["user"])) {
  header("Location: ../login.php");
} else {
  $user = $_SESSION["user"] ?? [];
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <title><?php echo ucwords($user["username"]); ?> | Edit Project</title>

  <link rel="stylesheet" href="../css/style.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">



  <!-- Custom styles for this template -->
  <link href="../css/navbar.css" rel="stylesheet">
  <link href="../css/dashboard.css" rel="stylesheet">
  <!-- Include jQuery and Toastr libraries -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</head>

<body>

  <?php
  // Checking if the 'message' parameter exists in the URL
  if (isset($_GET['message']) && ($_GET['message'] == "projecteditedsuccess")) {
  ?>
    <script>
      // Display the Toastr alert when the document is ready
      $(document).ready(function() {
        toastr.success("Project added successfully");
      });
    </script>
  <?php
  }
  ?>

  <!-- nav bar -->
  <nav class="navbar navbar-expand-md navbar-dark bg-dark sticky-top" aria-label="Fourth navbar example">
    <div class="container-fluid px-5">
      <a class="navbar-brand mx-5" href="dashboard.php"><?php echo ucwords($user["username"]); ?> Portfolio Dashboard</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExample04">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="dashboard.php">Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="projects.php">Projects</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="editintroduction.php">Edit Profile</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="messages.php">Messages</a>
          </li>
        </ul>
        <div class="navbar-nav">
          <div class="nav-item text-nowrap">
            <a class="nav-link px-3" href="../includes/logout.php">Sign out</a>
          </div>
        </div>
      </div>
    </div>
  </nav>
  <!-- dashboard -->
  <div class="whole_page">
    <div class="container-fluid">
      <div class="row">
        <!-- add project -->
        <div class="col-7 bg-light my-5 mx-auto py-4">
          <form action="../includes/editproject_handler.php" method="POST" enctype="multipart/form-data" class="w-75 mx-auto text-center">
            <h2>Edit Project</h2>
            <label for="name" class="form-label my-2">Project Name</label>
            <input type="text" name="name" placeholder="Project Name" class="form-control" value="<?php echo $project['name'] ?? ''; ?>">

            <label for="brief_description" class="form-label my-2">Brief Description</label>
            <input type="text" name="brief_description" placeholder="Brief Description" class="form-control my-2" value="<?php echo $project['brief_description'] ?? ''; ?>">

            <label for="full_description" class="form-label my-2">Project Details</label>
            <textarea name="details" placeholder="Project Details" class="form-control my-2" rows="8">
            <?php echo $project['name'] ?? ''; ?>
          </textarea>

            <div class="row">
              <div class="col-6">
                <label for="image" class="form-label my-2">Image</label>
                <input type="file" name="project_image" class="form-control my-2">
              </div>
              <div class="col-6">
                <img src="<?php echo $project["image"]; ?>" class="img-fluid rounded-start" alt="<?php echo $project["name"]; ?>" style="max-height: 200px;">
              </div>
            </div>
            <button class="btn btn-primary my-2 w-100" type="submit">Make Changes</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <script src="js/dashboard.js"></script>
</body>

</html>