<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<style>
	*{
		margin: 0;
		padding: 0;
		box-sizing: border-box;
	}
	.header{
		   top: 0;
		   background-color: #5b7c99;
		   box-shadow: 0px 5px 15px rgba(0, 0, 0, .25);
            padding-left: 20px;
            padding-right: 20px;
            color: #fff;
            top: 0;
            display: flex;
            justify-content: space-between;
            width: 100%;
            align-items: center;
            position: fixed;
            height: 80px; /* Set a fixed height for the header */
  }
	.logo-container {
            display: flex;
            align-items: center;
  }

	.logo {
            height: 60px;
  }
  	h1{
  		color: black;
  	}

	.content {
            padding: 20px;
            text-align: center;
  }
	.container{
		top: 0;
		position: fixed;
		height: 380px;
		width: 100%;
		margin-top: 80px;
		background-color: white;
	}
	.container h2{
		padding-left: 20px;
		color: black;
	}
	.children, .women{
		display: flex;
		justify-content: center;
	}
	.box1{
		width: 450px;
		height: 150px;
		background-color: #82004e;
		border: solid #ba0071 4px;
		margin: 5px 30px 5px 30px;
		padding: 10px;
		border-radius: 10px;
		box-shadow: 0px 5px 15px rgba(0, 0, 0, .25);
	}
	.box1:hover{
		background-color:  #ba0071;
	}
	.box2{
		width: 450px;
		height: 150px;
		background-color: #45058d;
		border: solid 4px  #5e07bc;
		margin: 5px 30px 5px 30px;
		padding: 10px;
		border-radius: 10px;
		box-shadow: 0px 5px 15px rgba(0, 0, 0, .25);
	}
	.box2:hover{
		background-color: #5e07bc;
	}
	.children a, .women a{
		text-decoration: none;
		font-size: 20px;
		color: black;
	}
	.total{
		display: flex;
		margin-left: 20px;
		line-height: 110px;
		font-size: 80px;
		color: white;
		font-weight: bold;
		-webkit-text-stroke-width:.5px;
		-webkit-text-stroke-color:black;
		-webkit-text-stroke:blak;
		font-family: "Gill Sans", sans-serif;
	}
	.phyicon{
		width: 110px;
		height: 110px;
		margin-left: 200px;
		filter: drop-shadow(1px 1px 2px white);
		position: fixed;
	}
	.icon{
		position: fixed;
	}
	.container2{
		width: 100%;
		top: 0;
		display: flex;
		padding-top: 0;
		background-color: white;
		position: fixed;
		padding-right: 20px;
		padding-bottom: 20px;
		padding-left: 20px;
		margin-top: 480px;
	}
	.box1 h4{
		color: darkgray;
		text-shadow: 1px 1px 1px black;
	}
	.box2 h4{
		color: darkgray;
		text-shadow: 1px 1px 1px black;
	}
	.table{
		overflow-y: auto;
		border-radius: 10px;
		background-color:  #18848e;
		height: 270px;
		width: 900px;
		border: 1px solid  #18848e;
		margin: 5px;
		padding: 5px;
		box-shadow: 0px 5px 15px rgba(0, 0, 0, .25);
	}
	.tb{
		width: 100%;
		padding: 2px;
		border-radius: 50px;
		border-collapse: collapse;
		text-align: center;
		box-shadow: 0 0 20px #0000001a;
	}
	.tb th{
		background-color: #55608f;
		color: white;
	}
	.tb td{
		text-align: center;
		background-color: white;
		color: black;
	}
	.c-physical,.c-verbal,.c-sexual,.w-physical,.w-verbal,.w-sexual{
   		display: none;
  	}
  	.c-physical:target,.c-verbal:target,.c-sexual:target, .w-physical:target,.w-verbal:target,.w-sexual:target{
    	display: block;
  	}
	.map{
		padding: 3px;
		box-shadow: 0px 5px 15px rgba(0, 0, 0, .25);
		border-radius: 10px;
		height: 270px;
		width: 570px;
		margin: 5px;
		border: 2px solid  #FEDC56;
		background-color:  #FEDC56;
	}
	#googleMap{
		border-radius: 10px;
	}

</style>
<?php
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

// Fetch the total number of records with category "Physical" from the database
$sql = "SELECT COUNT(*) AS total FROM reports WHERE `Category` = 'children' AND `Type` = 'physical'";
$result = $conn->query($sql);

