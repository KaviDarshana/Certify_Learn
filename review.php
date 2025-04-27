


<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'student') {
    header("Location:logout.php");
    exit;
}


$review_submitted = false;
$review_error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_review'])) {

    $review_text = $_POST['review_text'];
    $rating = $_POST['rating'];
    
  
    if (empty($review_text)) {
        $review_error = "Review text cannot be empty";
    } else if ($rating < 1 || $rating > 5) {
        $review_error = "Rating must be between 1 and 5";
    } else {
 
        $review_submitted = true;
    }
}


$user_data = [
    'name' => $_SESSION['name'],
    'email' => 'student@example.com',
    'student_id' => 'STU' . rand(10000, 99999),
    'program' => 'Computer Science',
    'year' => '2nd Year',
    'enrollment_date' => 'September 2023',
    'gpa' => '3.7'
];





$review_submitted = false;
$review_error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_review'])) {
    include 'db.php'; 
    
    $review_text = mysqli_real_escape_string($conn, $_POST['review_text']);
    $rating = intval($_POST['rating']);
    $user_id = $_SESSION['user_id'];
    $student_name = $_SESSION['name'];
    
    if (empty($review_text)) {
        $review_error = "Review text cannot be empty";
    } else if ($rating < 1 || $rating > 5) {
        $review_error = "Rating must be between 1 and 5";
    } else {
        $sql = "INSERT INTO reviews (user_id, rating, review_text, student_name, status) 
                VALUES ('$user_id', '$rating', '$review_text', '$student_name', 'pending')";
        
        if ($conn->query($sql) === TRUE) {
            $review_submitted = true;
        } else {
            $review_error = "Error submitting review: " . $conn->error;
        }
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Profile</title>
    <style>
       body {
    font-family: Arial, sans-serif;
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
    background-color: #333;
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
    box-shadow: 2px 0 4px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
}

.sidebar h3 {
    font-size: 1.5em;
    margin-top: 30px;
}

.sidebar a {
    display: block;
    color: white;
    text-decoration: none;
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 5px;
    background-color: #444;
    transition: background-color 0.3s ease;
}

.sidebar a:hover {
    background-color: #555;
}

.content {
    flex: 1;
    padding: 20px;
    background: linear-gradient(135deg,rgb(99, 255, 187) 0%,rgba(0, 34, 68, 0.83) 100%);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    margin-left: 20px;
}

.profile-header {
    display: flex;
    align-items: center;
    margin-bottom: 30px;
}

.profile-info {
    flex: 1;
}

.profile-info h1 {
    color: rgb(0, 29, 60);
    margin-bottom: 10px;
}

.profile-details {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.detail-card {
    background-color: #f9f9f9;
    padding: 15px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.detail-card h3 {
    color: rgb(208, 69, 0);
    margin-top: 0;
    margin-bottom: 10px;
    border-bottom: 1px solid #ddd;
    padding-bottom: 5px;
}

.detail-card p {
    margin: 5px 0;
}

.label {
    font-weight: bold;
    color: #555;
}

.review-section {
    margin-top: 30px;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 8px;
}

.review-form {
    margin-top: 20px;
}

.review-form textarea {
    width: 90%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    margin-bottom: 15px;
    resize: vertical;
    min-height: 100px;
}

.rating-select {
    margin-bottom: 15px;
}

.submit-btn {
    background-color: rgb(0, 123, 157);
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s ease;
}

.submit-btn:hover {
    background-color: #0056b3;
}

.success-message {
    background-color: #d4edda;
    color: #155724;
    padding: 10px;
    border-radius: 5px;
    margin-bottom: 15px;
}

.error-message {
    background-color: #f8d7da;
    color: #721c24;
    padding: 10px;
    border-radius: 5px;
    margin-bottom: 15px;
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

    .profile-header {
        flex-direction: column;
        text-align: center;
    }
}

.logout-btn {
    background-color: #dc3545;
    color: white;
    border: none;
    padding: 12px 20px;
    border-radius: 5px;
    font-size: 18px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.logout-btn:hover {
    background-color: #c82333;
}

    </style>
</head>
<body>
    <div class="main-container">
        <div class="sidebar">
            <h3>Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?>!</h3>
            <a href="home.php">Dashboard</a>
            <a href="course.php">View Courses</a>
            <a href="review.php">Give Review</a>
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>

        <div class="content">
            <div class="profile-header">
                <div class="profile-info">
                    <h1><?php echo htmlspecialchars($user_data['name']); ?></h1>
                </div>
            </div>

            <div class="review-section">
                <h2>Submit a Review</h2>
                <p>Share your thoughts about the courses, instructors, or overall experience at the institution.</p>
                
                <?php if ($review_submitted): ?>
                <div class="success-message">
                    <p>Thank you! Your review has been submitted successfully.</p>
                </div>
                <?php endif; ?>
                
                <?php if ($review_error): ?>
                <div class="error-message">
                    <p><?php echo htmlspecialchars($review_error); ?></p>
                </div>
                <?php endif; ?>
                
                <form class="review-form" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                    <div class="rating-select">
                        <label for="rating">Rating (1-5 stars):</label>
                        <select name="rating" id="rating" required>
                            <option value="">Select rating</option>
                            <option value="5">5 - Excellent</option>
                            <option value="4">4 - Very Good</option>
                            <option value="3">3 - Good</option>
                            <option value="2">2 - Fair</option>
                            <option value="1">1 - Poor</option>
                        </select>
                    </div>
                    
                    <textarea name="review_text" placeholder="Write your review here..." required></textarea>
                    
                    <button type="submit" name="submit_review" class="submit-btn">Submit Review</button>
                </form>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 Certify Learn. All rights reserved.</p>
    </footer>
</body>
</html>