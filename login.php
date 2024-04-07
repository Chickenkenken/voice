<?php
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include connection file if not already included
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "voice";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve form data
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $latitude = mysqli_real_escape_string($conn, $_POST['latitude']);
    $longitude = mysqli_real_escape_string($conn, $_POST['longitude']);

    // Check if the username and password match
    $sql = "SELECT * FROM user_info WHERE Fullname='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['Password'])) {
            // Password is correct, set session variables
            $_SESSION['loggedin'] = true;
            $_SESSION['fullname'] = $row['FullName'];
            $_SESSION['contact'] = $row['Contact'];
            $_SESSION['address'] = $row['Address'];
            $_SESSION['profile_picture'] = $row['Profile'];

            // Set latitude and longitude session variables
            $_SESSION['latitude'] = $latitude;
            $_SESSION['longitude'] = $longitude;

            header("Location: home.html");
            exit();
        } else {
            $error = "Invalid username or password.";
        }
    } else {
        $error = "Invalid username or password.";
    }

    // Close connection
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Page</title>
<style>
  body {
    background-color: #f0f0f0;
    margin: 0;
    padding: 0;
    justify-content: center;
    align-items: center;
    background-image: url(bg01.png);
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    background-attachment: fixed;
    scroll-behavior: smooth;
  }
.hcontainer {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background-color: black;
  padding: 10px 20px;
  box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
}

.logo img {
  width: 40px;
  height: 40px;
}

.title {
  color: yellow;
  margin-left: 10px;
  font-size: 18px;
}

.menu-btn {
  display: block;
  font-size: 24px;
  color: yellow;
  background: none;
  border: none;
  cursor: pointer;
}

.nav-links {
  display: none;
  flex-direction: column;
  position: absolute;
  top: 60px;
  right: 0; /* Position on the right side */
  width: 50px; /* Set initial width for larger screens */
  background-color: black;
  padding: 10px;
  box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
}

.nav-links.show {
  display: flex;
}

.nav-links a {
  color: yellow;
  margin: 8px 0;
  text-decoration: none;
  font-size: 16px;
}
/* Media query for responsive design */
@media screen and (max-width: 768px) {
  .menu-btn {
    display: block;
  }
  .hcontainer {
    padding: 10px 15px;
  }

  .title {
    font-size: 16px;
  }
  .logo img {
    width: 30px;
    height: 30px;
  }
}
.container {
    max-width: 350px;
    margin: 50px auto;
    background: rgba(255, 255, 255, 0.1); /* Transparent white background */
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1); /* Soft shadow */
    backdrop-filter: blur(10px); /* Glass blur effect */
    border: 2px solid rgba(255, 255, 255, 0.3); /* Optional border */
    color: black;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
  }
  .child{
    justify-content: center;
  }
  h2 {
    text-align: center;
    margin-bottom: 20px;
  }

  .myForm input[type="text"],
  .myForm input[type="password"]{
   display: block;
    width: 93%;
    margin-bottom: 15px;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
    background-color: #fff;
    color: #000;
  }
  .myForm button {
    display: block;
    width: 100%;
    margin-bottom: 15px;
    padding: 10px;
    border: 1px solid black;
    border-radius: 5px;
    font-size: 16px;
    background-color: #fff;
    color: #000;
  }

  .myForm button {
    background-color: #f1c40f;
    color: #000;
    font-weight: bold;
    cursor: pointer;
  }

  .myForm button:hover {
    background-color: #d4ac0d;
  }

  .error-message {
    color: red;
    font-size: 14px;
    margin-bottom: 10px;
  }
</style>
</head>
<body onload="getLocation();">
  <header class="hcontainer">
  <div class="logo"><img src="originalVoiceLogo.png"></div>
  <h1 class="title">The Victims' Outreach and Incidents' Control Environment</h1>
  <button class="menu-btn" onclick="toggleMenu()">&#9776;</button>
  <nav class="nav-links">
    <a href="#">About</a>
  </nav>
</header>
  <div class="container">
    <div class="child">
    <h2>Login</h2>
    <form action="" method="post" class="myForm">
      <?php if(isset($error)) echo '<div class="error-message">' . $error . '</div>'; ?>
      <input type="text" placeholder="Username" name="username" required>
      <input type="password" placeholder="Password" name="password" required><br><br>
      <input type="hidden" name="latitude" value="">
      <input type="hidden" name="longitude" value="">
      <button type="submit">Login</button>
    </form>
  </div>
</div>
  <script type="text/javascript">
    function toggleMenu() {
  const navLinks = document.querySelector('.nav-links');
  navLinks.classList.toggle('show');
}
    function getLocation() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
      }
    }

    function showPosition(position) {
      document.querySelector('.myForm input[name="latitude"]').value = position.coords.latitude;
      document.querySelector('.myForm input[name="longitude"]').value = position.coords.longitude;
    }
  </script>
</body>
</html>
