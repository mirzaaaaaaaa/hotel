<?php
session_start();
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $password = $_POST['password'];

    // Fetch user details from the database
    $sql = "SELECT * FROM guest WHERE name = '$name'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Store user information in session variables
            $_SESSION['guest_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            header("Location: http://localhost/hotel/"); // Redirect to the hotel home page
            exit;
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "No user found with that name.";
    }
}
?>

<?php include('header1.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <title>User Login</title>
    <style>
        body {
            background-image: url('https://img.freepik.com/free-photo/building-night_1127-3365.jpg?t=st=1718213892~exp=1718217492~hmac=6d6f245ee229615a22acc4eced1a5d9b8a26812a64050a0d6ea1ffd4613660c2&w=1380');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .login-container {
            margin: 100px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            width: 300px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }
        h1 {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>User Login</h1>
        <?php
        if (isset($error)) {
            echo "<p style='color:red;'>$error</p>";
        }
        ?>
        <form method="POST" action="">
            Name: <input type="text" name="name" required><br>
            Password: <input type="password" name="password" required><br>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>

<?php include('footer1.php'); ?>

<?php $conn->close(); ?>
