<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Responsive Header</title>
<style>
/* Basic styles */
body {
  margin: 0;
  font-family: Arial, sans-serif;
  background-color: #f0f0f0;
}

.hcontainer {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background-color: #333;
  padding: 10px 20px;
  box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
}

.logo img {
  width: 40px;
  height: 40px;
}

.title {
  color: #fff;
  margin-left: 10px;
  font-size: 18px;
}
/* Media query for responsive design */
@media screen and (max-width: 768px) {
  .container {
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
</style>
</head>
<body>
<header class="container">
  <div class="logo"><img src="originalVoiceLogo.png"></div>
  <h1 class="title">The Victims' Outreach and Incidents' Control Environment</h1>
</header>

<script>
function toggleMenu() {
  const navLinks = document.querySelector('.nav-links');
  navLinks.classList.toggle('show');
}
</script>

</body>
</html>
