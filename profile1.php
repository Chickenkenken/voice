<?php
session_start();

// Check if the user is not logged in, redirect to login page
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

// Display user information
$fullname = $_SESSION['fullname'];
$contact = $_SESSION['contact'];
$formatted_info = $fullname . ' | ' . $contact;
$profile_picture = $_SESSION['profile_picture'];

// Additional user information
$address = $_SESSION['address'];
$latitude = $_SESSION['latitude'];
$longitude = $_SESSION['longitude'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Profile</title>
<style>
/* General Styles */
body {
    background-image: url(bg01.png);
    background-repeat: no-repeat;
    background-size: cover;
    background-attachment: fixed;
    background-position: center;
    margin: 0;
    padding: 0;
}
/* Header Styles */
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
    right: 0;
    width: 50px;
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
    text-align: center;
    margin: 50px auto;
   background: rgba(255, 255, 255, 0.1); /* Transparent white background */
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1); /* Soft shadow */
    backdrop-filter: blur(10px); /* Glass blur effect */
    border: 2px solid rgba(255, 255, 255, 0.3); /* Optional border */
    padding: 20px;
    border-radius: 10px;
   
}

h1 {
    text-align: center;
    margin-bottom: 20px;
}

.profile-info {
    display: flex;
    align-items: center;
    gap: 20px;
}
.profile-picture{
  background-color: white;
  border-radius: 50%;
}
.profile-picture img {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
    border: 1px solid #fff;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
}

.user-details {
    flex: 1;
}

.user-details p {
    margin: 10px 0;
}

.logout-btn {
    background-color: #FF6347;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
}

.logout-btn:hover {
    background-color: #FF4500;
}

/* Updated Profile Info Styling */
.profile-info {
    flex-direction: column;
    text-align: center;
}

.profile-picture {
    margin-bottom: 20px;
}

.user-details p {
    text-align: left;
}

    /* Responsive profile info */
    .profile-info {
        flex-direction: column;
        text-align: center;
    }

    .profile-picture img {
        width: 120px;
        height: 120px;
    }
}
</style>
</head>
<body onload="getLocation();">
<header class="hcontainer">
    <div class="logo"><img src="originalVoiceLogo.png"></div>
    <h1 class="title">The Victims' Outreach and Incidents' Control Environment</h1>
    <button class="menu-btn" onclick="toggleMenu()">&#9776;</button>
    <nav class="nav-links">
        <a href="profile1.php">Profile</a>
        <a href="home.html">Home</a>
        <a href="#">About</a>
    </nav>
</header>
<div class="container">
    <h1>User Profile</h1>
    <div class="profile-info">
        <div class="profile-picture">
            <img src="<?php echo $profile_picture; ?>">
        </div>
        <div class="user-details">
            <p><strong>Name:</strong> <?php echo $fullname; ?></p>
            <p><strong>Contact:</strong> <?php echo $contact; ?></p>
            <p><strong>Address:</strong> <?php echo $address; ?></p>
            <p><strong>Latitude:</strong> <?php echo $latitude; ?></p>
            <p><strong>Longitude:</strong> <?php echo $longitude; ?></p>
        </div>
    </div>
    <form action="logout.php" method="post">
        <button type="submit" class="logout-btn">Logout</button>
    </form>
</div>
<script>
function toggleMenu() {
  const navLinks = document.querySelector('.nav-links');
  navLinks.classList.toggle('show');
}
function getLocation() {
    // Your geolocation code here if needed
}
</script>
</body>
</html>
