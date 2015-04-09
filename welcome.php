<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
    <link rel="stylesheet" href="css/welcome.css" type="text/css">
</head>

<body>
    <div class="header">
    <h1>Welcome!</h1>
    <h2>You can now..</h2>
    </div>

    <nav>
        <ul class="nav">
            <li>
              <a href="?explore">
                <span class="icon-home">Explore Courses</span>
                <span class="screen-reader-text">Home</span>
              </a>
            </li>
            <li>
              <a href="?add">
                <span class="icon-cog">Add Courses</span>
                <span class="screen-reader-text">Settings</span>
              </a>
          </li>
        </ul>
    </nav>
</body>

</html>

<?php

if(isset($_GET['explore'])) {
    header("Location: explore.php");
    exit;
}

if(isset($_GET['add'])) {
    header("Location: login.php");
    exit;
}

?>