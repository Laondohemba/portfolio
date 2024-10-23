<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Admin | Add Post</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/navbars/">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">


    
    <!-- Custom styles for this template -->
    <link href="css/navbar.css" rel="stylesheet">
    <link href="css/dashboard.css" rel="stylesheet">
  </head>
  <body>
    
  <!-- nav bar -->
  <nav class="navbar navbar-expand-md navbar-dark bg-dark" aria-label="Fourth navbar example">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Expand at md</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExample04">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled">Disabled</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Dropdown</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li>
        </ul>
        <div class="navbar-nav">
            <div class="nav-item text-nowrap">
            <a class="nav-link px-3" href="#">Sign out</a>
            </div>
        </div>
      </div>
    </div>
  </nav>

  <!-- dashboard -->
<div class="container-fluid">
  <div class="row">
  <nav id="sidebarMenu" class="col-3 col-md-3 col-lg-2 bg-dark">
      <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="dashboard.php">
              <span data-feather="home" class="align-text-bottom"></span>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="addproject.php">
              <span data-feather="file" class="align-text-bottom"></span>
              Add Project
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="editintroduction.php">
              <span data-feather="shopping-cart" class="align-text-bottom"></span>
              Edit Introduction
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="messages.php">
              <span data-feather="users" class="align-text-bottom"></span>
              Check messages
            </a>
          </li>
        </ul>
      </div>
    </nav>
    <!-- add project -->
    <div id="sidebarMenu" class="col-9 col-md-9 col-lg-10 bg-light">
      <form action="" method="POST" class="w-75 mx-auto text-center">
        <h2>Edit Introduction</h2>
        <label for="image" class="form-label my-2">Cover Image</label>
        <input type="file" name="image" class="form-control my-2">

        <label for="title" class="form-label my-2">Title</label>
        <input type="text" name="title" placeholder="Title" class="form-control my-2">
      
          <label for="full_description" class="form-label my-2">Introduction</label>
          <textarea name="details" placeholder="Full Description" class="form-control my-2" rows="10"></textarea>
          
          <button class="btn btn-primary my-2" type="submit">Make changes</button>
      </form>
    </div>
  </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="js/dashboard.js"></script>
  </body>
</html>
