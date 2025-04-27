<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role = $_POST['role']; 

    $sql = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$password', '$role')";
    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <style>
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(135deg,rgb(13, 29, 54) 0%,rgb(110, 119, 134) 100%);
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.login-container, .register-container {
    background-color: #fff;
    padding: 40px;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 400px;
    text-align: center;
}

.login-container h2, .register-container h2 {
    margin-bottom: 10px;
    color: #333;
    font-weight: 600;
}

form {
    display: flex;
    flex-direction: column;
}

input[type="text"],
input[type="email"], 
input[type="password"],
select {
    width: 100%;
    padding: 15px;
    margin: 10px 0;
    border: 1px solid #e1e1e1;
    border-radius: 8px;
    font-size: 16px;
    box-sizing: border-box;
    transition: all 0.3s ease;
}

input[type="text"]:focus,
input[type="email"]:focus, 
input[type="password"]:focus,
select:focus {
    border-color: #4a90e2;
    box-shadow: 0 0 0 2px rgba(74, 144, 226, 0.2);
    outline: none;
}

select {
    appearance: none;
    background-image: url("data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%23007CB2%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22%2F%3E%3C%2Fsvg%3E");
    background-repeat: no-repeat;
    background-position: right 15px top 50%;
    background-size: 12px auto;
    padding-right: 30px;
    cursor: pointer;
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
    margin-top: 15px;
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
    margin-top: 5px;
}

.error-message {
    color: #e74c3c;
    font-size: 14px;
    margin-top: 5px;
    text-align: left;
}
    </style>

    <script>
        function checkPassKey() {
            const passKeyInput = document.getElementById('passkey');
            const roleSelect = document.getElementById('role');
            const adminOption = document.getElementById('admin-option');
            
            const secretPassKey = "admin123";
            
            if (passKeyInput.value === secretPassKey) {
                adminOption.style.display = "block";
            } else {
                adminOption.style.display = "none";
                if (roleSelect.value === "admin") {
                    roleSelect.value = "student";
                }
            }
        }
    </script>
</head>
<body>
    <div class="register-container">
    <form method="POST">
        <input type="text" name="name" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" id="passkey" placeholder="Pass Key (for admin access)" onkeyup="checkPassKey()">
        <select name="role" id="role">
            <option value="student">Student</option>
            <option value="admin" id="admin-option" style="display: none;">Admin</option>
        </select>
        <button type="submit">Register</button>
        <p>If you already have an account <a href="login.php">Login here</a></p>
        <p><a href="index.php">Back to Home</a></p>
    </form>
    </div>
</body>
</html>