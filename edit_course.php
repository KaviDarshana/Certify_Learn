<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

$course_id = $_GET['id'] ?? 0;

$check = $conn->query("SELECT * FROM courses WHERE id = $course_id");
if ($check->num_rows == 0) {
    echo "Course not found!";
    exit;
}

$course = $check->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    
    $update_sql = "UPDATE courses SET title = '$title', description = '$description' WHERE id = $course_id";
    
    if ($conn->query($update_sql) === TRUE) {
        echo "<div style='background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 20px;'>Course updated successfully!</div>";
        $course['title'] = $title;
        $course['description'] = $description;
    } else {
        echo "<div style='background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 20px;'>Error updating course: " . $conn->error . "</div>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Course</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-top: 30px;
        }

        form {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            margin: 20px auto;
            width: 60%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="text"]:focus,
        textarea:focus {
            border-color: #007bff;
            outline: none;
        }

        button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #218838;
        }

        .cancel-btn {
            background-color: #6c757d;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 4px;
            display: inline-block;
            margin-left: 10px;
        }

        .cancel-btn:hover {
            background-color: #5a6268;
        }

        .buttons {
            margin-top: 20px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
            color: #333;
        }
    </style>
</head>
<body>
    <h1>Edit Course</h1>
    
    <form method="POST">
        <div>
            <label for="title">Course Title:</label>
            <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($course['title']); ?>" required>
        </div>
        
        <div>
            <label for="description">Course Description:</label>
            <textarea id="description" name="description" rows="6" required><?php echo htmlspecialchars($course['description']); ?></textarea>
        </div>
        
        <div class="buttons">
            <button type="submit">Update Course</button>
            <a href="admin.php" class="cancel-btn">Cancel</a>
        </div>
    </form>
</body>
</html>