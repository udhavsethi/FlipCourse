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

if (isset($_POST['submit'])) {
	
	$year = $_POST['year'];

	// $result = $conn->query("SELECT course_id,year,semester as season,classroom_room_number as room_no,day,start,end,time_slot_id FROM time_slot 
	// 	INNER JOIN section ON time_slot_id = time_slot_time_slot_id WHERE year=$year;" );
	$result = $conn->query("SELECT * FROM timetable WHERE year=$year");

		if ($result->num_rows > 0) {
			$outputArr = constArray($result);
			// echo json_encode($outputArr,true);
			$week = array("Monday","Tuesday","Wednesday","Thursday","Friday");
			$timings = array("08:30:00","10:00:00","11:30:00","02:30:00","04:00:00","05:30:00","19:00:00");
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
		    					
		    				//print_r($temp);
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


?>
