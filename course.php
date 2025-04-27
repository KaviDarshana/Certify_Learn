<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
}

$course_id = $_GET['id'] ?? null;

if ($course_id) {
    $sql = "SELECT * FROM course_content WHERE course_id = $course_id";
    $content = $conn->query($sql);
} else {
    $sql = "SELECT * FROM courses";
    $courses = $conn->query($sql);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Courses</title>
    <style>
        /* General styles */
body {
    font-family: 'Arial', sans-serif;
    line-height: 1.6;
    color: #333;
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
        background: linear-gradient(135deg,rgb(13, 29, 54) 0%,rgb(110, 119, 134) 100%);

}

h1 {
    color:rgb(255, 255, 255);
    text-align: center;
    margin-bottom: 30px;
    font-size: 2.5rem;
    border-bottom: 2px solid #3498db;
    padding-bottom: 10px;
}

h2 {
    color: #2980b9;
    margin-top: 0;
    font-size: 1.8rem;
}

p {
    margin-bottom: 15px;
    font-size: 1rem;
}

a {
    display: inline-block;
    background-color: #3498db;
    color: white;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
    transition: background-color 0.3s;
}

a:hover {
    background-color: #2980b9;
    transform: translateY(-2px);
}

div {
    background: white;
    border-radius: 8px;
    padding: 25px;
    margin-bottom: 30px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
}

div:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
}

img {
    max-width: 100%;
    height: auto;
    border-radius: 6px;
    margin: 15px 0;
    box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
}

.tips {
    background-color: #e8f4fc;
    border-left: 4px solid #3498db;
    padding: 15px;
    margin-top: 20px;
    border-radius: 4px;
    box-shadow: none;
}

.tips p {
    margin: 5px 0;
    color: #2980b9;
    font-size: 0.9rem;
    display: flex;
    align-items: center;
}

.tips p:before {
    content: "✓";
    margin-right: 8px;
    font-weight: bold;
    color: #27ae60;
}

@media (max-width: 768px) {
    body {
        padding: 15px;
    }
    
    h1 {
        font-size: 2rem;
    }
    
    h2 {
        font-size: 1.5rem;
    }
    
    div {
        padding: 15px;
    }
}
  </style>

</head>
<body>
    <?php if ($course_id): ?>
        <h1>Course Content</h1>
        <?php while ($item = $content->fetch_assoc()): ?>
            <div>
                <h2><?php echo $item['topic']; ?></h2>
                <img src="uploads/<?php echo $item['image']; ?>" alt="Content Image" width="200"><br>
                <p><?php echo $item['description']; ?></p>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <h1>Courses</h1>
        <?php while ($course = $courses->fetch_assoc()): ?>
            <div>
                <h2><?php echo $course['title']; ?></h2>
                <p><?php echo $course['description']; ?></p>
                <a href="course.php?id=<?php echo $course['id']; ?>">Start Learning</a>
              
                <div class="tips">
                <p>Totally Free Course</p>
                <p>Certificate available</p>
                </div>
                
            </div>
        <?php endwhile; ?>
    <?php endif; ?>
    <a href="home.php">Back to Home</a>
</body>
</html>
