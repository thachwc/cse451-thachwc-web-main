/* Wendy Thach
 * CSE451
 * L_Weather assignment
 */

//Display zipcode's temperature
var token = '';
function getTemp() {
	console.log(token);
	const regExp = /[a-zA-Z]/g;
	const zipCode = document.getElementById('zipcode').value;
	if (regExp.test(zipCode)) {
		showError("Zipcode must contain numeric values only");
	} else {
		$.ajax({
			headers: {"X-AUTH":token},
			url: "https://thachwc.451.csi.miamioh.edu/cse451-thachwc-web/L_Weather/public/api/weather/" + document.getElementById('zipcode').value,
			success: showTemp,
			error: function(error) {
				showError(error['responseJSON'].message);	
			}	
		});
	}
}

function showError(error){
	$.ajax({
		type: "GET",
		url: "https://api.ipify.org/?format=json",
		success: function(result) {
			console.log("Error:", error);
			$("#weather").hide();
			$("#error").show();
			$("#error").html(error+" "+result["ip"]);
		}
	});
}


function showTemp(result) {
	console.log(result);
	$("#error").hide();
	console.log(result);
	$("#zip").html(document.getElementById('zipcode').value);
	$("#result").html(result.status);
	$("#todayList").html("");
	$("#tmrList").html("");
	
	$("#todayList").append("<li>Date: " + result["today"].datetime + "</li>");
	$("#todayList").append("<li>Temperature: " + result["today"].temp + "</li>");
	$("#todayList").append("<li>Max Temperature: " + result["today"].tempmax + "</li>");
	$("#todayList").append("<li>Min Temperature: " + result["today"].tempmin + "</li>");
	$("#todayList").append("<li>Humidity: " + result["today"].humidity + "</li>");
	$("#todayList").append("<li>Conditions: " + result["today"].conditions + "</li>");
	$("#todayList").append("<li>Description: " + result["today"].description + "</li>");

	$("#tmrList").append("<li>Date: " + result["tomorrow"].datetime + "</li>");
	$("#tmrList").append("<li>Temperature: " + result["tomorrow"].temp + "</li>");
	$("#tmrList").append("<li>Max Temperature: " + result["tomorrow"].tempmax + "</li>");
	$("#tmrList").append("<li>Min Temperature: " + result["tomorrow"].tempmin + "</li>");
	$("#tmrList").append("<li>Humidity: " + result["tomorrow"].humidity + "</li>");
	$("#tmrList").append("<li>Conditions: " + result["tomorrow"].conditions + "</li>");
	$("#tmrList").append("<li>Description: " + result["tomorrow"].description + "</li>");
	$("#weather").show();
}

$(document).ready(function() {
	$("#error").hide();
	$("#weather").hide();
	 $.ajax({
		 url: "https://thachwc.451.csi.miamioh.edu/cse451-thachwc-web/L_Weather/public/api/token",
		 success: function(result) {
			 token = result;
		 }
	 });
});