// Check if the query was successful
if ($result->num_rows > 0) {
    // Fetch the result as an associative array
    $row = $result->fetch_assoc();
    // Get the total count
    $ctotalPhysical = $row["total"];
} else {
    $ctotalPhysical = 0;
}

// Close the database connection
$conn->close();
?>
<?php
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

// Fetch the total number of records with category "Physical" from the database
$sql = "SELECT COUNT(*) AS total FROM reports WHERE `Category` = 'children' AND `Type` = 'verbal'";
$result = $conn->query($sql);

// Check if the query was successful
if ($result->num_rows > 0) {
    // Fetch the result as an associative array
    $row = $result->fetch_assoc();
    // Get the total count
    $ctotalVerbal = $row["total"];
} else {
    $ctotalVerbal = 0;
}

// Close the database connection
$conn->close();
?>
<?php
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

// Fetch the total number of records with category "Physical" from the database
$sql = "SELECT COUNT(*) AS total FROM reports WHERE `Category` = 'children' AND `Type` = 'sexual'";
$result = $conn->query($sql);

// Check if the query was successful
if ($result->num_rows > 0) {
    // Fetch the result as an associative array
    $row = $result->fetch_assoc();
    // Get the total count
    $ctotalSexual = $row["total"];
} else {
    $ctotalSexual = 0;
}

// Close the database connection
$conn->close();
?>
<?php
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

// Fetch the total number of records with category "Physical" from the database
$sql = "SELECT COUNT(*) AS total FROM reports WHERE `Category` = 'women' AND `Type` = 'physical'";
$result = $conn->query($sql);

// Check if the query was successful
if ($result->num_rows > 0) {
    // Fetch the result as an associative array
    $row = $result->fetch_assoc();
    // Get the total count
    $wtotalPhysical = $row["total"];
} else {
    $wtotalPhysical = 0;
}

// Close the database connection
$conn->close();
?>
<?php
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

// Fetch the total number of records with category "Physical" from the database
$sql = "SELECT COUNT(*) AS total FROM reports WHERE `Category` = 'women' AND `Type` = 'verbal'";
$result = $conn->query($sql);

// Check if the query was successful
if ($result->num_rows > 0) {
    // Fetch the result as an associative array
    $row = $result->fetch_assoc();
    // Get the total count
    $wtotalVerbal = $row["total"];
} else {
    $wtotalVerbal = 0;
}

// Close the database connection
$conn->close();
?>
<?php
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

// Fetch the total number of records with category "Physical" from the database
$sql = "SELECT COUNT(*) AS total FROM reports WHERE `Category` = 'women' AND `Type` = 'sexual'";
$result = $conn->query($sql);

// Check if the query was successful
if ($result->num_rows > 0) {
    // Fetch the result as an associative array
    $row = $result->fetch_assoc();
    // Get the total count
    $wtotalSexual = $row["total"];
} else {
    $wtotalSexual = 0;
}

