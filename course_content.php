<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $course_id = $_POST['course_id'];
    $image = $_POST['image'];
    $topic = $_POST['topic'];
    $description = $_POST['description'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'lms');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO course_contents (course_id, image, topic, description) VALUES ('$course_id', '$image', '$topic', '$description')";
    if ($conn->query($sql) === TRUE) {
        echo "Content added successfully";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Arial', sans-serif;
}

body {
    background-color: #f5f7fa;
    color: #333;
    line-height: 1.6;
    padding: 20px;
}

form {
    max-width: 600px;
    margin: 30px auto;
    padding: 30px;
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

input[type="text"], textarea {
    width: 100%;
    padding: 12px;
    margin: 8px 0 20px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 16px;
    transition: border-color 0.3s;
}

textarea {
    min-height: 150px;
    resize: vertical;
}

input[type="text"]:focus, textarea:focus {
    border-color: #4a90e2;
    outline: none;
    box-shadow: 0 0 5px rgba(74, 144, 226, 0.3);
}

button[type="submit"] {
    background-color: #4a90e2;
    color: white;
    border: none;
    padding: 12px 24px;
    font-size: 16px;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
    display: block;
    width: 100%;
}

button[type="submit"]:hover {
    background-color: #3a7bc8;
}

/* Form labels */
form label {
    font-weight: bold;
    display: block;
    margin-bottom: 5px;
}

/* Success and error messages */
.message {
    padding: 15px;
    margin: 20px 0;
    border-radius: 4px;
}

.success {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.error {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

    </style>
</head>
<body>
<form method="POST">
    Course ID: <input type="text" name="course_id" required><br>
    Image URL: <input type="text" name="image" required><br>
    Topic: <input type="text" name="topic" required><br>
    Description: <textarea name="description" required></textarea><br>
    <button type="submit">Add Content</button>
</form>

</body>
</html>
