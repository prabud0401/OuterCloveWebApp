<?php
include_once "php/db.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input
    $username = $_POST["username"];
    $password = $_POST["password"];
    $user_type = $_POST["user-type"];

    // Replace this with your actual authentication logic
    if (authenticateUser($conn, $username, $password, $user_type)) {
        // Start a session and store user information
        session_start();
        $_SESSION["username"] = $username;
        $_SESSION["user_type"] = $user_type;

        // Redirect to the appropriate dashboard
        switch ($user_type) {
            case "admin":
                header("Location: dashboard/dash-Admin.html");
                break;
            case "staff":
                header("Location: dashboard/dash-Staff.html");
                break;
            case "customer":
                header("Location: dashboard/dash-Customer.html");
                break;
            default:
                // Redirect to a default page if the user type is not recognized
                header("Location: index.html");
        }
        exit();
    } else {
        // Invalid login, show an error message
        $error_message = "Invalid username, password, or user type.";
    }
}

// Function to authenticate user and return user type
function authenticateUser($conn, $username, $password, $user_type) {
    // Replace this with your actual authentication logic
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password' AND user_type = '$user_type'";
    $result = $conn->query($sql);

    return $result->num_rows > 0;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=YourGoogleFont">
    <link rel="icon" type="image/png" href="images/favicon.png">

    <title>Login - The Outer Clove Restaurant</title>
</head>
<body>
    <header>
        <nav>
            <div class="logo">
                <img src="images/logo.jpg" alt="Restaurant Logo">
            </div>
            <h1>The Outer Clove Restaurant</h1>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="login.php">Login</a></li>
            </ul>
        </nav>
    </header>
    <section class="login-form">
        <form method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="user-type">User Type:</label>
            <select id="user-type" name="user-type" required>
                <option value="admin">Admin</option>
                <option value="staff">Staff</option>
                <option value="customer">Customer</option>
            </select>

            <button type="submit">Login</button>
        </form>

        <?php
        if (isset($error_message)) {
            echo "<p class='error-message'>$error_message</p>";
        }
        ?>

        <p>Don't have an account? <a href="signup.php">Create a new account</a></p>
    </section>
    <script type="module" src="script.js"></script>
</body>
</html>
