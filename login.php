<?php
// Start a session if not already started
session_start();

// Include the connection script
include('server/connection.php');

// Check if the user is already logged in, and if so, redirect to the account page
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
    header('Location: account.php');
    exit();
}

// Check if the login form has been submitted
if (isset($_POST['login_btn'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']); // You should consider using more secure password hashing mechanisms

    // Prepare and execute the query to check user credentials
    $stmt = $conn->prepare("SELECT user_id, user_name, user_email, user_password FROM users WHERE user_email = ? AND user_password = ? LIMIT 1");
    $stmt->bind_param('ss', $email, $password);

    if ($stmt->execute()) {
        $stmt->bind_result($user_id, $user_name, $user_email, $user_password);

        if ($stmt->fetch()) {
            // Valid login, set session variables and redirect to the account page
            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_name'] = $user_name;
            $_SESSION['user_email'] = $user_email;
            $_SESSION['logged_in'] = true;

            header("Location: account.php?login_success=logged in successfully");
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





<?php 
include('layout/header.php');
?>
<!--Login-->
<section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="font-weight-bold">Login</h2>
        <hr class="mx-auto" />
    </div>
    <div class="mx-auto container">
        <form action="login.php" method="POST" id="login-form">
            <p style="color:red" class="text-center"><?php if(isset($_GET['error'])){ echo $_GET['error']; } ?></p>
            <div class="form-goup">
                <label for="">Email</label>
                <input type="text" class="form-control" id="login-email" name="email" placeholder="Email" required />
            </div>

            <div class="form-goup">
                <label for="">Password</label>
                <input type="password" class="form-control" id="login-password" name="password" placeholder="Password"
                    required />
            </div>

            <div class="form-goup">
                <input type="submit" class="btn" name="login_btn" id="login-btn" value="Login" />
            </div>

            <div class="form-goup">
                <a href="register.php" id="register-url" class="btn">Don't have account? Register</a>
            </div>
        </form>
    </div>
</section>

<?php 
include('layout/header.php');
?>