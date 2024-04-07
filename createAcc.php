<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <style>
        body {
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            justify-content: center;
            align-items: center;
            height: 100vh;
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
            margin: 20px auto;
            padding: 20px;
            background: rgba(255, 255, 255, 0.1); /* Transparent white background */
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1); /* Soft shadow */
            backdrop-filter: blur(10px); /* Glass blur effect */
            border: 2px solid rgba(255, 255, 255, 0.3); /* Optional border */
            border-radius: 5px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }

        .container h2 {
            margin-bottom: 20px;
            text-align: center;
        }

        .container input{
          display: block;
            width: 94%;
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;

        }
        .container button {
            display: block;
            width: 100%;
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .container button {
            background-color: #f1c40f;
            border: 1px solid black;
            color: black;
            font-weight: bold;
            cursor: pointer;
        }

        .container p {
            text-align: center;
        }

        .container p a {
            color: #f1c40f;
        }

        #profile-image-wrapper {
            text-align: center;
            margin-bottom: 20px;
        }

        #profile-image-preview img {
            width: 120px;
            height: 120px;
            border: 1px solid #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            border-radius: 50%;
            object-fit: cover;
            background-color: white;
        }

        .upload-btn {
            background-color: #f1c40f;
            color: black;
            padding: 8px 16px;
            border: 1px solid black;
            border-radius: 5px;
            cursor: pointer;
            margin-bottom: 10px;
        }

        .upload-btn:hover, .register:hover {
            background-color:  #d4ac0d;
        }

        .message {
            margin-bottom: 10px;
            text-align: center;
            color: red;
        }
    </style>
</head>

<body>
    <!-- Header code remains unchanged -->
    <?php
    ob_start(); // Start output buffering
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
        $profile = $_FILES['profile_picture'];
        $fullName = mysqli_real_escape_string($conn, $_POST['fullname']);
        $contact = mysqli_real_escape_string($conn, $_POST['contact']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $confirmPassword = mysqli_real_escape_string($conn, $_POST['confirm_password']);

        // Process uploaded image
        $uploadDir = 'user_profile/';
        $uploadFile = $uploadDir . basename($_FILES['profile_picture']['name']);

        // Check if passwords match
        if ($password !== $confirmPassword) {
            $message = '<div style="color: red; font-size: 10px;">Passwords do not match.</div>';
        } else {
            // Hash the password for security
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Check if Full Name or Profile already exist
            $checkQuery = "SELECT * FROM user_info WHERE FullName='$fullName' OR Profile='$uploadFile'";
            $result = $conn->query($checkQuery);

            if ($result->num_rows > 0) {
                // Duplicate entry found
                $message = '<div style="color: red; font-size: 10px;">Full Name or Profile already exists.</div>';
            } else {
                if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $uploadFile)) {
                    // Prepare SQL statement to insert user data into the database
                    $sql = "INSERT INTO user_info (FullName, Contact, Address, Password, Profile) VALUES ('$fullName', '$contact','$address', '$hashedPassword', '$uploadFile')";

                    if ($conn->query($sql) === TRUE) {
                        $message = '<div style="color: green; font-size: 10px;">You Created Your Account</div>';

                        // Redirect to login.php after successful account creation
                        header("Location: login.php");
                        exit; // Ensure that code execution stops after redirection
                    } else {
                        $message = '<div style="color: red; font-size: 10px;">Error: ' . $sql . '<br>' . $conn->error . '</div>';
                    }
                } else {
                    $message = '<div style="color: red; font-size: 10px;">Upload failed.</div>';
                }
            }
        }
    }
    ob_end_flush(); // End output buffering and flush the output
    ?>
    <header class="hcontainer">
    <div class="logo"><img src="originalVoiceLogo.png"></div>
    <h1 class="title">The Victims' Outreach and Incidents' Control Environment</h1>
    <button class="menu-btn" onclick="toggleMenu()">&#9776;</button>
    <nav class="nav-links">
    <a href="#">About</a>
    </nav>
    </header>
    <!-- Create Account Form -->
    <div class="container">
        <h2>Create Account</h2>
        <div id="profile-image-wrapper">
            <div id="profile-image-preview">
                <img src="#">
            </div>
            <button type="button" class="upload-btn" onclick="uploadProfilePicture()">Upload Profile Picture</button>
            <form id="registerForm" action="" method="post" enctype="multipart/form-data">
                <div class="message"><?php if (isset($message)) echo $message; ?></div>
                <input type="text" placeholder="Firstname Lastname" id="fullname" name="fullname" required>
                <input type="text" placeholder="Contact Number" id="contact" name="contact" required>
                <input type="text" placeholder="Barangay, City/Municipality" id="address" name="address" required>
                <input type="password" placeholder="Password" id="password" name="password" required>
                <input type="password" placeholder="Confirm Password" id="confirm_password" name="confirm_password"
                    required>
                <input type="file" id="profile_picture" name="profile_picture" accept="image/*"
                    style="display: none;" onchange="previewImage(event)" required>
                <button type="submit" class="register">Register</button>
                <p>Already have an account? <a href="login.php">Login</a></p>
            </form>
        </div>
    </div>

    <script>
        function toggleMenu() {
  const navLinks = document.querySelector('.nav-links');
  navLinks.classList.toggle('show');
}
        // Function to show upload alert and trigger file input
        function uploadProfilePicture() {
            alert("To ensure the authenticity and accountability of all reports and activities on this platform, we now require a verified profile picture. Starting immediately, any reports or actions initiated by accounts without a proper profile image will not be processed or accepted.");
            document.getElementById('profile_picture').click();
        }

        // Function to preview the selected image
        function previewImage(event) {
            const fileInput = event.target;
            const file = fileInput.files[0];
            const profileImagePreview = document.getElementById('profile-image-preview');
            const profileImage = profileImagePreview.querySelector('img');

            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    profileImage.src = e.target.result;
                };
                reader.readAsDataURL(file);
            } else {
                profileImage.src = '#';
            }
        }
    </script>
</body>

</html>
