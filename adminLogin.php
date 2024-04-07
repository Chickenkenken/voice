<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Page</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
    }
    .container {
        max-width: 400px;
        margin: 50px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }
    input[type="text"],
    input[type="password"],
    input[type="submit"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    input[type="submit"] {
        background-color: #007bff;
        color: #fff;
        cursor: pointer;
    }
    input[type="submit"]:hover {
        background-color: #0056b3;
    }
    .error-message {
        color: red;
        margin-bottom: 10px;
    }
</style>
</head>
<body>
<div class="container">
    <h2>Login</h2>
    <?php
    // Check if there's an error message in the URL
    if (isset($_GET['error'])) {
        $error = $_GET['error'];
        if ($error == 'InvalidCredentials') {
            echo '<p class="error-message">Invalid username or password. Please try again.</p>';
        } elseif ($error == 'MissingCredentials') {
            echo '<p class="error-message">Username or password is missing. Please fill in both fields.</p>';
        }
    }
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
        <input type="submit" value="Login">
    </form>
</div>
<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if both username and password are provided
    if (isset($_POST["username"]) && isset($_POST["password"])) {
        // Retrieve username and password from the form
        $username = $_POST["username"];
        $password = $_POST["password"];

        // Hard-coded valid username and password
        $validUsername = "adminVoice123";
        $validPassword = "voice4dmin";

        // Check if the provided credentials match the valid ones
        if ($username == $validUsername && $password == $validPassword) {
            // Successful login, redirect to a dashboard or home page
            header("Location: adminFinal.php");
            exit;
        } else {
            // Invalid credentials, redirect back to the login page with an error message
            header("Location: adminLogin.php?error=InvalidCredentials");
            exit;
        }
    } else {
        // Username or password is missing, redirect back to the login page with an error message
        header("Location: adminLogin.php?error=MissingCredentials");
        exit;
    }
}
?>
</body>
</html>