<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

if (isset($_GET['action']) && isset($_GET['id'])) {
    $review_id = intval($_GET['id']);
    $action = $_GET['action'];
    
    if ($action == 'approve') {
        $sql = "UPDATE reviews SET status = 'approved' WHERE id = $review_id";
        $conn->query($sql);
    } else if ($action == 'reject') {
        $sql = "UPDATE reviews SET status = 'rejected' WHERE id = $review_id";
        $conn->query($sql);
    } else if ($action == 'delete') {
        $sql = "DELETE FROM reviews WHERE id = $review_id";
        $conn->query($sql);
    }
    
    header("Location: manage_reviews.php");
    exit;
}

$reviews = $conn->query("SELECT * FROM reviews ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Reviews</title>
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

        /* Container for tables */
        .reviews-container {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            margin: 20px auto;
            width: 90%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* Navigation menu */
        .admin-nav {
            background-color: #333;
            overflow: hidden;
            padding: 10px;
        }

        .admin-nav a {
            float: left;
            color: white;
            text-align: center;
            padding: 12px 16px;
            text-decoration: none;
            font-size: 17px;
            margin-right: 5px;
            border-radius: 4px;
        }

        .admin-nav a:hover {
            background-color: #ddd;
            color: black;
        }

        .admin-nav a.active {
            background-color: #007bff;
            color: white;
        }

        /* Table styling */
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

        /* Status badges */
        .status-badge {
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 14px;
            font-weight: bold;
            text-align: center;
            display: inline-block;
            min-width: 80px;
        }

        .pending {
            background-color: #ffecb3;
            color: #856404;
        }

        .approved {
            background-color: #d4edda;
            color: #155724;
        }

        .rejected {
            background-color: #f8d7da;
            color: #721c24;
        }

        /* Rating stars */
        .rating {
            color: #ffc107;
            font-size: 18px;
        }

        /* Action buttons */
        .action-buttons a {
            margin-right: 5px;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 4px;
            color: white;
            font-size: 14px;
        }

        .approve-btn {
            background-color: #28a745;
        }

        .reject-btn {
            background-color: #dc3545;
        }

        .delete-btn {
            background-color: #6c757d;
        }

        .action-buttons a:hover {
            opacity: 0.9;
        }

        /* Logout link */
        .logout {
            float: right !important;
            background-color: #dc3545;
        }

        /* Filter controls */
        .filter-controls {
            margin: 20px 0;
            display: flex;
            gap: 10px;
        }

        .filter-btn {
            padding: 8px 15px;
            background-color: #e9ecef;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        .filter-btn.active {
            background-color: #007bff;
            color: white;
        }

        .filter-btn:hover {
            background-color: #dee2e6;
        }

        /* Responsive adjustments */
        @media screen and (max-width: 768px) {
            .reviews-container {
                width: 95%;
                padding: 10px;
            }
            
            table {
                display: block;
                overflow-x: auto;
            }
        }
    </style>
</head>
<body>
    <div class="admin-nav">
        <a href="admin.php">Dashboard</a>
        <a href="manage_reviews.php" class="active">Manage Reviews</a>
        <a href="logout.php" class="logout">Logout</a>
    </div>

    <h1>Review Management</h1>

    <div class="reviews-container">
        <div class="filter-controls">
            <button class="filter-btn active" data-filter="all">All Reviews</button>
            <button class="filter-btn" data-filter="pending">Pending</button>
            <button class="filter-btn" data-filter="approved">Approved</button>
            <button class="filter-btn" data-filter="rejected">Rejected</button>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Student</th>
                    <th>Rating</th>
                    <th>Review</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($review = $reviews->fetch_assoc()): ?>
                <tr class="review-row <?php echo $review['status']; ?>">
                    <td><?php echo $review['id']; ?></td>
                    <td><?php echo htmlspecialchars($review['student_name']); ?></td>
                    <td class="rating">
                        <?php 
                        for ($i = 1; $i <= 5; $i++) {
                            echo $i <= $review['rating'] ? "★" : "☆";
                        }
                        ?>
                    </td>
                    <td><?php echo htmlspecialchars($review['review_text']); ?></td>
                    <td><?php echo date('M j, Y', strtotime($review['created_at'])); ?></td>
                    <td>
                        <span class="status-badge <?php echo $review['status']; ?>">
                            <?php echo ucfirst($review['status']); ?>
                        </span>
                    </td>
                    <td class="action-buttons">
                        <?php if ($review['status'] != 'approved'): ?>
                            <a href="manage_reviews.php?action=approve&id=<?php echo $review['id']; ?>" class="approve-btn">Approve</a>
                        <?php endif; ?>
                        
                        <?php if ($review['status'] != 'rejected'): ?>
                            <a href="manage_reviews.php?action=reject&id=<?php echo $review['id']; ?>" class="reject-btn">Reject</a>
                        <?php endif; ?>
                        
                        <a href="manage_reviews.php?action=delete&id=<?php echo $review['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this review?')">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filterButtons = document.querySelectorAll('.filter-btn');
            const reviewRows = document.querySelectorAll('.review-row');
            
            filterButtons.forEach(button => {
                button.addEventListener('click', function() {
                    filterButtons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');
                    
                    const filter = this.getAttribute('data-filter');
                    
                    reviewRows.forEach(row => {
                        if (filter === 'all') {
                            row.style.display = '';
                        } else {
                            if (row.classList.contains(filter)) {
                                row.style.display = '';
                            } else {
                                row.style.display = 'none';
                            }
                        }
                    });
                });
            });
        });
    </script>
</body>
</html>