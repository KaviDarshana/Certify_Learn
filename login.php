<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            session_start();
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['role'] = $row['role'];
            $_SESSION['name'] = $row['name'];

            if ($row['role'] == 'admin') {
                header("Location: admin.php");
            } else {
                header("Location: home.php");
            }
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found with this email.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(135deg,rgb(171, 177, 186) 0%,rgb(13, 29, 54) 100%);
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.login-container {
    background-color: #fff;
    padding: 40px;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 400px;
    text-align: center;
}

.login-container h2 {
    margin-bottom: 30px;
    color: #333;
    font-weight: 600;
}

form {
    display: flex;
    flex-direction: column;
}

input[type="email"], input[type="password"] {
    width: 100%;
    padding: 15px;
    margin:  0;
    border: 1px solid #e1e1e1;
    border-radius: 8px;
    font-size: 16px;
    box-sizing: border-box;
    transition: all 0.3s ease;
}

input[type="email"]:focus, input[type="password"]:focus {
    border-color: #4a90e2;
    box-shadow: 0 0 0 2px rgba(74, 144, 226, 0.2);
    outline: none;
}

button[type="submit"] {
    width: 100%;
    padding: 15px;
    background-color: #4a90e2;
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    margin-top: 5px;
    font-weight: 600;
}

button[type="submit"]:hover {
    background-color: #357abD;
}

a {
    color: #4a90e2;
    text-decoration: none;
    font-size: 15px;
    transition: color 0.3s ease;
}

a:hover {
    color: #357abD;
    text-decoration: underline;
}

p {
    text-align: center;
    font-size: 15px;
    color: #666;
    margin-top: 20px;
}

.error-message {
    color: #e74c3c;
    font-size: 14px;
    margin-top: 5px;
    text-align: left;
}

    </style>
</head>
<body>
   <div class="login-container">
   <form method="POST">
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Login</button>
        <p>If you don't have an Account <a href="register.php">Click Here</a></p>
        <p><a href="index.php">Back to Home</a></p>

    </form>
   </div>
</body>
</html>
