<?php
// Start session
session_start();

// Establish database connection (Replace placeholders with your actual database credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "voice";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $category1 = isset($_POST['category1']) ? $_POST['category1'] : '';
    $category2 = isset($_POST['category2']) ? $_POST['category2'] : '';
    $fileName = isset($_FILES['image']['name']) ? $_FILES['image']['name'] : '';
    $sender = isset($_SESSION['fullname']) ? $_SESSION['fullname'] : '';
    $contact = isset($_SESSION['contact']) ? $_SESSION['contact'] : '';
    $location = isset($_SESSION['address']) ? $_SESSION['address'] : '';
    $latitude = isset($_SESSION['latitude']) ? $_SESSION['latitude'] : '';
    $longitude = isset($_SESSION['longitude']) ? $_SESSION['longitude'] : '';
    $status = "online"; // Assuming this is set based on your requirement

    // Upload file to reports directory
    $targetDir = "reports/"; // Specify the directory where you want to store uploaded files
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);

    // Insert data into the reports table using prepared statements
    $stmt = $conn->prepare("INSERT INTO reports (Category, Type, File_Name, Sender, Contact, Location, Latitude, Longitude, Status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssss", $category1, $category2, $fileName, $sender, $contact, $location, $latitude, $longitude, $status);

    if ($stmt->execute()) {
        echo "<script>alert('New record created successfully');</script>";
    } else {
        echo "<script>alert('Error creating record: " . $stmt->error . "');</script>";
    }

    $stmt->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Camera Capture</title>
<style>
    body {
        background-image: url(bg01.png);
        background-repeat: no-repeat;
        background-size: cover;
        background-attachment: fixed;
        background-position: center;
        margin: 0;
        padding: 0;
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
    .mainContainer {
        padding-top: 100px;
    }

    #fileName {
        margin-top: 10px;
        text-align: center;
    }

    #previewContainer {
        background-color: #fff;
        border-radius: 20px;
        box-shadow: 0px 5px 15px rgba(0, 0, 0, .25);
        width: 300px;
        height: 300px;
        margin: 10px auto;
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
    }

    #previewImage {
        max-width: 100%;
        max-height: 100%;
    }

    #buttonContainer {
        text-align: center;
        display: flex;
        justify-content: center;
        flex-direction: column;
        margin-top: 10px;
        width: 100%;
        max-width: 300px;
        margin: 0 auto;
    }

    input[type="file"] {
        display: none;
        margin: 5px 0;
        box-sizing: border-box;
    }

    /* CSS hover effect for the send button */
    #sendButton {
        /* Your existing styles */
        text-transform: uppercase;
        font-size: 15px;
        font-weight: bold;
        font-family: "Lucida Console";
        box-shadow: 0px 5px 15px rgba(0, 0, 0, .25);
        cursor: pointer;
        background-color: black;
        color: yellow;
        border-radius: 5px;
        text-align: center;
        width: 100%;
        height: 40px;
        max-width: 300px;
        margin: 0 auto;
        /* Transition effect to smoothly change properties */
        transition: background-color 0.3s, box-shadow 0.3s, transform 0.3s;
    }

    /* Hover effect */
    #sendButton:hover {
        background-color: yellow;
        color: black;
        box-shadow: 0px 8px 20px rgba(0, 0, 0, .3);
    }

    /* Clicked effect */
    #sendButton:active {
        transform: translateY(2px); /* Move button down slightly when clicked */
    }

    .Capbut {
        text-transform: uppercase;
        font-size: 15px;
        font-weight: bold;
        font-family: "Lucida Console";
        box-shadow: 0px 5px 15px rgba(0, 0, 0, .25);
        border: 2px solid black;
        cursor: pointer;
        padding: 10px 15px;
        background-color: black;
        color: yellow;
        border-radius: 5px;
        text-align: center;
        width: calc(100% - 30px);
        height: 20px;
        max-width: 300px;
        margin: 0 auto;
        display: block;
        transition: background-color 0.3s, box-shadow 0.3s, transform 0.3s;
    }

    .Capbut:hover {
        background-color: yellow;
        color: black;
        box-shadow: 0px 8px 20px rgba(0, 0, 0, .3);
    }

    /* Clicked effect */
    label:active {
        transform: translateY(2px); /* Move button down slightly when clicked */
    }

    /* Style for radio buttons */
    input[type="radio"] {
        display: none; /* Hide the default radio buttons */
    }

    /* Custom styling for label */
    label.radio-button {
        text-transform: uppercase;
        font-size: 15px;
        font-weight: bold;
        font-family: "Lucida Console";
        box-shadow: 0px 5px 15px rgba(0, 0, 0, .25);
        border: 2px solid black;
        cursor: pointer;
        padding: 10px 15px;
        background-color: black;
        color: yellow;
        border-radius: 5px;
        text-align: center;
        width: calc(100% - 30px); 
        max-width: 300px;
        margin: 0 auto; /* Center align */
        transition: background-color 0.3s, box-shadow 0.3s, transform 0.3s;
    }

    /* Hover effect for label */
    label.radio-button:hover {
        background-color: yellow;
        color: black;
        box-shadow: 0px 8px 20px rgba(0, 0, 0, .3);
    }

    /* Checked effect for label */
    input[type="radio"]:checked + label.radio-button {
        background-color: yellow;
        color: black;
        box-shadow: 0px 8px 20px rgba(0, 0, 0, .3);
    }
</style>
</head>
<body>
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
<div id="fileName"></div>
<div class="mainContainer">
    <div id="previewContainer">
        <img id="previewImage" src="#" alt="Preview Image" />
    </div>
    <div id="buttonContainer">
       <form id="imageForm" action="" method="post" enctype="multipart/form-data">
            <label for="imageUpload" class="Capbut">Capture</label>
            <input type="file" name="image" accept="image/*" capture="environment" id="imageUpload" onchange="previewImage(event)">
            <h4>Violence Against?</h4>
            <input type="radio" name="category1" value="women" id="womenRadio">
            <label class="radio-button" for="womenRadio">Women</label>
            <input type="radio" name="category1" value="children" id="childrenRadio">
            <label class="radio-button" for="childrenRadio">Children</label>
            <h4>Type of Violence</h4>
            <input type="radio" name="category2" value="physical" id="physical">
            <label class="radio-button" for="physical">Physical</label>
            <input type="radio" name="category2" value="verbal" id="verbal">
            <label class="radio-button" for="verbal">Verbal</label>
            <input type="radio" name="category2" value="sexual" id="sexual">
            <label class="radio-button" for="sexual">Sexual</label><br><br>
            <button type="button" id="sendButton" onclick="submitForm()">Send</button>
        </form>
    </div>
</div>

<script>
function toggleMenu() {
  const navLinks = document.querySelector('.nav-links');
  navLinks.classList.toggle('show');
}
function previewImage(event) {
    var file = event.target.files[0];
    var reader = new FileReader();
    reader.onload = function(e) {
        var image = document.getElementById('previewImage');
        image.src = e.target.result;
    };
    reader.readAsDataURL(file);

    document.getElementById('fileName').innerText = "File Name: " + file.name;
}

function submitForm() {
    var form = document.getElementById('imageForm');
    form.submit();
}

</script>
</body>
</html>
