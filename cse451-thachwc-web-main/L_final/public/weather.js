/* Wendy Thach
 * CSE451
 * final project
 */

//Display zipcode's temperature
var token = '';
function getTemp(result) {
	if (result.message.error != null) {
		$("#weather").html(result.message.error);
	}
	else {
		$("#weather").html("Zipcode: " + result.message.weather.address + "<br>Current Temperature: " + result.message.weather.currentTemp + "°F <br>Description: " + result.message.weather.description);
	}
}

function showError(error){
	$.ajax({
		type: "GET",
		url: "https://api.ipify.org/?format=json",
		success: function(result) {
			console.log("Error:", error);
			$("#error").show();
			$("#error").html(error);
		}
	});
}

async function getTokenFromCache() {
	let a = await $.ajax({
		url: "getToken",
		success: function(data) {
			return data['responseJSON'];
		}
	});
	return a;
}

$(document).ready(async function() {
	let headerToken = await getTokenFromCache();
	$.ajax({
		url: "getWeather",
		beforeSend: function (xhr){
			xhr.setRequestHeader('X-AUTH-FINAL-TOKEN', headerToken['token']);
		},
		success: function(data) {
			console.log(data)
			getTemp(data);
		}
	});
});
