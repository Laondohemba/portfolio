<?php

require_once "includes/autoload.php";
session_start();

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $user = new User();
    $profile = $user->getFullUserProfile($id);
}
if(isset($_SESSION["errors"])){
    $errors = $_SESSION["errors"] ?? [];
    unset($_SESSION["errors"]);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $profile["username"]; ?> Portfolio</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Include jQuery and Toastr libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</head>

<body>

    <?php
    // Checking if the 'message' parameter exists in the URL
    if (isset($_GET["message"])) {
    ?>
        <script>
            // Display the Toastr alert when the document is ready
            $(document).ready(function() {
  
                toastr.success("Message sent");
            });
        </script>
    <?php
    }
    ?>
    <div class="whole_page">
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



        <!-- About section -->
        <div class="x-small my-container text-center">
            <h2><?php echo ucwords($profile["username"]); ?></h2>
            <h6><?php echo $profile["titles"]; ?></h6>
            <img src="includes/<?php echo $profile["cover_image"]; ?>" class="img-fluid rounded-start" alt="<?php echo $profile["username"]; ?>">
        </div>
        <div class="x-small my-container" id="about">
            <p><?php echo $profile["intro_proper"]; ?></p>
        </div>

        <!-- Projects section -->
        <div class="x-small my-container text-center">
            <h2 class="text-center"><?php echo ucwords($profile["username"]); ?> Projects</h2>
            <?php
            $projects = new Project();
            $allProjects = $projects->getProjects($id);

            foreach ($allProjects as $project) { ?>
                <div class="card mb-3" style="min-height: fit-content;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="uploads/<?php echo $project["image"]; ?>" class="img-fluid rounded-start" alt="<?php echo $project["name"]; ?>" style="max-height: 300px;">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"> <?php echo $project["name"]; ?> </h5>
                                <p class="card-text"> <?php echo $project["brief_description"]; ?> </p>
                                <p class="card-text"><small class="text-body-secondary"><strong>Added at:</strong> <?php echo $project["created_at"]; ?> </small></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }
            ?>


            <!-- contact details -->
            <div class="x-small my-container text-center mt-4 mb-0" id="contact">
                <h3>Contact <?php echo ucwords($profile["username"]); ?></h3>

                <!-- <div class="text-center">
                social links
                <div class="social_links">
                    linkedin
                    <div class="d-flex align-items-center justify-content-center">
                        <span class="linkedin">
                            <i class="fa fa-linkedin-square"></i>
                        </span>
                        <a href="https://www.linkedin.com/in/phoebe-dadzie-3b4567276/" target="_blank" class="btn btn_color">Check LinkedIn Profile</a>
                    </div>
                </div>
            </div>
            line
            <div class="col-md-12 mx-auto mt-3">
                <div class="line_cont">
                    <div class="line"></div>
                    <div class="word">or</div>
                    <div class="line"></div>
                </div>
            </div> -->
                <!-- contact form -->
                <div class="col-md-12 mt-3 mb-5 mx-auto">

                    <form action="includes/messages_handler.php?id=<?php echo $id; ?>" method="post" id="contactform">
                        <h5 class="h5_message">Message <?php echo ucwords($profile["username"]); ?></h5>
                        <div class="text-start p-3">

                            <label for="name" class="form-label mb-0">Name:</label>
                            <input type="text" placeholder="Name..." class="form-control mb-3" id="name" name="name">
                            <p class="text-danger"><?php echo $errors["name_error"] ?? ''; ?></p>

                            <label for="subject" class="form-label mb-0">Email:</label>
                            <input type="text" placeholder="Email..." class="form-control mb-3" id="email" name="email">
                            <p class="text-danger"><?php echo $errors["email_error"] ?? ''; ?></p>

                            <label for="message" class="form-label mb-0">Message:</label>
                            <textarea name="message" id="message" rows="4" class="form-control" id="message" placeholder="Message"></textarea>
                            <p class="text-danger"><?php echo $errors["message_error"] ?? ''; ?></p>

                        </div>
                        <!-- Button trigger modal -->
                        <button type="submit" class="btn btn_color w-75">
                            Send
                        </button>
                    </form>
                </div>
            </div>
        </div>


        <script src="./js/bootstrap.bundle.min.js"></script>
        <!-- <script src="./js/script.js"></script> -->
</body>

</html>