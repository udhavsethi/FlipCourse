<?php
	
require 'connect.php';

if (isset($_POST['insertBtn'])) {

	$facName = $_POST['facName'];
	$deptName = $_POST['deptName'];
	$courseId = $_POST['courseId'];
	$courseTitle = $_POST['courseTitle'];
	$credits = $_POST['credits'];
	$season = $_POST['season'];
	$year = $_POST['year'];
	$regStudents = $_POST['regStudents'];
	
	$day1 = $_POST['day1'];
	$fromTime1 = $_POST['fromTime1'];
	$toTime1 = $_POST['toTime1'];
	$room1 = $_POST['room1'];

	$day2 = $_POST['day2'];
	$fromTime2 = $_POST['fromTime2'];
	$toTime2 = $_POST['toTime2'];
	$room2 = $_POST['room2'];

	//insert into classroom
	$query = "INSERT into classroom VALUES (?,?)";
	$classStmt = $conn->prepare($query);
	$classStmt->bind_param("ss", $room,$regSt);
	
	$regSt = $regStudents;
	$room = $room1;
	$classStmt->execute();

	$regSt = $regStudents;
	$room = $room2;
	$classStmt->execute();

	//insert into department
	$query = "INSERT into department VALUES (?)";
	$deptStmt = $conn->prepare($query);
	$deptStmt->bind_param("s",$deptN);
	
	$deptN = $deptName;
	$deptStmt->execute();

	//insert into instructor
	$query = "INSERT into instructor VALUES ('NULL',?,?)";
	$instStmt = $conn->prepare($query);
	$instStmt->bind_param("ss",$facN,$deptNa);
	
	$facN = $facName;
	$deptNa = $deptName;
	$instStmt->execute();

	$lastId = mysqli_insert_id($conn);			//saving the id inserted into instructor
												// to be used to insert in teaches

	//insert into course
	$query = "INSERT into course VALUES (?,?,?,?,?)";
	$courseStmt = $conn->prepare($query);
	$courseStmt->bind_param("sssss",$courseI,$courseT,$cred,$regS,$deptNam);
	
	$courseI = $courseId;
	$courseT = $courseTitle;
	$cred = $credits;
	$regS = $regStudents;
	$deptNam= $deptName;
	$courseStmt->execute();

	//insert into section
	$query = "INSERT into section VALUES (?,?, ?, ?,'1',?)";
	$sectionStmt = $conn->prepare($query);
	$sectionStmt->bind_param("sssss",$scId,$sea,$yea,$couI,$roomN);
	
	$sea = $season;
	$yea = $year;
	$couI = $courseId;

	$roomN = $room1;
	$scId = '1';
	$sectionStmt->execute();

	$roomN = $room2;
	$scId = '2';
	$sectionStmt->execute();

	//insert into teaches
	// $query="SELECT  FROM instructor";
	$query = "INSERT into teaches VALUES (?,?, '1', ?, ?)";
	$teachesStmt = $conn->prepare($query);
	$teachesStmt->bind_param("ssss",$lastI,$crsId,$seas,$ye);
	
	$lastI = $lastId;
	$crsId = $courseId;
	$seas = $season;
	$ye = $year;
	$teachesStmt->execute();

	echo "<script>alert('Your course information has been added successfully!');</script>";
}

?>