<?php
	
require 'connect.php';

$category = $_POST['category'];
$results = $conn->query("SELECT * FROM $category");



if($category == 'course') {
	while ($row = $results->fetch_assoc()) {
		$course_id = $row['course_id'];
		$title = $row['title'];
		$credits = $row['credits'];
		$reg_students = $row['reg_students'];
		$department_dpt_name = $row['department_dpt_name'];

		$buffer[] = array("course_id"=>$course_id, "title"=>$title, "credits"=>$credits, "reg_students"=>$reg_students, "department_dpt_name"=>$department_dpt_name);
	}
	// print_r($buffer);
	$output1 = 
	 '<table class="rwd-table"><br>'
	 .'<tbody><br>'
	 .'<tr><br>'

	 .'<th>'.'Course Id'.'</th><br>'
	 .'<th>'.'Title'.'</th><br>'
	 .'<th>'.'Credits'.'</th><br>'
	 .'<th>'.'Department'.'</th><br>'
	 .'</tr><br>';
	 $output2='';
	 for ($i=0; $i<count($buffer) ; $i++) { 
	 	$output2 = $output2.
	 	'<tr><td data-th="Course Id">'.$buffer[$i]['course_id'].'</td>'
	 	.'<td data-th="Title">'.$buffer[$i]['title'].'</td>'
	 	.'<td data-th="Credits">'.$buffer[$i]['credits'].'</td>'
	 	.'<td data-th="Department">'.$buffer[$i]['department_dpt_name'].'</td></tr>';
	 }

	 $output3 =
	 '</tbody><br>'
	 .'</table><br>';
}

else if($category == 'instructor') {
	while ($row = $results->fetch_assoc()) {
		$ID = $row['ID'];
		$Name = $row['Name'];
		$department_dpt_name = $row['department_dpt_name'];

		$buffer[] = array("ID"=>$ID, "Name"=>$Name, "department_dpt_name"=>$department_dpt_name);
	}

	$output1 = 
	 '<table class="rwd-table" $id="dl">'
	 .'<tbody><br>'
	 .'<tr><br>'

	 .'<th>'.'Name'.'</th><br>'
	 .'<th>'.'Department'.'</th><br>'
	 .'</tr><br>';
	 $output2='';
	 for ($i=0; $i<count($buffer) ; $i++) { 
	 	$output2 = $output2. 
	 	'<td data-th="Name">'.$buffer[$i]['Name'].'</td>'
	 	.'<td data-th="Department">'.$buffer[$i]['department_dpt_name'].'</td></tr>';
	 }

	 $output3 =
	 '</tbody><br>'
	 .'</table><br>';
}
$output =  $output1.$output2.$output3;
echo $output;

// $encodedBuffer = json_encode($buffer,true);
// $encodedBuffer = json_encode($output,true);
// echo ($encodedBuffer);