/*
 * Wendy Thach
 * CSE451
 * Final Project
 */

async function getAuthor() {
	$("#authorList").html("");
	$("#search").hide();
	let response = await getTokenFromCache();
	$.ajax({
		headers: {"X-AUTH-FINAL-TOKEN": response['token']},
		url: "api/author/" + document.getElementById('author').value,
		success: showAuthor,
		error: function(error) {
			showError(error['responseJSON'].message);
		}
	});
}

function showError(error){
	$.ajax({
		type: "GET",
		url: "https://api.ipify.org/?format=json",
		success: function(result) {
			console.log("Error:", error);
			$("#list").hide();
			$("#search").hide();
			$("#error").show();
			$("#error").html(error);	
		}	
	});
}

function showAuthor(result) {
	console.log(result);
	$("#error").hide();
	$("#search").html("Searching Authors for " + document.getElementById('author').value);
	$("#search").show();
	for (const element of result["docs"]) {
		$("#authorList").append("<li><a href='javascript:void(0);' onclick='showBookByAuthor(\"" + element.key + "\",\"" + element.name + "\");'>" + element.name + "</li>");
	}
	$("#list").show();
}

async function showBookByAuthor(key, name) {
	$("#error").hide();
	$("#search").hide();
	$("#authorList").html("");
	let response = await getTokenFromCache();
	$.ajax({
		type: "GET",
		url: "https://w3ir0op2nj.execute-api.us-east-1.amazonaws.com/prod/" + key,
		beforeSend: function(data) {
			data.setRequestHeader('X-AUTH-FINAL-TOKEN', response['token']);
		},
		success: function(data) {
			console.log(data);
			$("#search").html("List of books for " + name);
			$("#search").show();
			for (const element of data.message) {
				$("#authorList").append("<li>" + element + "</li>");
			}
		}
	});
}

async function getTokenFromCache()
{
	let a = await $.ajax({
		url: "getToken",
		success: function(data) {
			return data['responseJSON'];
		}
	});
	return a;
}

$(document).ready(function() {
	$("#error").hide();
	$("#list").hide();
	$("#search").hide();
});