// Close the database connection
$conn->close();
?>
<body>
	<div class="header">
		<div class="logo-container">
        <img class="logo" src="originalVoiceLogo.png" alt="LOGO">
        <h1>The Victims' Outreach and Incidents' Control Environment</h1>
       </div>
   </div>
	<div class="container">
		<h2>Children</h2>
		<div class="children">
		<a href="#cphysical">
			<div class="box1">
				<div><h4>Physical</h4>
				</div>
				<div class="total"><?php echo $ctotalPhysical;?>
					<div class="icon"><img src="physical1.png" class="phyicon"></div>
				</div>
			</div>
		</a>
		<a href="#cverbal">
			<div class="box1">
				<div><h4>Verbal</h4>
				</div>
				<div class="total"><?php echo $ctotalVerbal;?>
					<div class="icon"><img src="verbal2.png" class="phyicon"></div>
				</div>
			</div>
		</a>
			<a href="#csexual">
			<div class="box1">
				<div><h4>Sexual</h4>
				</div>
				<div class="total"><?php echo $ctotalSexual;?>
					<div class="icon"><img src="sexual1.png" class="phyicon"></div>
				</div>
			</div>
		</a>
		</div>

		<h2>Women</h2>
		<div class="women">
		
			<div class="box2">
				<div><h4>Physical</h4>
				</div>
				<div class="total"><?php echo $wtotalPhysical;?>
					<div class="icon"><a href="#wphysical"><img src="physical1.png" class="phyicon"></a></div>
				</div>
			</div>
		<a href="#wverbal">
			<div class="box2">
				<div><h4>Verbal</h4>
				</div>
				<div class="total"><?php echo $wtotalVerbal;?>
					<div class="icon"><img src="verbal2.png" class="phyicon"></div>
				</div>
			</div>
		</a>
		<a href="#wsexual">
			<div class="box2">
				<div><h4>Sexual</h4>
				</div>
				<div class="total"><?php echo $wtotalSexual;?>
					<div class="icon"><img src="sexual1.png" class="phyicon"></div>
				</div>
			</div>
		</a>
		</div>
	</div>
	<div class="container2">
	<div class="table">
	<div class="c-physical" id="cphysical">
			<h4>Women Physical Violence Report</h4>
    <table class="tb">
        <tr>
            <th>File_Name</th>
            <th>Sender</th>
            <th>Contact</th>
            <th>Location</th>
            <th>View Location</th>
        </tr>
        <?php
        // Establish a database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "voice";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch data from the 'report' table
        $sql = "SELECT File_Name, Sender, Contact, Location, Latitude, Longitude FROM reports WHERE `Category` = 'children' AND `Type` = 'physical'";
        $result = $conn->query($sql);

        // Check if query execution was successful
        if ($result === false) {
            die("Error executing the query: " . $conn->error);
        }

        // Check if any rows were returned
        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td><a href='reports/" . $row["File_Name"] . "' target='_blank'>" . $row["File_Name"] . "</a></td>";
                echo "<td>" . $row["Sender"] . "</td>";
                echo "<td>" . $row["Contact"] . "</td>";
                 echo "<td>" . $row["Location"] . "</td>";
                echo "<td><a href='#' onclick='openMap(\"" . $row["Latitude"] . "\", \"" . $row["Longitude"] . "\")'>View Location</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No records found</td></tr>";
        }
        $conn->close();
        ?>
    </table>
    </div>
    <div class="c-verbal" id="cverbal">
			<h4>Women Physical Violence Report</h4>
    <table class="tb">
        <tr>
            <th>File_Name</th>
            <th>Sender</th>
            <th>Contact</th>
            <th>Location</th>
            <th>View Location</th>
        </tr>
        <?php
        // Establish a database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "voice";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch data from the 'report' table
        $sql = "SELECT File_Name, Sender, Contact, Location, Latitude, Longitude FROM reports WHERE `Category` = 'children' AND `Type` = 'verbal'";
        $result = $conn->query($sql);

        // Check if query execution was successful
        if ($result === false) {
            die("Error executing the query: " . $conn->error);
        }

        // Check if any rows were returned
        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td><a href='reports/" . $row["File_Name"] . "' target='_blank'>" . $row["File_Name"] . "</a></td>";
                echo "<td>" . $row["Sender"] . "</td>";
                echo "<td>" . $row["Contact"] . "</td>";
                 echo "<td>" . $row["Location"] . "</td>";
                echo "<td><a href='#' onclick='openMap(\"" . $row["Latitude"] . "\", \"" . $row["Longitude"] . "\")' target='#googleMap'>View Location</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No records found</td></tr>";
        }
        $conn->close();
        ?>
    </table>
    </div>
    <div class="c-sexual" id="csexual">
			<h4>Women Physical Violence Report</h4>
    <table class="tb">
        <tr>
            <th>File_Name</th>
            <th>Sender</th>
            <th>Contact</th>
            <th>Location</th>
            <th>View Location</th>
        </tr>
        <?php
        // Establish a database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "voice";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch data from the 'report' table
        $sql = "SELECT File_Name, Sender, Contact, Location, Latitude, Longitude FROM reports WHERE `Category` = 'children' AND `Type` = 'sexual'";
        $result = $conn->query($sql);

        // Check if query execution was successful
        if ($result === false) {
            die("Error executing the query: " . $conn->error);
        }

        // Check if any rows were returned
        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td><a href='reports/" . $row["File_Name"] . "' target='_blank'>" . $row["File_Name"] . "</a></td>";
                echo "<td>" . $row["Sender"] . "</td>";
                echo "<td>" . $row["Contact"] . "</td>";
                 echo "<td>" . $row["Location"] . "</td>";
                echo "<td><a href='#' onclick='openMap(\"" . $row["Latitude"] . "\", \"" . $row["Longitude"] . "\")'>View Location</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No records found</td></tr>";
        }
        $conn->close();
        ?>
    </table>
    </div>
	<div class="w-physical" id="wphysical">
			<h4>Women Physical Violence Report</h4>
    <table class="tb">
        <tr>
            <th>File_Name</th>
            <th>Sender</th>
            <th>Contact</th>
            <th>Location</th>
            <th>View Location</th>
        </tr>
        <?php
        // Establish a database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "voice";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch data from the 'report' table
        $sql = "SELECT File_Name, Sender, Contact, Location, Latitude, Longitude FROM reports WHERE `Category` = 'women' AND `Type` = 'physical'";
        $result = $conn->query($sql);

        // Check if query execution was successful
        if ($result === false) {
            die("Error executing the query: " . $conn->error);
        }

        // Check if any rows were returned
        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td><a href='reports/" . $row["File_Name"] . "' target='_blank'>" . $row["File_Name"] . "</a></td>";
                echo "<td>" . $row["Sender"] . "</td>";
                echo "<td>" . $row["Contact"] . "</td>";
                 echo "<td>" . $row["Location"] . "</td>";
                echo "<td><a href='#' onclick='openMap(\"" . $row["Latitude"] . "\", \"" . $row["Longitude"] . "\")'>View Location</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No records found</td></tr>";
        }
        $conn->close();
        ?>
    </table>
    </div>
    <div class="w-verbal" id="wverbal">
			<h4>Women Verbal Violence Report</h4>
    <table class="tb">
        <tr>
            <th>File_Name</th>
            <th>Sender</th>
            <th>Contact</th>
            <th>Location</th>
            <th>View Location</th>
        </tr>
        <?php
        // Establish a database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "voice";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch data from the 'report' table
        $sql = "SELECT File_Name, Sender, Contact, Location, Latitude, Longitude FROM reports WHERE `Category` = 'women' AND `Type` = 'verbal'";
        $result = $conn->query($sql);

        // Check if query execution was successful
        if ($result === false) {
            die("Error executing the query: " . $conn->error);
        }

        // Check if any rows were returned
        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td><a href='reports/" . $row["File_Name"] . "' target='_blank'>" . $row["File_Name"] . "</a></td>";
                echo "<td>" . $row["Sender"] . "</td>";
                echo "<td>" . $row["Contact"] . "</td>";
                 echo "<td>" . $row["Location"] . "</td>";
                echo "<td><a href='#' onclick='openMap(\"" . $row["Latitude"] . "\", \"" . $row["Longitude"] . "\")'>View Location</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No records found</td></tr>";
        }
        $conn->close();
        ?>
    </table>
    </div>
    <div class="w-sexual" id="wsexual">
			<h4>Women Sexual Violence Report</h4>
    <table class="tb">
        <tr>
            <th>File_Name</th>
            <th>Sender</th>
            <th>Contact</th>
            <th>Location</th>
            <th>View Location</th>
        </tr>
        <?php
        // Establish a database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "voice";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch data from the 'report' table
        $sql = "SELECT File_Name, Sender, Contact, Location, Latitude, Longitude FROM reports WHERE `Category` = 'women' AND `Type` = 'sexual'";
        $result = $conn->query($sql);

        // Check if query execution was successful
        if ($result === false) {
            die("Error executing the query: " . $conn->error);
        }

        // Check if any rows were returned
        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td><a href='reports/" . $row["File_Name"] . "' target='_blank'>" . $row["File_Name"] . "</a></td>";
                echo "<td>" . $row["Sender"] . "</td>";
                echo "<td>" . $row["Contact"] . "</td>";
                 echo "<td>" . $row["Location"] . "</td>";
                echo "<td><a href='#' onclick='openMap(\"" . $row["Latitude"] . "\", \"" . $row["Longitude"] . "\")'>View Location</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No records found</td></tr>";
        }
        $conn->close();
        ?>
    </table>
    </div>

	</div>
		<div class="map">
			 <iframe id="googleMap" height="100%" width="100%" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
		</div>
	</div>
	<script>
        function openMap(latitude, longitude) {
            var mapUrl = 'https://www.google.com/maps?q=' + latitude + ',' + longitude + '&hl=es;z=14&output=embed';
            document.getElementById('googleMap').src = mapUrl;
            document.getElementById('mapContainer').style.display = 'block';
        }
    </script>

</body>
</html>