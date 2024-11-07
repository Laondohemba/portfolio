<?php
require_once "../includes/autoload.php";
session_start();

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
  <title><?php echo ucwords($user["username"]); ?> | Messages</title>
  <link rel="stylesheet" href="../css/style.css">
  <!-- bootstrap link -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <!-- Custom styles for this template -->

  <link href="../css/navbar.css" rel="stylesheet">
  <link href="../css/dashboard.css" rel="stylesheet">
</head>

<body>
  <!-- header -->
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
  <div class="container-fluid">
    <div class="row">
      <!-- messages -->
      <div id="sidebarMenu" class="col-8 bg-light my-5 mx-auto py-4">
        <h3 class="text-center">Messages</h3>
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">Message</th>
              <th scope="col">Date Received</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $messages = new Messages();
            $myMessages = $messages->getMessages($user["id"]);

            foreach ($myMessages as $message) { ?>
              <tr>
                <td><?php echo $message["name"]; ?></td>
                <td><?php echo $message["email"]; ?></td>
                <td><?php echo $message["message_body"]; ?></td>
                <td><?php echo $message["received_at"]; ?></td>

              </tr>
            <?php }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <script src="js/dashboard.js"></script>
</body>

</html>