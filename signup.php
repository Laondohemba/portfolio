<?php
session_start();
if (isset($_SESSION["errors"])) {
    $errors = $_SESSION["errors"] ?? [];
    $data = $_SESSION["data"] ?? [];

    unset($_SESSION["errors"]);
    unset($_SESSION["data"]);
}

if (isset($_GET['message']) && ($_GET['message'] == "success")) {
    header("Location:user/dashboard.php");
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
    <title></title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Include jQuery and Toastr libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</head>

<body>


    <?php
    // Checking if the 'message' parameter exists in the URL
    if (isset($_GET['message']) && ($_GET['message'] == "success")) {
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


    <!-- sign up -->
    <div class="whole_page">
        <div class="x-small my-container text-center mb-0" id="contact">
            <h3>Welcome to My Portfolio website</h3>

            <div class="text-center">
                <!-- contact form -->
                 <strong>Sign Up</strong>
                <div class="col-md-6 mt-3 mb-5 mx-auto bg-light py-3">

                    <form action="includes/signup_handler.php" method="post" id="contactform">
                        <div class="text-start p-3">
                            <label for="name" class="form-label mb-0">Username:</label>
                            <input type="text" placeholder="Username..." class="form-control mb-3" id="name" name="username" value="<?php echo $data["username"] ?? ''; ?>">
                            <p class="text-danger"><?php echo $errors['username'] ?? ''; ?></p>

                            <label for="subject" class="form-label mb-0">Email:</label>
                            <input type="text" placeholder="Email..." class="form-control mb-3" id="email" name="email" value="<?php echo $data["email"] ?? ''; ?>">
                            <p class="text-danger"><?php echo $errors['email'] ?? ''; ?></p>

                            <label for="subject" class="form-label mb-0">Password:</label>
                            <input type="password" placeholder="Password..." class="form-control mb-3" id="password" name="password">
                            <p class="text-danger"><?php echo $errors['password'] ?? ''; ?></p>

                            <label for="subject" class="form-label mb-0">Confirm Password:</label>
                            <input type="password" placeholder="Confirm Password..." class="form-control mb-3" id="confirmpassword" name="confirmpassword">

                        </div>
                        <!-- Button trigger modal -->
                        <button type="submit" class="btn btn_color">
                            Sign Up
                        </button>
                    </form>

                    <p class="mt-3">Already have an account?
                        <a href="login.php" class="text-decoration-none">Login</a>
                    </p>
                </div>
            </div>
        </div>
    </div>



    <script src="./js/bootstrap.bundle.min.js"></script>
    <!-- <script src="./js/script.js"></script> -->
</body>

</html>