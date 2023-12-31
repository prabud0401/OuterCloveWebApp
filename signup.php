<?php
include_once "php/db.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirm-password"];
    $user_type = $_POST["user-type"];

    // Validate password and confirm password match
    if ($password !== $confirmPassword) {
        $error_message = "Password and Confirm Password do not match.";
    } else {

        // Insert user data into the database
        if (insertUser($conn, $username, $email, $password, $user_type)) {
            // Registration successful, redirect to login page
            header("Location: login.php");
            exit();
        } else {
            $error_message = "Error registering user. Please try again.";
        }
    }
}

// Function to insert user into the database
function insertUser($conn, $username, $email, $password, $user_type) {
    $sql = "INSERT INTO users (username, email, password, user_type) VALUES ('$username', '$email', '$password', '$user_type')";
    return $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/png" href="images/favicon.png"> <!-- Replace with the actual path to your favicon -->

    <title>Sign Up - The Outer Clove Restaurant</title>
</head>

<body>
    <header>
        <nav>
            <div class="logo">
                <img src="/images/logo.jpg" alt="Restaurant Logo">
                <h1>The Outer Clove Restaurant</h1>
            </div>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="signup.html">Sign Up</a></li>
                <li><a href="login.php">Login</a></li>
            </ul>
        </nav>
    </header>

    <section class="login-form">
        <form method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="confirm-password">Confirm Password:</label>
            <input type="password" id="confirm-password" name="confirm-password" required>

            <label for="user-type">User Type:</label>
            <select id="user-type" name="user-type" required>
                <!-- Only allow "Customer" option for sign up -->
                <option value="customer">Customer</option>
            </select>

            <button type="submit">Sign Up</button>
        </form>

        <?php
        if (isset($error_message)) {
            echo "<p class='error-message'>$error_message</p>";
        }
        ?>

        <p>Already have an account? <a href="login.php">Login here</a>.</p>
    </section>

    <script type="module" src="script.js"></script>
</body>

</html>
