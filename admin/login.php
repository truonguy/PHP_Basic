<?php
// Start a session if not already started
session_start();

// Include the connection script
include('../server/connection.php');

// Check if the user is already logged in, and if so, redirect to the account page
if (isset($_SESSION['admin_logged_in']) ) {
    header('Location: index.php');
    exit();
}

// Check if the login form has been submitted
if (isset($_POST['login_btn'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']); // You should consider using more secure password hashing mechanisms

    // Prepare and execute the query to check user credentials
    $stmt = $conn->prepare("SELECT admin_id, admin_name, admin_email, admin_password FROM admins WHERE admin_email = ? AND admin_password = ? LIMIT 1");
    $stmt->bind_param('ss', $email, $password);

    if ($stmt->execute()) {
        $stmt->bind_result($admin_id, $admin_name, $admin_email, $admin_password);

        if ($stmt->fetch()) {
            // Valid login, set session variables and redirect to the account page
            $_SESSION['admin_id'] = $admin_id;
            $_SESSION['admin_name'] = $admin_name;
            $_SESSION['admin_email'] = $admin_email;
            $_SESSION['admin_logged_in'] = true;

            header("Location: index.php?login_success=logged in successfully");
            exit();
        } else {
            // Invalid login, redirect to the login page with an error message
            header("Location: login.php?error=Could not verify your account");
            exit();
        }
    } else {
        // Error occurred during the query execution
        header('Location: login.php?error=Something went wrong');
        exit();
    }
}

// If the login form has not been submitted, you can continue your code or include the HTML form.
// Make sure to include the login form HTML here.
?>



<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Shop - Admin</title>

    <link rel="shortcut icon" href="assets/images/favicon.png" />
    <script src="/onishoes/webroot/jquery/jquery.js"></script>
    <link rel="stylesheet" href="assets/css/login_admin.css">
    <link href="/onishoes/webroot/font/Font Awesome/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
        integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.1/mdb.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <!-- Bootstrap core CSS -->
    <link href="assets/dist/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/dashboard.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Company name</a>
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <?php if(isset($_SESSION['admin_logged_in'])){ ?>
                <a class="nav-link" href="logout.php?logout=1">Sign out</a>
                <?php } ?>
            </li>
        </ul>
    </nav>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block ">
                                <img src="../assets/imgs/1.jpg" width="500" alt="">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">

                                        <br><br>
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form id="login-form" enctype="multipart/form-data" class="user" action="login.php"
                                        method="POST">
                                        <p style="color: red;">
                                            <?php if(isset($_GET['error'])){ echo $_GET['error']; } ?></p>
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp" name="email"
                                                placeholder="Enter Email..." required autofocus>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="product-desc" placeholder="Password" name="password">
                                        </div>
                                        <hr>
                                        <button type="submit" name="login_btn" class="btn  btn-primary  btn-block">
                                            Login
                                        </button>
                                        <hr>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>