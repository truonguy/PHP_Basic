<?php
session_start();
include('server/connection.php');
if (isset($_SESSION['logged_in'])) {
    header('location: account.php');
    exit;
}

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    // Validate input
    if ($password !== $confirmPassword) {
        header('location: register.php?error=passwords do not match');
        exit;
    } elseif (strlen($password) < 6) {
        header('location: register.php?error=password must be at least 6 characters');
        exit;
    }

    // Check if the email is already registered
    $stmt1 = $conn->prepare("SELECT COUNT(*) FROM users WHERE user_email = ?");
    $stmt1->bind_param('s', $email);
    $stmt1->execute();
    $stmt1->bind_result($num_row);
    $stmt1->fetch();

    if ($num_row != 0) {
        header('location: register.php?error=user with this email already exists');
        exit;
    } else {
        // Hash the password securely (do not use md5)
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Insert the new user into the database
        $stmt = $conn->prepare("INSERT INTO users (user_name, user_email, user_password) VALUES (?, ?, ?)");
        $stmt->bind_param('sss', $name, $email, $hashedPassword);

        if ($stmt->execute()) {
            $user_id = $stmt->insert_id;
            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_email'] = $email;
            $_SESSION['user_name'] = $name;
            $_SESSION['logged_in'] = true;
            header('location: account.php?registersuccess=You registered successfully');
            exit;
        } else {
            header('location: register.php?error=account could not be created at the moment');
            exit;
        }
    }
} 
?>


<?php 
include('layout/header.php');
?>

<!--Register-->
<section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="font-weight-bold">Register</h2>
        <hr class="mx-auto" />
    </div>
    <div class="mx-auto container">
        <form action="register.php" id="register-form" method="POST">
            <p style="color:red;"><?php if(isset($_GET['error'])){echo $_GET['error'];}?>
            </p>

            <div class="form-goup">
                <label for="">Name</label>
                <input type="text" class="form-control" id="register-name" name="name" placeholder="Name" required />
            </div>

            <div class="form-goup">
                <label for="">Email</label>
                <input type="text" class="form-control" id="register-email" name="email" placeholder="Email" required />
            </div>

            <div class="form-goup">
                <label for="">Password</label>
                <input type="password" class="form-control" id="register-password" name="password"
                    placeholder="Password" required />
            </div>

            <div class="form-goup">
                <label for="">Confirm Password</label>
                <input type="password" class="form-control" id="register-confirm-password" name="confirmPassword"
                    placeholder="Confirm Password" required />
            </div>

            <div class="form-goup">
                <input type="submit" class="btn" id="register-btn" value="Register" name="register" />
            </div>

            <div class="form-goup">
                <a href="login.php" id="login-url" class="btn">Do you have an account? Login</a>
            </div>
        </form>
    </div>
</section>

<<?php 
include('layout/footer.php');
?>