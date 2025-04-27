<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'student') {
    header("Location:logout.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg,rgb(13, 29, 54) 0%,rgb(110, 119, 134) 100%);
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            height: 100vh;
            flex-direction: column;
        }
        
        footer {
            width: 100%;
            background-color: #1e3a5f;
            color: white;
            text-align: center;
            padding: 15px 0;
            position: fixed;
            bottom: 0;
        }

        footer p {
            margin: 0;
            font-size: 14px;
        }

        .main-container {
            display: flex;
            flex: 1;
            margin: 20px;
        }

        .sidebar {
            width: 250px;
            background: linear-gradient(to bottom,rgb(62, 82, 101),rgb(12, 16, 22));
            color: white;
            padding: 25px;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
        }

        .sidebar .logo{
            margin-top: 10px;
            text-align: center;
        }

        .sidebar .logo img{
           border-radius: 5px;
           
           
        }

        .sidebar h3 {
            font-size: 1.5em;
            margin-top: 20px;
            text-align: center;
            font-weight: 600;
        }

        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 12px 15px;
            margin-bottom: 10px;
            border-radius: 8px;
            background-color: rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .sidebar a:hover {
            background-color: rgba(255, 255, 255, 0.2);
            transform: translateX(5px);
        }

        

        .content {
            flex: 1;
            padding: 30px;
            background: linear-gradient(135deg,rgb(96, 213, 255) 0%,rgba(0, 34, 68, 0.83) 100%);

            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            border-radius: 10px;
            margin-left: 20px;
            overflow-y: auto;
        }

        .greeting {
            font-size: 1.8em;
            color:rgb(0, 0, 0);
            font-weight: bold;
            margin-bottom: 25px;
            border-bottom: 2px solid #eaeaea;
            padding-bottom: 15px;
        }

        .course-cards {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 23px;
            margin-top: 30px;
        }


        
        .course-card {
            background: linear-gradient(135deg, #f5f7fa,rgb(247, 243, 221));
            border-radius: 10px;
            padding: 50px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.55);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .course-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }

        .course-card h3 {
            color:rgb(34, 35, 36);
            font-size: 1.4em;
            margin-top: 0;
        }

        .course-card p {
            color:rgb(9, 9, 10);
            line-height: 1.6;
        }

        .course-card .course-btn {
            display: inline-block;
            background-color:rgb(2, 102, 169);
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 10px;
            transition: background-color 0.3s ease;
        }

        .course-card .course-btn:hover {
            background-color:rgb(0, 120, 200);
        }

        .quick-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 30px;
        }

        .quick-action-btn {
            background-color: #3498db;
            color: white;
            padding: 15px 25px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 1.1em;
            transition: all 0.3s ease;
            flex: 1;
            min-width: 200px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .quick-action-btn:hover {
            background-color: #2980b9;
            transform: translateY(-3px);
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
        }

        @media (max-width: 1024px) {
            .main-container {
                flex-direction: column;
                margin: 10px;
            }

            .sidebar {
                width: 100%;
                margin-bottom: 20px;
            }

            .content {
                margin-left: 0;
            }
        }

        html {
            scroll-behavior: smooth;
        }

        .logout-btn {
            background-color:rgb(255, 51, 29);
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            display: block;
            text-align: center;
            margin-top: 40px;
        }

        .logout-btn:hover {
            background-color: #c0392b;
        }

        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>
</head>
<body>
    <div class="main-container">
        <div class="sidebar">
            <div class="logo">
                <img src="logo.png" alt="Profile Picture">
            </div>
            <h3>Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?>!</h3>
            <a href="review.php">Give Review</a>
            <a href="course.php">Start Learning</a>
            <a href="exam.html">View Exam</a>
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>

        <div class="content">
            <div class="greeting">
                <p>Hello, <?php echo htmlspecialchars($_SESSION['name']); ?>!</p>
            </div>


            <div class="course-cards">
                <div class="course-card">
                    <h3>Start Learning</h3>
                    <p>View all your enrolled courses, access learning materials, and track your progress.</p>
                    <a href="course.php" class="course-btn">Go to Courses</a>
                </div>

                <div class="course-card">
                    <h3>Exam Test</h3>
                    <p>Check your exam schedule, review past results, and prepare for upcoming assessments.</p>
                    <a href="exam.html" class="course-btn">View Exams</a>
                </div>
                
              
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 Certify Learn. All rights reserved.</p>
    </footer>
</body>
</html>