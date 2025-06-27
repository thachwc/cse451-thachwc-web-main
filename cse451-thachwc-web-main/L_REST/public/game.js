//Wendy Thach
//cse451
//spring23
//L_REST assignment


//display error
function showError() {
	$("#error").show();
	$("#error").html("Error");
}

//display list of games
function showGames(result) {
	console.log(result);
	$("#pick").show();
	$("#play").hide();
	$("#gameList").html("<li>Games</li>");
	result.forEach((item) => {
		$("#gameList").append("<li><button onclick='play(" + item.id + ")'>" + item.name + "</button></li>");	
	});

}


//call server to get list of games, then showGames
function getGames() {
	$.ajax({
		url: "https://thachwc.451.csi.miamioh.edu/cse451-thachwc-web/L_REST/public/api/game",
		success: showGames,
		fail: showError	
	});
}

//display data for game into table
function playGame(gameData) {
	console.log(gameData);
	//todo update pieces on table	
	for(var item in gameData) {
		//console.log(item);
		if(item != "id" || item != "name") {
			$("#"+item).html(gameData[item]);	
		}
	}
}

//start game play, get board and then call playGame
function play(gameId) {
	console.log("playing game ", gameId);
	$("#pick").hide();
	$("#play").show();
	$("#title").html("Playing game " + gameId);
	$.ajax({
		url: "https://thachwc.451.csi.miamioh.edu/cse451-thachwc-web/L_REST/public/api/game/" + gameId,
		success:playGame,
		fail: showError		
	});
}

function createBoard(event) {
	//TODO make ajax call to create board, then call play with new gameid
	var data = {gameBoardName: $("#boardName").val()};
	$.ajax({
		url: "https://thachwc.451.csi.miamioh.edu/cse451-thachwc-web/L_REST/public/api/game",
		type: "PUT",
		data: data,
		success: function(result) {
		 play(result.id);
		},
		fail: showError
	});
}

function clickCell() {
	console.log(this);
	console.log(this.id)
	current = $("#"+this.id).html();
	var data = " ";
	if (current=="") {
		$("#"+this.id).html('scott');
		data = {pieceName: "scott"};
	}
	else {
		$("#"+this.id).html('');
	}
	//TODO send cell to server
	var gameId = $("#title").text().split(" ").pop();
	$.ajax({
		url: "https://thachwc.451.csi.miamioh.edu/cse451-thachwc-web/L_REST/public/api/game/" + gameId + "/" + this.id[1],
		type: "POST",
		data: data,
		fail: showError	
	});
}

$(document).ready(function() {
	$("#play").hide();
	$("#error").hide();
	$("td").click(clickCell);
	$("#create").submit(function (ev) {
		ev.preventDefault();
		//$("#boardName").val('');
		createBoard();
		$("#boardName").val('');
	});
	getGames();
});

