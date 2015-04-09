<?php
	require 'insertQuery.php';
?>

<!DOCTYPE html>
<html>
	<head>
        <title>Add Course Info</title>
        <link rel="shortcut icon" href="img/ico.jpg">
        <link rel="stylesheet" href="css/login.css" type="text/css">
        
	</head>

	<body>

		<div id="wrapper">

			<form name="insert-form" class="login-form" id ="insert-form" action="" method="post">
			
				<div class="header">
				<h1>
					Add Course Information
					<a id="logout" href="?logoff">Logout</a>
				</h1>
				
				</div>
			
				<div class="content">
					<input name="facName" type="text" class="input facName" placeholder="Faculty Name" required/>
					<input name="deptName" type="text" class="input deptName" placeholder="Department" required/><br>
					<input name="courseId" type="text" class="input courseId" placeholder="Course ID" required/>
					<input name="courseTitle" type="text" class="input courseTitle" placeholder="Course Title" required/>
					<input name="credits" type="text" class="input credits" placeholder="# of Credits" required/><br>

					<select id="season" name="season" class="input season" id ="season">
						<option value="Fall" class="fall">Fall</option>
						<option value="Spring">Spring</option>
					</select>

					<input name="year" type="text" class="input year" id ="year" placeholder="Year" required/>

					<div id="courseDay1">
						<select name="day1" class="input day">
							<option value="Monday">Monday</option>
							<option value="Tuesday">Tuesday</option>
							<option value="Wednesday">Wednesday</option>
							<option value="Thursday">Thursday</option>
							<option value="Friday">Friday</option>
							<option value="Saturday">Saturday</option>
						</select>
						<input type="time" name="fromTime1" class="input fromTime" placeholder="From- 00:00">
						<input type="time" name="toTime1" class="input toTime" placeholder="To- 00:00">
						<input type="text" name="room1" class="input room" placeholder="Room Number" style="display: inline">
					</div>

					<div id="courseDay2">
						<select name="day2" class="input day">
							<option value="Monday">Monday</option>
							<option value="Tuesday">Tuesday</option>
							<option value="Wednesday">Wednesday</option>
							<option value="Thursday">Thursday</option>
							<option value="Friday">Friday</option>
							<option value="Saturday">Saturday</option>
						</select>
						<input type="time" name="fromTime2" class="input fromTime" placeholder="From- 00:00">
						<input type="time" name="toTime2" class="input toTime" placeholder="To- 00:00">
						<input type="text" name="room2" class="input room" placeholder="Room Number" style="display: inline">
					</div>

					<input name="regStudents" style="display: inline" type="text" class="input regStudents" placeholder="# of Registered Students" required/>

				</div>

				<div class="footer">
				<input type="submit" name="insertBtn" value="Insert" class="button" />
				</div>
			
			</form>

		</div>

		<div class="gradient"></div>

	</body>

</html>

<?php

	// if(!isset($_SESSION['id'])) {
	// 	// echo $_SESSION['id'];
	// 	header("Location: login.php");
	// 	exit;
	// }

	if(isset($_GET['logoff'])) {
		$_SESSION = array();
		session_destroy();

		header("Location: login.php");
		exit;
	}

?>