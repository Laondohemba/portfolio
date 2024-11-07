<?php
require_once "../includes/autoload.php";

session_start();
if (isset($_POST['edit_project'])) {
  $_SESSION["id"] = $_POST['id'];
  echo header("Location: editproject.php");
}

if (isset($_POST['delete_post'])) {
  $projectID = $_POST['id'];
  $project = new Project();
  $project->deleteProject($projectID);
  header("location: projects.php?message=projectdeleted");
}
$userID = 0;
if (isset($_SESSION["user"])) {
  $userID = $_SESSION["user"]["id"];
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
  <title><?php echo ucwords($user["username"]); ?> | Projects</title>

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
  if (isset($_GET['message']) && ($_GET['message'] == "projectdeleted")) {
  ?>
    <script>
      // Display the Toastr alert when the document is ready
      $(document).ready(function() {
        toastr.success("Project deleted successfully");
      });
    </script>
  <?php
  }
  ?>

  <!-- nav bar -->
  <nav class="navbar navbar-expand-md navbar-dark bg-dark sticky-top" aria-label="Fourth navbar example">
    <div class="container-fluid px-md-5">
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
  <div class="whole_page" style="min-height: 100vh;">
    <div class="my-container ">
      <h2 class="text-center">My Projects</h2>
      <?php
      $projects = new Project();
      $allProjects = $projects->getProjects($userID);

      foreach ($allProjects as $project) { ?>
        <div class="card my-2" style="max-height: 300px;">
          <div class="row g-0">
            <div class="col-md-4">
              <img src="<?php echo $project["image"]; ?>" class="img-fluid rounded-start" alt="<?php echo $project["name"]; ?>" style="max-height: 300px;">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title"> <?php echo $project["name"]; ?> </h5>
                <p class="card-text"> <?php echo $project["brief_description"]; ?> </p>
                <p class="card-text"><small class="text-body-secondary">Added at: <?php echo $project["created_at"]; ?> </small></p>

                <div class="d-flex">
                  <form class="me-2" method="POST">
                    <input type="hidden" value="<?php echo $project['id']; ?>" name="id">
                    <button class="btn btn-primary" name="edit_project">Edit</button>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                      Delete
                    </button>
                </div>


                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body modal_text">
                        Are you sure you want to delete this project?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn_color" data-bs-dismiss="modal">Close</button>
                        </form>
                        <form method="POST">
                          <input type="hidden" value="<?php echo $project['id']; ?>" name="id">
                          <button class="btn btn-danger" name="delete_post">Delete</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php }
        ?>

        </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <script src="js/dashboard.js"></script>
</body>

</html>