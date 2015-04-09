<?php

require 'connect.php';

function constArray($result) {

	while ($row = $result->fetch_assoc()) {

    	$course_id = $row['course_id'];
    	$course = $row['course'];
    	$faculty = $row['faculty'];
    	// $year = $row['year'];
    	$season = $row['season'];
    	$room_no = $row['room_no'];
    	$day = $row['day'];
    	$credits = $row['credits'];
    	$start_time = $row['start_time'];
    	$end_time = $row['end_time'];

    	$buffer[] = array("course_id"=>$course_id, "course"=>$course, "faculty"=>$faculty, "season"=>$season,"room_no"=>$room_no,"day"=>$day,"credits"=>$credits,"start_time"=>$start_time,"end_time"=>$end_time);
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

if (isset($_POST['submit'])) {
	
	$year = $_POST['year'];
	$result = $conn->query("SELECT * FROM timetable WHERE year=$year");
		
		if ($result->num_rows > 0) {
			$outputArr = constArray($result);
			echo json_encode($outputArr,true);
			$week = array("Monday","Tuesday","Wednesday","Thursday","Friday");
			$timings = array("08:30:00","10:00:00","11:30:00","14:30:00","16:00:00","17:30:00","19:00:00");
			$monday = search($outputArr, 'day', 'Monday');
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
		    	.'</tr>';
		    	for ($i=0; $i < count($week); $i++) {
		    		echo '<tr><td data-th="Day">'.$week[$i].'</td>';
		    		
		    		for ($j=0; $j<count($timings); $j++) { 
		    			
		    			echo '<td data-th="Timings">'.$timings[$j].'</td>';

		    			$monday_timings = search($monday,'start_time',$timings[$j]);
		    			$result='';
		    			for ($q=0; $q <count($monday_timings); $q++) { 
		    				$result=$result.$monday_timings[$q]['course_id'].',';
		    			
		    			}
		    			$result = substr($result, 0,strlen($result)-1);

		    			echo '<td data-th="LH3">'.$result.'</td></tr>';
		    			echo '<td data-th="Day">'.'</td>';
		    			
		    		}
		    	echo '</tr>';
		    	}




			// for($i = 0; $i < count($outputArr); $i++ ){
			//     echo '<tr>'
			//     .'<td>'.$outputArr[$i]['day']."</td>\n";
			//     for($j = 0; $j < count($monday); $j++ ){
			//     	for ($timings=0;$timings<7;$timings++) {
			//     		echo '<td>'.$outputArr[$i]['start_time'].' to '.$outputArr[$i]['end_time']."</td>\n";
			//     		$LH3 = search($monday, 'room_no', 'LH3');
			    		

			//         	echo '<td>'.$outputArr[$i]['room_no']."</td>\n";
			//     	}
			        
			//     }
			//     echo '</tr>';
			// }

			echo '</tbody>';
			echo '</table>';

			// echo '<table border="1">';
			// for($i = 0; $i < count($outputArr); $i++ ){
			//     echo '<tr>';
			//     for($j = 0; $j < count($outputArr[$i]); $j++ ){
			//         echo "<td>".$outputArr[$i]['course_id']."</td>\n"
			//         ."<td>".$outputArr[$i]['course']."</td>\n"
			//         ."<td>".$outputArr[$i]['faculty']."</td>\n"
			//         ."<td>".$outputArr[$i]['season']."</td>\n"
			//         ."<td>".$outputArr[$i]['room_no']."</td>\n";
			//     }
			//     echo "</tr>";
			// }
			// echo '</table>';

		} else {
	    	echo "0 results";
		}
	}


?>
