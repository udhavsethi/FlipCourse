<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<!-- <link rel="stylesheet" type="text/css" href="css/tableSheet.css"> -->
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<link rel="stylesheet" type="text/css" href="css/tablestyle.css">


	<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
  	<!-- // <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script> -->
  	<script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/scripts.js"></script>
	<!-- // <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script> -->
	<script type="text/javascript" src="js/elements.js"></script>
</head>

<body>

<nav class="navbar navbar-static">
    <div class="container">
      <a class="navbar-toggle" data-toggle="collapse" data-target=".nav-collapse">
        <span class="glyphicon glyphicon-chevron-down"></span>
      </a>
      <div class="nav-collapse collase">
        <ul class="nav navbar-nav">  
          <li><a href="welcome.php">Home</a></li>
          <!-- <li><a href="explore.php">Link</a></li> -->
          <li><a href="about.php">About</a></li>
        </ul>
      </div>		
    </div>
</nav><!-- /.navbar -->

<header class="masthead">
  <div class="container">
    <div class="row">
      <div class="col col-sm-6">
        <h1><a href="explore.php" title="scroll down for your viewing pleasure">DBMS Project</a>
          <!-- <p class="lead">Group Members</p> --></h1>
      </div>
    </div>
  </div>

</header>

<div class="container">
	<div class="row">
  			<div class="col col-sm-3">
          		<div class="panel">
         			 <h2>Options</h2>

	<form name="filterForm" id="filterForm" action="" method="post" >
	
	<!-- Header Buttons -->
	<div class="header">
		<!-- <form name="main-form" id="main-form" action="" method="post"> -->
			<input type="radio" name="headsubmit" value="Courses" id="coursebtn" checked="false" onclick="showCourses();" />Courses
			<input type="radio" name="headsubmit" value="Faculty" id="facultybtn" checked="false" onclick="showFaculty();" />Faculty
			<input type="radio" name="headsubmit" value="Timetable" id="timetablebtn" checked="false" onclick="showTimetable();" />TimeTable
		<!-- </form> -->
	</div>

	<!-- Filters -->
	<div id="courseWrapper" style="display:none">
		<input type="checkbox" name="courses" value="Courses" onclick="changeVisibility('courseDiv')">Courses</br>
		<div id= "courseDiv" style="display:none">
			<input type="text" placeholder="Course Name" name="courseArr[]"></input>
			<button onclick="addCourseInput(); return false;">Add</button>
		</div>
	</div>

	<div id="facultyWrapper" style="display:none">
		<input type="checkbox" name="faculty" value="Faculty" onclick="changeVisibility('facultyDiv')">Faculty</br>
		<div id= "facultyDiv" style="display:none">
			<input type="text" placeholder="Faculty Name" name="facultyArr[]"></input>
			<button onclick="addFacultyInput(); return false;">Add</button>
		</div>
	</div>

	<div id="deptWrapper" style="display:none">
		<input type="checkbox" name="department" value="Department" onclick="changeVisibility('deptDiv')">Department</br>
		<div id= "deptDiv" style="display:none; margin-left:1.5%">
			<input type="checkbox" name="deptArr[]" value="Biomedical Engineering">Biomedical Engineering</br>
			<input type="checkbox" name="deptArr[]" value="Biotechnology">Biotechnology</br>
			<input type="checkbox" name="deptArr[]" value="Chemical Engineering">Chemical Engineering</br>
			<input type="checkbox" name="deptArr[]" value="Chemistry">Chemistry</br>
			<input type="checkbox" name="deptArr[]" value="Civil Engineering">Civil Engineering</br>
			<input type="checkbox" name="deptArr[]" value="Computer Science and Engineering">Computer Science and Engineering</br>
			<input type="checkbox" name="deptArr[]" value="Design">Design</br>
			<input type="checkbox" name="deptArr[]" value="Electrical Engineering">Electrical Engineering</br>
			<input type="checkbox" name="deptArr[]" value="Engineering Science">Engineering Science</br>
			<input type="checkbox" name="deptArr[]" value="Liberal Arts">Liberal Arts</br>
			<input type="checkbox" name="deptArr[]" value="Mathematics">Mathematics</br>
			<input type="checkbox" name="deptArr[]" value="Materials Science and Metallurgical Engineering">Materials Science and Metallurgical Engineering</br>
			<input type="checkbox" name="deptArr[]" value="Mechanical Engineering">Mechanical Engineering</br>
			<input type="checkbox" name="deptArr[]" value="Physics">Physics</br>
		</div>
	</div>

	<div id="durationWrapper" style="display:none">
		<input type="checkbox" name="duration" value="Duration" onclick="changeVisibility('durationDiv'); populateYears()">Duration</br>
		<div id= "durationDiv" style="display:none">
			<select id="fromSeason" name="fromSeason">
				<option value="Fall">Fall</option>
				<option value="Spring">Spring</option>
			</select>
			<select id="fromYear" name="fromYear"></select>

			<select id="toSeason" name="toSeason">
				<option value="Fall">Fall</option>
				<option value="Spring">Spring</option>
			</select>
			<select id="toYear" name="toYear"></select>
		</div>
	</div>

	<div id="timetableWrapper" style="display:none">
		<select id="timetableYear" name="timetableYear" value="Timetable"></select>
	</div>

	<input type="submit" name="filter" value="Filter"></input>


</form>

</div>
      		</div>  
      		<div class="col col-sm-9">
              <div>
              <h2>Query Results</h2>
                <hr>
					<div id="resultDiv"> </div>

                  <table class="rwd-table" id='table'>
                  	<?php
                  		require 'processQuery.php'; 
                  	?>
                  </table>
                </div>
      	</div> 
  	</div>
</div>


</body>
</html> 	

