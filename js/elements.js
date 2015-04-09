function showCourses() {
       		$.ajax({
       			url: "displayList.php", 
       			type: "POST",
       			data: {"category": "course"},
       			dataType: "html",

       			success: function(result){
            		//console.log("result is "+JSON.stringify(result));
            		// console.log(result);
            		$(".rwd-table").html(result);
            		// $(".rwd-table").html(JSON.stringify(result));
        		},

        		fail: function(err){
        			console.log("error is "+err.toString());
        		}
        	});
        	//displaying filters corresponding to course category
        	displayFilters('Courses');
        	return false;
		}

		function showFaculty() {
			$.ajax({
       			url: "displayList.php", 
       			type: "POST",
       			data: {"category": "instructor"},
       			dataType: "html",

       			success: function(result){
            		//console.log("result is "+JSON.stringify(result));
            		$(".rwd-table").html(result);
            		// $("#resultDiv").html(JSON.stringify(result));
        		},

        		fail: function(err){
        			console.log("error is "+err.toString());
        		}
        	});
        	//displaying filters corresponding to faculty category
        	displayFilters('Faculty');
        	return false;
		}

		function showTimetable() {
       		populateYears();
        	//displaying filters corresponding to course category
        	displayFilters('Timetable');
        	return false;
		}

		function changeVisibility(divName) {
			var dis = document.getElementById(divName).style.display;
			if (dis == "none")
				document.getElementById(divName).style.display = 'block';
			else
				document.getElementById(divName).style.display = 'none';
		}

		function addCourseInput() {
			var y = document.createElement("input");
			var z = document.createElement("br");
			y.setAttribute("type", "text");
			y.setAttribute("name", "courseArr[]");
			y.setAttribute("placeholder", "Course Name");
			document.getElementById("courseDiv").appendChild(z);
			document.getElementById("courseDiv").appendChild(y);
		}

		function addFacultyInput() {
			var y = document.createElement("input");
			var z = document.createElement("br");
			y.setAttribute("type", "text");
			y.setAttribute("name", "facultyArr[]");
			y.setAttribute("placeholder", "Faculty Name");
			document.getElementById("facultyDiv").appendChild(z);
			document.getElementById("facultyDiv").appendChild(y);
		}

		function addDeptInput() {
			var y = document.createElement("input");
			var z = document.createElement("br");
			y.setAttribute("type", "text");
			y.setAttribute("name", "deptArr[]");
			y.setAttribute("placeholder", "Department Name");
			document.getElementById("deptDiv").appendChild(z);
			document.getElementById("deptDiv").appendChild(y);
		}

		function populateYears() {
			var start = 2008;
			var end = new Date().getFullYear();
			var options = "";
			for(var year = start ; year <=end; year++){
				options += "<option value ="+year+">"+ year +"</option>";
			}
			document.getElementById("timetableYear").innerHTML = options;
			document.getElementById("fromYear").innerHTML = options;
			document.getElementById("toYear").innerHTML = options;
		}

		function displayFilters(selected) {
			if(selected == "Courses") {
				document.getElementById("courseWrapper").style.display = 'none';
				document.getElementById("facultyWrapper").style.display = 'block';
				document.getElementById("deptWrapper").style.display = 'block';
				document.getElementById("durationWrapper").style.display = 'block';
				document.getElementById("timetableWrapper").style.display = 'none';
			}
			if(selected == "Faculty") {
				document.getElementById("facultyWrapper").style.display = 'none';
				document.getElementById("courseWrapper").style.display = 'block';
				document.getElementById("deptWrapper").style.display = 'block';
				document.getElementById("durationWrapper").style.display = 'block';
				document.getElementById("timetableWrapper").style.display = 'none';
			}
			if(selected == "Timetable") {
				document.getElementById("facultyWrapper").style.display = 'none';
				document.getElementById("courseWrapper").style.display = 'none';
				document.getElementById("deptWrapper").style.display = 'none';
				document.getElementById("durationWrapper").style.display = 'none';
				document.getElementById("timetableWrapper").style.display = 'block';
			}
		}