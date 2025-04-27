<?php
session_start();
include 'db.php';

$course_msg = "";
$content_msg = "";

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
}

if (isset($_POST['add_course'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];

    $sql = "INSERT INTO courses (title, description) VALUES ('$title', '$description')";
    if ($conn->query($sql) === TRUE) {
        $course_msg = "Course added!";
    } else {
        $course_msg = "Error: " . $conn->error;
    }
}

if (isset($_GET['delete_course'])) {
    $course_id = $_GET['delete_course'];

    $delete_content = "DELETE FROM course_content WHERE course_id = $course_id";
    $conn->query($delete_content);

    $delete_course = "DELETE FROM courses WHERE id = $course_id";
    if ($conn->query($delete_course) === TRUE) {
        $course_msg = "Course deleted successfully!";
    } else {
        $course_msg = "Error deleting course: " . $conn->error;
    }
}

if (isset($_POST['add_content'])) {
    $course_id = $_POST['course_id'];
    $topic = $_POST['topic'];
    $description = $_POST['content_description'];

    $image = $_FILES['image']['name'];
    $target = "uploads/" . basename($image);
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $sql = "INSERT INTO course_content (course_id, image, topic, description) VALUES ('$course_id', '$image', '$topic', '$description')";
        if ($conn->query($sql) === TRUE) {
            $content_msg = "Content added!";
        } else {
            $content_msg = "Error: " . $conn->error;
        }
    } else {
        $content_msg = "Failed to upload image.";
    }
}

$admin_id = $_SESSION['user_id'];
$admin_query = $conn->query("SELECT name FROM users WHERE id = $admin_id");
$admin_data = $admin_query->fetch_assoc();
$admin_name = isset($admin_data['name']) ? $admin_data['name'] : 'Administrator';

$courses = $conn->query("SELECT * FROM courses");
$courses_list = $conn->query("SELECT * FROM courses"); // Second query for listing courses
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
body {
    font-family: Arial, sans-serif;
    background: linear-gradient(135deg,rgb(13, 29, 54) 0%,rgb(110, 119, 134) 100%);
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.header {
    background-color: #333;
    color: white;
    padding: 25px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    border-bottom: 4px solid white;
}

.header-left {
    display: flex;
    align-items: center;
}

.logo {
            font-size: 24px;
            font-weight: bold;
            color: rgb(255, 255, 255);
            margin: 0;
            background-color:rgb(1, 13, 67);
            padding: 1px 3px;
            border-radius: 5px;
            margin-right: 10px;
           
        }

        .logo .logo2{
            color:rgb(1, 13, 67);
            background-color: white;
            padding: 2px 2px;
            border-radius: 5px;
        }

.nav-links {
    display: flex;
}

.nav-links a {
    color: white;
    text-decoration: none;
    margin-right: 20px;
    padding: 5px 10px;
    border-radius: 4px;
    transition: background-color 0.3s;
}

.nav-links a:hover, .nav-links a.active {
    background-color: #555;
}

.header-right {
    display: flex;
    align-items: center;
}



.header-logout {
    color: white;
    text-decoration: none;
    background-color: #dc3545;
    padding: 5px 15px;
    border-radius: 4px;
    transition: background-color 0.3s;
}

.header-logout:hover {
    background-color: #c82333;
}

.container {
    padding: 20px;
}

h1 {
    text-align: center;
    color: white;
    margin-top: 30px;
}

h2 {
    color: #333;
    margin-bottom: 10px;
}

form, .course-list {
    background-color: white;
    border-radius: 8px;
    padding: 20px;
    margin: 20px auto;
    width: 80%;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

form input,
form textarea,
form select {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

form input:focus,
form textarea:focus,
form select:focus {
    border-color: #007bff;
    outline: none;
}

button, .action-btn {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    text-decoration: none;
    display: inline-block;
    margin-right: 10px;
}

button:hover, .action-btn:hover {
    background-color: #0056b3;
}

.delete-btn {
    background-color: #dc3545;
}

.delete-btn:hover {
    background-color: #c82333;
}

.edit-btn {
    background-color: #28a745;
}

.edit-btn:hover {
    background-color: #218838;
}

form input[type="text"],
form textarea,
form select {
    margin-bottom: 15px;
}

a.logout {
    display: inline-block;
    margin: 20px 0;
    text-decoration: none;
    color: #007bff;
    font-size: 16px;
}

a.logout:hover {
    text-decoration: underline;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table, th, td {
    border: 1px solid #ddd;
}

th, td {
    padding: 15px;
    text-align: left;
}

th {
    background-color: #f2f2f2;
}

tr:nth-child(even) {
    background-color: #f9f9f9;
}

tr:hover {
    background-color: #f1f1f1;
}
    </style>
</head>
<body>
    <div class="header">
        <div class="header-left">
        <div class="logo">Certify <span class="logo2">Learn</span></div>
            <div class="nav-links">
                <a href="admin.php" class="active">Dashboard</a>
                <a href="manage_reviews.php">Reviews</a>

            </div>
        </div>
        <div class="header-right">
            
            <a href="logout.php" class="header-logout">Logout</a>
        </div>
    </div>

    <div class="container">
        <h1>Admin Dashboard</h1>

        <form method="POST">
            <h2>Add Course</h2>
            <input type="text" name="title" placeholder="Course Title" required><br>
            <textarea name="description" placeholder="Course Description" required></textarea><br>
            <p><button type="submit" name="add_course">Add Course</button><p id="courseadded_msg"><?php echo $course_msg; ?></p></div>
            </p>
        </form>

        <div class="course-list">
            <h2>Manage Courses</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($course = $courses_list->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $course['id']; ?></td>
                        <td><?php echo $course['title']; ?></td>
                        <td><?php echo $course['description']; ?></td>
                        <td>
                            <a href="edit_course.php?id=<?php echo $course['id']; ?>" class="action-btn edit-btn">Edit</a>
                            <a href="admin.php?delete_course=<?php echo $course['id']; ?>" class="action-btn delete-btn" onclick="return confirm('Are you sure you want to delete this course? This will also delete all content associated with this course.')">Delete</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <form method="POST" enctype="multipart/form-data">
            <h2>Add Course Content</h2>
            <select name="course_id" required>
                <option value="">Select Course</option>
                <?php 
                $courses->data_seek(0); 
                while ($course = $courses->fetch_assoc()): 
                ?>
                    <option value="<?php echo $course['id']; ?>"><?php echo $course['title']; ?></option>
                <?php endwhile; ?>
            </select><br>
            <input type="text" name="topic" placeholder="Topic" required><br>
            <textarea name="content_description" placeholder="Description" required></textarea><br>
            <input type="file" name="image" required><br>
            <p><button type="submit" name="add_content">Add Content</button><p id="contentadded_msg"><?php echo $content_msg; ?></p></p>
        </form>
    </div>

</body>
</html>