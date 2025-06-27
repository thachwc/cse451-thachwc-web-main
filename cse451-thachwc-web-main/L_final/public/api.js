/*
 * Wendy Thach
 * CSE451
 * Final Project
 */
function getCall() {
	$.ajax({
		url: "https://ka8c3n2bu7.execute-api.us-east-1.amazonaws.com/prod/calls",
		success: function(data) {
			console.log(data);
			$("#call").html("Number of calls: " + data.number);
		},
		error: function(error) {
			showError(error['responseJSON'].message);	
		}	
	});	
}

function getList() {
	$.ajax({
		url: "https://ka8c3n2bu7.execute-api.us-east-1.amazonaws.com/prod/api/fish",
		success: function(data) {
			console.log(data);
			$("#error").hide();
			for(const key in data.fish) {
				//console.log(key);
				$("#fish").append("<li>[" + data.fish[key]['id'] + "] " + data.fish[key]['name']['name-USen'] + "</li>");
			}
		},
		error: function(error) {
			showError(error['responseJSON'].message);	
		}	
	});
}

async function getFishID() {
	$("#fishInfo").html("");
	let response = await getTokenFromCache();
	$.ajax({
		url: "https://ka8c3n2bu7.execute-api.us-east-1.amazonaws.com/prod/api/fish?fishID=" + document.getElementById('fishID').value,
		success: showFish,
		error: function(error) {
			showError(error['responseJSON'].message);
		}
	});
}

function showFish(result) {
	console.log(result);
	//console.log(result['fish']['shadow']);
	$("#error").hide();
	if(result['fish'] == null) {
		$("#error").html("Please enter a valid number");
		$("#error").show();
	}
	else {
	$("#fishInfo").append("<li><b>Name:</b> " + result['fish']['name']['name-USen'] + "</li>");
	$("#fishInfo").append("<li><b>Shadow:</b> " + result['fish']['shadow'] + "</li>");
	$("#fishInfo").append("<li><b>Price:</b> " + result['fish']['price'] + "</li>");
	$("#fishInfo").append("<li><b>Catch phrase:</b> " + result['fish']['catch-phrase'] + "</li>");
	$("#fishInfo").append("<li><b>Museum phrase:</b> " + result['fish']['museum-phrase'] + "</li>");
	$("#fishInfo").append("<img src=\"" + result['fish']['image_uri'] + "\">");
	$("#list").show();
	}
	getCall();
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

function showError(error){
	$.ajax({
		type: "GET",
		url: "https://api.ipify.org/?format=json",
		success: function(result) {
			console.log("Error:", error);
			$("#list").hide();
			$("#error").show();
			$("#error").html(error);	
		}	
	});
}

$(document).ready(function() {
	getCall();
	getList();
	$("#error").hide();
});
