<?php

require 'connect.php';

function constArray($result) {

	while ($row = $result->fetch_assoc()) {

    	$course_id = $row['course_id'];
    	// $year = $row['year'];
    	$season = $row['season'];
    	$room_no = $row['room_no'];
    	$day = $row['day'];
    	$start_time = $row['start'];
    	$end_time = $row['end'];

    	$buffer[] = array("course_id"=>$course_id,"season"=>$season,"room_no"=>$room_no,"day"=>$day,"start"=>$start_time,"end"=>$end_time);
        // echo $row["course_id"]. "\t" . $row["`course"]. "\t" . $row["faculty"]. "\t" .$row["year"]. "\t" .$row["season"]. "<br>";
    	
	}
	return $buffer;
}

function search($array, $key, $value)
{
    $results = array();

    if (is_array($array)) {
        if (isset($array[$key]) && $array[$key] == $value) {
            $results[] = $array;
        }

        foreach ($array as $subarray) {
            $results = array_merge($results, search($subarray, $key, $value));
        }
    }

    return $results;
}



if (isset($_POST['filter'])) { 

	$output = "";

	if (isset($_POST['headsubmit'])) {

		//courses category is chosen
		if ($_POST['headsubmit']=='Courses') {

			$dummyString = "";
			$dummyQuery = "SELECT title FROM course";
			$results = $conn->query($dummyQuery);

			while ($row = $results->fetch_assoc()) {
				$courseName = $row['title'];
				$dummyString = $dummyString . $courseName . ",";
			}

			$dummyString = substr($dummyString, 0,strlen($dummyString)-1);
			$facResultStr = $dummyString;		//strings to save results of the 3 filters
			$deptResultStr = $dummyString;
			$durResultStr = $dummyString;
			$finalResultStr = "";

			//faculty checkbox is checked 
			if (isset($_POST['faculty'])) {
				$facultyArr = $_POST['facultyArr'];
				$query = "";
				$facString = "";
				$facResultStr = "";
				
				for ($i=0;$i<sizeof($facultyArr);$i++) {
					$facString = $facString.$facultyArr[$i].",";
				}

				// echo "facString is ".$facString."</br>";
				$facString = substr($facString, 0,strlen($facString)-1);
				// echo "facString is ".$facString."</br>";

				$query = "
						SELECT title FROM
						course
						JOIN
						(
							SELECT section_course_id FROM
							teaches
							JOIN
							(
							SELECT ID FROM instructor WHERE FIND_IN_SET(name,?)
							) as t1
							ON instructor_ID = t1.id
						) AS t2
						ON course_id = t2.section_course_id;
						";

				$facStmt = $conn->prepare($query);
				$facStmt->bind_param("s", $facInput);
				
				$facInput = $facString;
				$facStmt->execute();
				$facStmt->bind_result($facResult);
				
				// echo "input is ".$facInput;
				while ($facStmt->fetch()) {
					$facResultStr = $facResultStr . $facResult . ",";
					 // echo "<br>".$facResult;
				}
				$facResultStr = substr($facResultStr, 0,strlen($facResultStr)-1);
				// echo "</br>";
			}

			//department checkbox is checked 
			if (isset($_POST['department'])) {
				$deptArr = $_POST['deptArr'];
				$query = "";
				$deptString = "";
				$deptResultStr = "";
				
				for ($i=0;$i<sizeof($deptArr);$i++) {
					$deptString = $deptString.$deptArr[$i].",";
				}

				//echo "deptString is ".$deptString."</br>";
				$deptString = substr($deptString, 0,strlen($deptString)-1);
				// echo "deptString is ".$deptString."</br>";
				// $facResultStr = substr($facResultStr, 0,strlen($facResultStr)-1);
				// echo $facResultStr;

				$query = "
						SELECT title FROM 
						course 
						WHERE
						FIND_IN_SET(department_dpt_name,?);
						";
				// if($facResultStr=="") {
				// 	$query = $query . ";";
				$deptStmt = $conn->prepare($query);
				$deptStmt->bind_param("s", $deptInput);
				// }
				// else {
				// 	$query = $query . " AND FIND_IN_SET(title,?)" . ";";
				// 	$deptStmt = $conn->prepare($query);
				// 	$deptStmt->bind_param("ss", $input, $input2);

				// }
				
				$deptInput = $deptString;
				// $input2 = $facResultStr;
				$deptStmt->execute();
				$deptStmt->bind_result($deptResult);
				
				while ($deptStmt->fetch()) {
					$deptResultStr = $deptResultStr . $deptResult . ",";
					// echo "<br>".$deptResult;
				}
				$deptResultStr = substr($deptResultStr, 0,strlen($deptResultStr)-1);
				// echo "</br>";
			}

			//duration checkbox is checked 
			if (isset($_POST['duration'])) {
				$durResultStr = "";
				$fromSeason = $_POST['fromSeason'];
				$fromYear = $_POST['fromYear'];
				$toSeason = $_POST['toSeason'];
				$toYear = $_POST['toYear'];
				$flag=0;	//flag used to ensure that query processing happens only in "legal" cases
				// echo "toYear is " . $toYear;

				$query ="
						SELECT title from course 
						JOIN
						(
							SELECT section_course_id FROM teaches 
							WHERE 
							(section_year > ? AND section_year < ?)";
				
				if ($fromYear < $toYear) {
					$flag=1;

					if ($fromSeason == "Spring") {
						if ($toSeason == "Spring") {
							$query = $query . "OR (section_year = ?) OR (section_year = ? AND section_semester = 'Spring')";
						}
						else if ($toSeason == "Fall") {
							$query = $query . "OR (section_year = ?) OR (section_year = ?)";
						}
					}

					if ($fromSeason == "Fall") {
						if ($toSeason == "Spring") {
							$query = $query . "OR (section_year = ? AND section_semester = 'Fall') OR (section_year = ? AND section_semester = 'Spring')";
						}
						else if ($toSeason == "Fall") {
							$query = $query . "OR (section_year = ? AND section_semester = 'Fall') OR (section_year = ?)";
						}
					}
				}

				else if ($fromYear == $toYear && !($fromSeason=='Fall' && $toSeason=='Spring')) {
					$flag=1;
					if ($fromSeason == "Spring") {
						if ($toSeason == "Spring") {
							$query = $query . "OR (section_year = ? AND section_semester = 'Spring') OR (section_year = ? AND section_semester = 'Spring')";
						}
						else if ($toSeason == "Fall") {
							$query = $query . "OR (section_year = ?) OR (section_year = ?)";
						}
					}	

					if ($fromSeason == "Fall") {
						if ($toSeason == "Fall") {
							$query = $query . "OR (section_year = ? AND section_semester = 'Fall') OR (section_year = ? AND section_semester = 'Fall')";
						}
					}
				}

				if($flag==1){

					$query = $query . ") as t1
								  ON course_id = t1.section_course_id;
								  ";
							

				$durStmt = $conn->prepare($query);
				$durStmt->bind_param("ssss", $fYear,$tYear,$fYear,$tYear);
				
				$fYear = $fromYear;
				$tYear = $toYear;
				$list = $durStmt->execute();
				$durStmt->bind_result($durResult);
				
				// echo "input is ".$input;
				while ($durStmt->fetch()) {
					$durResultStr = $durResultStr . $durResult . ",";
					// echo "<br>".$durResult;
				}
				$durResultStr = substr($durResultStr, 0,strlen($durResultStr)-1);
				// echo "</br>";

				}
				
				
			}

			//taking intersection of all filters
			$finalQuery = "SELECT title 
							FROM course 
							WHERE FIND_IN_SET(title,?) AND FIND_IN_SET(title,?) AND FIND_IN_SET(title,?)";
			
			$finalStmt = $conn->prepare($finalQuery);
			$finalStmt->bind_param("sss", $fac,$dept,$dur);
			// echo "facResStr is " . $facResultStr. "<br>";
			// echo "deptResStr is " . $deptResultStr. "<br>";
			// echo "durResStr is " . $durResultStr. "<br>";

			$fac = $facResultStr;
			$dept = $deptResultStr;
			$dur = $durResultStr;
			$finalStmt->execute();
			$finalStmt->bind_result($finalResult);
			echo"<script>
			var Table = document.getElementsByClassName('rwd-table');
		Table.innerHTML = '';
		</script>";

			$output1 = 
			 '<table class="rwd-table" id="pq">'
			 .'<tbody>'
			 .'<tr>'
			 .'<th>'.'Course Name'.'</th>'
			 .'</tr>';

	 		$output2='';
			// echo "final results: ". "</br>";
			while ($finalStmt->fetch()) {
				// $finalResultStr = $finalResultStr . $finalResult . ",";
				$output2 = $output2.
	 		'<tr><td data-th="Course Name">'.$finalResult.'</td></tr>';

				// echo "<br>".$finalResult;
			}
			 $output3 =
	 		'</tbody>'
	 		.'</table><br>';
			// $finalResultStr = substr($finalResultStr, 0,strlen($finalResultStr)-1);
			// echo "</br>";

			$output =  $output1.$output2.$output3;
			echo $output;
		}

		/**************************************************************************************************/

		//faculty category is chosen
		else if ($_POST['headsubmit']=='Faculty') {	

			$dummyString = "";
			$dummyQuery = "SELECT Name FROM instructor";
			$results = $conn->query($dummyQuery);

			while ($row = $results->fetch_assoc()) {
				$facName = $row['Name'];
				$dummyString = $dummyString . $facName . ",";
			}

			$dummyString = substr($dummyString, 0,strlen($dummyString)-1);
			$courseResultStr = $dummyString;		//strings to save results of the 3 filters
			$deptResultStr = $dummyString;
			$durResultStr = $dummyString;
			$finalResultStr = "";

			//course checkbox is checked 
			if (isset($_POST['courses'])) {
				$courseArr = $_POST['courseArr'];
				$query = "";
				$courseStr = "";
				$courseResultStr = "";
				
				for ($i=0;$i<sizeof($courseArr);$i++) {
					$courseStr = $courseStr.$courseArr[$i].",";
				}

				// echo "courseStr is ".$courseStr."</br>";
				$courseStr = substr($courseStr, 0,strlen($courseStr)-1);
				// echo "courseStr is ".$courseStr."</br>";

				$query = "
						SELECT Name FROM 
						instructor 
						JOIN
						(
							SELECT instructor_ID FROM
							teaches
							JOIN
							(
							SELECT course_id FROM course WHERE FIND_IN_SET(title,?)  
							) as t1
							ON section_course_id = t1.course_id
						) AS t2
						ON ID = t2.instructor_ID;
						";

				$courseStmt = $conn->prepare($query);
				$courseStmt->bind_param("s", $courseInput);
				
				$courseInput = $courseStr;
				$courseStmt->execute();
				$courseStmt->bind_result($courseResult);
				
				// echo "input is ".$input;
				while ($courseStmt->fetch()) {
					$courseResultStr = $courseResultStr . $courseResult . ",";
					// echo "<br>".$courseResult;
				}
				$courseResultStr = substr($courseResultStr, 0,strlen($courseResultStr)-1);
				// echo "</br>";
			}

			//department checkbox is checked 
			if (isset($_POST['department'])) {
				$deptArr = $_POST['deptArr'];
				$query = "";
				$deptString = "";
				$deptResultStr = "";
				
				for ($i=0;$i<sizeof($deptArr);$i++) {
					$deptString = $deptString.$deptArr[$i].",";
				}

				//echo "deptString is ".$deptString."</br>";
				$deptString = substr($deptString, 0,strlen($deptString)-1);
				// echo "deptString is ".$deptString."</br>";
				// $facResultStr = substr($facResultStr, 0,strlen($facResultStr)-1);
				// echo $facResultStr;

				$query = "
						SELECT Name FROM 
						instructor 
						WHERE
						FIND_IN_SET(department_dpt_name,?);
						";
				// if($facResultStr=="") {
				// 	$query = $query . ";";
				$deptStmt = $conn->prepare($query);
				$deptStmt->bind_param("s", $deptInput);
				// }
				// else {
				// 	$query = $query . " AND FIND_IN_SET(title,?)" . ";";
				// 	$deptStmt = $conn->prepare($query);
				// 	$deptStmt->bind_param("ss", $input, $input2);

				// }
				
				$deptInput = $deptString;
				// $input2 = $facResultStr;
				$deptStmt->execute();
				$deptStmt->bind_result($deptResult);
				
				while ($deptStmt->fetch()) {
					$deptResultStr = $deptResultStr . $deptResult . ",";
					// echo "<br>".$deptResult;
				}
				$deptResultStr = substr($deptResultStr, 0,strlen($deptResultStr)-1);
				// echo "</br>";
			}

			//duration checkbox is checked 
			if (isset($_POST['duration'])) {
				$durResultStr = "";
				$fromSeason = $_POST['fromSeason'];
				$fromYear = $_POST['fromYear'];
				$toSeason = $_POST['toSeason'];
				$toYear = $_POST['toYear'];
				$flag=0;	//flag used to ensure that query processing happens only in "legal" cases
				// echo "toYear is " . $toYear;

				$query ="
						SELECT Name from instructor 
						JOIN
						(
							SELECT instructor_ID FROM teaches 
							WHERE
							(section_year > ? AND section_year < ?)";
				
				if ($fromYear < $toYear) {
					$flag=1;

					if ($fromSeason == "Spring") {
						if ($toSeason == "Spring") {
							$query = $query . "OR (section_year = ?) OR (section_year = ? AND section_semester = 'Spring')";
						}
						else if ($toSeason == "Fall") {
							$query = $query . "OR (section_year = ?) OR (section_year = ?)";
						}
					}

					if ($fromSeason == "Fall") {
						if ($toSeason == "Spring") {
							$query = $query . "OR (section_year = ? AND section_semester = 'Fall') OR (section_year = ? AND section_semester = 'Spring')";
						}
						else if ($toSeason == "Fall") {
							$query = $query . "OR (section_year = ? AND section_semester = 'Fall') OR (section_year = ?)";
						}
					}
				}

				else if ($fromYear == $toYear && !($fromSeason=='Fall' && $toSeason=='Spring')) {
					$flag=1;
					if ($fromSeason == "Spring") {
						if ($toSeason == "Spring") {
							$query = $query . "OR (section_year = ? AND section_semester = 'Spring') OR (section_year = ? AND section_semester = 'Spring')";
						}
						else if ($toSeason == "Fall") {
							$query = $query . "OR (section_year = ?) OR (section_year = ?)";
						}
					}	

					if ($fromSeason == "Fall") {
						if ($toSeason == "Fall") {
							$query = $query . "OR (section_year = ? AND section_semester = 'Fall') OR (section_year = ? AND section_semester = 'Fall')";
						}
					}
				}

				if($flag==1){

					$query = $query . ") as t1
								  ON ID = t1.instructor_ID;
								  ";
							

				$durStmt = $conn->prepare($query);
				$durStmt->bind_param("ssss", $fYear,$tYear,$fYear,$tYear);
				
				$fYear = $fromYear;
				$tYear = $toYear;
				$list = $durStmt->execute();
				$durStmt->bind_result($durResult);
				
				// echo "input is ".$input;
				while ($durStmt->fetch()) {
					$durResultStr = $durResultStr . $durResult . ",";
					// echo "<br>".$durResult;
				}
				$durResultStr = substr($durResultStr, 0,strlen($durResultStr)-1);
				// echo "</br>";

				}
				
				
			}

			//taking intersection of all filters
			$finalQuery = "SELECT Name 
							FROM instructor 
							WHERE FIND_IN_SET(Name,?) AND FIND_IN_SET(Name,?) AND FIND_IN_SET(Name,?)";
			
			$finalStmt = $conn->prepare($finalQuery);
			$finalStmt->bind_param("sss", $fac,$dept,$dur);
			// echo "facResStr is " . $courseResultStr. "<br>";
			// echo "deptResStr is " . $deptResultStr. "<br>";
			// echo "durResStr is " . $durResultStr. "<br>";

			$fac = $courseResultStr;
			$dept = $deptResultStr;
			$dur = $durResultStr;
			$finalStmt->execute();
			$finalStmt->bind_result($finalResult);
			
			$output1 = 
			 '<table class="rwd-table" id="pq">'
			 .'<tbody>'
			 .'<tr>'
			 .'<th>'.'Faculty Name'.'</th>'
			 .'</tr>';

	 		$output2='';
			// echo "final results: ". "</br>";
			while ($finalStmt->fetch()) {
				// $finalResultStr = $finalResultStr . $finalResult . ",";
				$output2 = $output2.
	 		'<tr><td data-th="Faculty Name">'.$finalResult.'</td></tr>';

				// echo "<br>".$finalResult;
			}
			 $output3 =
	 		'</tbody>'
	 		.'</table><br>';
			// $finalResultStr = substr($finalResultStr, 0,strlen($finalResultStr)-1);
			// echo "</br>";

			$output =  $output1.$output2.$output3;
			echo $output;
		}

		/**************************************************************************************************/

		//faculty category is chosen
		else if ($_POST['headsubmit']=='Timetable') {
			
			if (isset($_POST['timetableYear'])) {
				$year = $_POST['timetableYear'];

				$result = $conn->query("SELECT course_id,year,semester as season,classroom_room_number as room_no,day,start,end,time_slot_id FROM time_slot 
				INNER JOIN section ON time_slot_id = time_slot_time_slot_id WHERE year=$year;" );
				// $result = $conn->query("SELECT * FROM timetable WHERE year=$year");

				if ($result->num_rows > 0) {
					$outputArr = constArray($result);
					// print_r($outputArr);
					// echo json_encode($outputArr,true);
					$week = array("Monday","Tuesday","Wednesday","Thursday","Friday");
					$timings = array("08:30:00","10:00:00","11:30:00","14:30:00","16:00:00","17:30:00","19:00:00");
					$monday = search($outputArr, 'day', 'Monday');
					$tuesday = search($outputArr, 'day', 'Tuesday');
					$wednesday = search($outputArr, 'day', 'Wednesday');
					$thursday = search($outputArr, 'day', 'Thursday');
					$friday = search($outputArr, 'day', 'Friday');
					// print_r($monday);
					// echo count($monday);
					// print_r(array_values($outputArr));

					echo '<table border="1">';
					echo '<table class="rwd-table">';
					echo '<tbody>';

					echo "<tr>\n"
				    	."<th>Day</th>\n"
				    	.'<th>Timings</th>'
				    	.'<th>LH3</th>'
				    	.'<th>LH2</th>'
				    	.'<th>LH1</th>'
				    	.'<th>116</th>'
				    	.'<th>118</th>'
				    	.'<th>120</th>'
				    	.'<th>121</th>'
				    	.'<th>123</th>'
				    	.'<th>126</th>'
				    	.'<th>127</th>'
				    	.'<th>128</th>'
				    	.'<th>129</th>'
				    	.'<th>130</th>'
				    	.'<th>131</th>'
				    	.'<th>132</th>'
				    	.'<th>133</th>'
				    	.'<th>134</th>'
				    	.'<th>201</th>'
				    	.'<th>205</th>'
				    	.'</tr>';

				    	$roomnumber = array("LH3","LH2","LH1","116","118","120","121","123","126","127","128","129","130","131","132","133","134","201","205");
				    	

				    	for ($i=0; $i < count($week); $i++) {
				    	
				    		echo '<tr><td data-th="Day">'.$week[$i].'</td>';
				    		
				    		for ($j=0; $j<count($timings); $j++) { 
				    			
				    			echo '<td data-th="Timings">'.$timings[$j].'</td>';

				    			$result='';
				    			if ($i==0) {
				    				$daytable= search($monday,'start',$timings[$j]);
				    			}
				    			else if($i==1){
				    				$daytable = search($tuesday,'start',$timings[$j]);
				    			}
				    			else if($i==2){
				    				$daytable = search($wednesday,'start',$timings[$j]);
				    			}
				    			else if($i==3){
				    				$daytable = search($thursday,'start',$timings[$j]);
				    			}
				    			else if($i==4){
				    				$daytable = search($friday,'start',$timings[$j]);
				    			}
				    			
				    			//print_r( $daytable);
				    			
				    				
				    				for ($p=0; $p <count($roomnumber) ; $p++) { 
				    					$result="";
				    				//	$temp = search($daytable,'room_no',$roomnumber$p]);
				    					$temp=search($daytable,'room_no',$roomnumber[$p]);
				    					
				    				// print_r($temp);
				    				//echo '<br>';
				    					for($r=0;$r<count($temp);$r++){

				    						$result=$result.$temp[$r]['course_id'].'</br>';
				    						
				    					}
				    					
				    					if($result)
				    					{
				    						$result = substr($result, 0,strlen($result)-1);
				    						
				    						
				    					echo '<td data-th="$roomnumber[p]">'.$result.'</td>';
				    					}
				    					else
				    						echo '<td data-th="$roomnumber[p]">'.'</td>';
				    					
				    				}
				    				
				    			echo '</tr>';
				    			echo '<tr><td data-th="Day">'.'</td>';
				    			
				    		}
				    	echo '</tr>';
				    }

					echo '</tbody>';
					echo '</table>';

				} else {
			    	echo "0 results";
				}
			}
		}
	}
}
?>