/*
 * Wendy Thach
 * CSE451
 * Final Project
 */

function getToken() {
	$.ajax({
		url: "generateToken",
		type: "GET",
		success: () => {
			created();	
		},
		error: () => {
			alreadyCreated();	
		}	
	});
}

function created() {
	$("#createdToken").show();
}

function alreadyCreated() {
	$("#alreadyCreated").show();
}

$(document).ready(function() {
	$("#createdToken").hide();
	$("#alreadyCreated").hide();
	getToken();
});
