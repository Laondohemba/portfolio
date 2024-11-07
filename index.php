<?php
// index.php or your main entry point file
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// The rest of your code follows...

require_once "includes/autoload.php";

session_start();
if (isset($_POST["view_project"])) {
    $_SESSION["user_id"] = $_POST["id"];
    header("Location: profiles.php");
    exit();
}
if (isset($_SESSION["user"])) {
    session_unset();  // Unset all session variables
    session_destroy(); // Destroy the session
  } 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Portfolio</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="whole_page pb-5">
        <!-- header -->
        <div class="container-fluid sticky-top head">
            <div class="row my-1 head align-items-center">
                <div class="name col-2 text-white ms-2 ps-5">
                    <a href="index.php" class="text-decoration-none text-light">My Portfolio</a>
                </div>
                <div class="sections col-9">
                    <li>
                        <a href="signup.php" class="btn btn-primary">Sign Up</a>
                    </li>
                    <li>
                        <a href="login.php" class="btn btn-primary">Login</a>
                    </li>
                </div>
            </div>
        </div>
        <!-- Welcome -->
        <div class="my-container">
            <div class="welcome-container text-center text-white p-5">
                <h3>Welcome to My Portfolio</h3>
                <p>Here, you can create an account, display your projects and discover the profiles of others</p>
                <div class="d-flex justify-content-center">
                    <a href="signup.php" class="btn btn_color me-4">Sign Up</a>
                    <a href="login.php" class="btn btn_color">Login</a>
                </div>
            </div>
        </div>

        <div class="container my-4 x-small">
            <?php
            
            $users = new User();
            $allUsers = $users->getAllProfiles();

            foreach ($allUsers as $user) { ?>
                <div class="card mb-3 mx-auto" style="max-height: fit-content; max-width:950px">
                    <div class="row g-0">
                        <div class="col-12">
                            <img src="includes/<?php echo $user["cover_image"]; ?>" class="img-fluid rounded-start" alt="<?php echo $user["cover_image"]; ?>" style="min-height: fit-content;">
                        </div>
                        <div class="col-12">
                            <div class="card-body">
                                <h2 class="card-title"> <?php echo ucwords($user["username"]); ?> </h2>
                                <h5 class="text-muted"> <?php echo $user["titles"]; ?> </h5>
                                <p class="card-text"> <?php echo $user["intro_proper"]; ?> </p>

                                <div class="d-flex">
                                    <button class="btn btn-primary w-50 mx-auto" name="view_project">
                                        <a href="profiles.php?id=<?php echo $user['user_id']; ?>" class="text-decoration-none text-light w-100">View Profile</a>
                                    </button>
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


    <script src="./js/bootstrap.bundle.min.js"></script>
    <!-- <script src="./js/script.js"></script> -->
</body>

</html>