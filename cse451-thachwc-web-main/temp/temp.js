/*
 * Wendy Thach
 * CSE451
 * 3-13 in class - ajax
 */

var date="2023-03-13";

function getCurrent() {
	$.ajax({url:"https://ceclnx01.cec.miamioh.edu/~campbest/cse451/temp.php/" + date,
		type:"get",
		dataType:'json',
		success: function(data) {
			var s = "<table class='table'><thead><th>Time</th><th>Output Temperature</th><th>Room Temperature</th></thead><tbody>"
			for(var i = 1020; i < 1141; i++) {
			var s= s + "<tr><td>" + data.temps[i].time;
			var s= s + "</td><td>" + data.temps[i].outputTemp;
			var s= s + "</td><td>" + data.temps[i].roomTemp + "</td></tr>";
			}
			var s= s + "</tbody></table>";
			$("#result").html(s);
			
		},
		error:function(data) {
			$("#result").html("Error fetching");	
		}		
	});
}

$(document).ready(function() {
	getCurrent();
});
