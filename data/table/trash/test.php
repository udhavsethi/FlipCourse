<!DOCTYPE html>
<!-- sudo /opt/lampp/lampp stop -->
<html>
<head>
<title>Time Table</title>
	<link rel="stylesheet" type="text/css" href="tablestyle.css">
	<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
  	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
	<!-- // <script type="text/javascript" src="timetable.js"></script> -->
</head>

<body>
	<br>
	<form id="getTimeTable" name="getTimeTable" class="getTimeTable" method="post" action="">
	Year: <input type="text" name="year"><br>
	<input type="submit" name="submit" value="Submit">
	</form>
	<!-- <input type="submit" name="getTimeTable" value="timetable" id="timetable" /> -->

	<div class="table">

	</div>
</body>
</html>

<?php 
	require 'process.php';
?>