<?php
require_once 'config.php'; // Make sure this file contains the database connection details

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $feedback = $_POST['feedback'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO feedback (name, feedback, date) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $feedback, $date);

    // Set parameters and execute
    $date = time();  // Storing the current timestamp
    if ($stmt->execute()) {
        $success = "Feedback submitted successfully. Thank you!";
    } else {
        $error = "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Give Feedback</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .feedback-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        input[type="text"], textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            background-color: #5cb85c;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #4cae4c;
        }
        .message {
            text-align: center;
            margin: 10px 0;
        }
        .error {
            color: red;
        }
        .success {
            color: green;
        }
    </style>
</head>
<body>
    <div class="feedback-container">
        <h1>Give Feedback</h1>
        <?php
        if (isset($error)) {
            echo "<p class='message error'>$error</p>";
        } elseif (isset($success)) {
            echo "<p class='message success'>$success</p>";
        }
        ?>
        <form method="POST" action="">
            <input type="text" name="name" placeholder="Your Name" required>
            <textarea name="feedback" rows="5" cols="40" placeholder="Your Feedback" required></textarea>
            <button type="submit">Submit Feedback</button>
        </form>
    </div>
</body>
</html>
