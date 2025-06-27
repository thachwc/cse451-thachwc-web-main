// Wendy Thach - cse451 - final project
'use strict';
console.log('Loading function');
import axios from 'axios';
import { DynamoDBClient, GetItemCommand, PutItemCommand } from "@aws-sdk/client-dynamodb";

async function getBooks(key) {
	let responseData = await axios.get('https://openlibrary.org/search.json?author=' + key);
	let listOfBookNames = [];
	responseData.data['docs'].forEach((item) => {
		listOfBookNames.push(item['title']);
	});
	return listOfBookNames;
}

async function getWeather(zipcode) {
	let apiKey = "VBC3ARVLBYTH8U4ATSH8BM2S7";

	let returnData = {"weather": {}};
	try {
		let responseData = await axios.get('https://weather.visualcrossing.com/VisualCrossingWebServices/rest/services/timeline/' + zipcode + "?key=" + apiKey);
		console.log(responseData);
		let currentWeather = responseData.data["days"][0];
		returnData["weather"]["address"] = zipcode;
		returnData["weather"]["currentTemp"] = currentWeather["temp"];
		returnData["weather"]["description"] = currentWeather["description"];
	}
	catch {
		returnData = {"error": "Invalid zipcode"};
	}

	return returnData;

}

async function putToken(token) {
	const client = new DynamoDBClient({region:"us-east-1"});
	const putInput = {
		TableName: "final",
		Item: {
			"id": {
				"S": "token"
			},
			"name": {
				"S": token
			}
		}
	};
	const putCommand = new PutItemCommand(putInput);
	await client.send(putCommand);
}

async function getToken() {
	const client = new DynamoDBClient({region:"us-east-1"});
	const getInput = {
		TableName: "final",
		Key: {
			"id": {
				"S": "token"
			}
		}
	};
	const getCommand = new GetItemCommand(getInput);
	const getResponse = await client.send(getCommand);
	let token = getResponse.Item.name.S;
	console.log(token);
	return token;
}

/**
 * Provide an event that contains the following keys:
 * 
 *  - operation: one of 'create,' 'read,' 'update,' 'delete,' or 'echo'
 *  - payload: a JSON object containing the parameters for the table item
 *             to perform the operation on
 */
export const handler = async (event, context) => {
	let responseBody;
	if (event.path)
	{
		if (event.path.startsWith("/token")) {
			console.log(event.headers["SECRET"]);
			if (event.headers["SECRET"] == "asdlolsadkfoiweruopweir123123213asdasdasdfg") {
				await putToken(event.queryStringParameters.key);
				responseBody = {
					message: event.headers["SECRET"]
				};
			}
		}
		else if (event.path.startsWith("/weather")) {
			let dynamodbToken = await getToken();
			let zipCode = event.queryStringParameters.zipcode;
			if (event.headers["X-AUTH-FINAL-TOKEN"] == dynamodbToken)
			{
				var weather = await getWeather(zipCode);
				responseBody = {
					message: JSON.parse(JSON.stringify(weather))
				};
			}
			else {
				responseBody = {
					message: event.headers
				};
			}
		}
		else {
			let dynamodbToken = await getToken();
			console.log(dynamodbToken);
			console.log(event.headers["X-AUTH-FINAL-TOKEN"]);
			if (event.headers["x-auth-final-token"] == dynamodbToken)
			{
				console.log("testing");
				let authorKey = event.path.split('/')[1];
				var data = await getBooks(authorKey);
				responseBody = {
					message: JSON.parse(JSON.stringify(data))
				};
			}
			else {
				responseBody = {
					message: "Invalid header token"
				};
			}
		}
	}

	// The output from a Lambda proxy integration must be 
	// in the following JSON object. The 'headers' property 
	// is for custom response headers in addition to standard 
	// ones. The 'body' property  must be a JSON string. For 
	// base64-encoded payload, you must also set the 'isBase64Encoded'
	// property to 'true'.
	let response = {
		statusCode: 200,
		headers: {
			"x-custom-header" : "my custom header value",
			"Access-Control-Allow-Headers" : "*",
			"Access-Control-Allow-Origin": "*",
			"Access-Control-Allow-Methods": "OPTIONS,POST,GET"
		},
		body: JSON.stringify(responseBody)
	};
	console.log("response: " + JSON.stringify(response));
	return response;
};
