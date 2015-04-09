<?php
	include 'verify.php'
?>

<!DOCTYPE html>
<html>
	<head>
        <title>Login</title>
        <link rel="shortcut icon" href="img/ico.jpg">
        <link rel="stylesheet" href="css/login.css" type="text/css">
        
	</head>

	<body>

		<?php
            // Div to echo the login errors
            if(isset($_SESSION['msg']['login-err'])) {
                echo '<div id="logerr">'."Note: ".$_SESSION['msg']['login-err'].'</div>';
                unset($_SESSION['msg']['login-err']);
            }
        ?>

		<div id="wrapper">

			<form name="login-form" class="login-form" action="" method="post">

				<div class="header">
					<h1>
						Login
						<a id="home" href="?home">Back to Home</a>
					</h1>
				</div>
			
				<div class="content">
					<input name="username" type="text" class="input username" placeholder="Username" required/>
					<div class="user-icon"></div>
					<input name="password" type="password" class="input password" placeholder="Password" required/>
					<div class="pass-icon"></div>		
				</div>

				<div class="footer">
				<input type="submit" name="submit" value="Login" class="button" />
				</div>
			
			</form>

		</div>

		<div class="gradient"></div>

	</body>

</html>

<?php

if(isset($_GET['home'])) {
    header("Location: welcome.php");
    exit;
}

?>