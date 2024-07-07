<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Validate input
    if (empty($name) || empty($phone) || empty($email) || empty($_POST['password'])) {
        $error = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } else {
        // Insert new user into the database
        $sql = "INSERT INTO guest (name, phone, email, password) VALUES ('$name', '$phone', '$email', '$password')";
        if ($conn->query($sql) === TRUE) {
            $success = "User registered successfully. <a href='login.php'>Login here</a>";
        } else {
            $error = "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>

<?php include 'header1.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
    <style>
        body {
            background-image: url('https://img.freepik.com/free-photo/building-night_1127-3365.jpg?t=st=1718213892~exp=1718217492~hmac=6d6f245ee229615a22acc4eced1a5d9b8a26812a64050a0d6ea1ffd4613660c2&w=1380');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .success, .error {
            margin: 20px 0;
            padding: 10px;
            border-radius: 5px;
        }
        .success {
            color: green;
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
        }
        .error {
            color: red;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
        }
        .top-right {
            position: absolute;
            top: 10px;
            right: 10px;
        }
        .form-container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            margin: 100px auto;
            width: 300px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }
        h1 {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="top-right">
        <a href="login.php"><button type="button">Login</button></a>
    </div>
    <div class="form-container">
        <h1>User Registration</h1>
        <?php if (isset($error)): ?>
            <div class="error"><?= $error ?></div>
        <?php elseif (isset($success)): ?>
            <div class="success"><?= $success ?></div>
        <?php endif; ?>
        <form method="POST" action="">
            Name: <input type="text" name="name" required><br>
            Phone Number: <input type="text" name="phone" required><br>
            Email Address: <input type="email" name="email" required><br>
            Password: <input type="password" name="password" required><br>
            <button type="submit">Register</button>
        </form>
    </div>
    <?php include 'footer1.php'; ?>
</body>
</html>
<?php $conn->close(); ?>
