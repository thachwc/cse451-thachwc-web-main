## Name
Wendy Thach

## Assignment
CSE451 - Final Project

## State of assignment
In my final project all my routes work correctly. I even added a message for when the user types in an incorrect input for example for zipcode, if the user entered in a string it would return a message that tells the user to reinput a valid zipcode. I got my /profile route to update the zipcode weather information when the user enters in a zipcode. I got the /numbers to return a fun fact about a number the user inputs and return a message to reenter a valid number if the user enters in a string. For /authors, I was able to return a list of authors by what the user is searching for and return a link that gives a list of books written by that author selected. For the /API route, I got my page to look pretty, having a list of fish from my API with their corresponding id so that the user knows what fish they want to search for and have a list returned with the name, price, catchphrase, museum catchphrase, and even an image of the fish from the Animal Crossing Game. For my /auth route, I was able to create and check if a token was created and have every call to an API be invalid if the user does not have a valid token created. What does not work I would say the only thing was that I was only able to get cache to work instead of using memcache and for the calls in the /API route it worked perfectly, but I wish I figured out a way to refresh the number when searching for a fish without calling the /calls route again because I had to call it again, every search for a fish would increment the calls number by 2 since it’s calling the /API route for a specific fish and the /calls route to update the number of calls.

## Issues you wish you had more time to improve
Some issues I wish I had more time to improve would be maybe making the project look prettier instead of a boring white background. I was at least able to have the footer be a different color to differentiate it from the body and have my /API route be split into columns because at first, I had the list of fish on the top and the textbox all the way at the bottom of the list. I also wish I had more time to test around with memcache in order to get it to work and figured out a way to refresh the number when searching for a fish without calling the /calls route again.

## Best aspect and any notable design/implementation "things"
My best aspect of and notable design/implementation "things" would be my /API route. I'm really proud of how it came out with the time given. I was able to show a scale the image of each fish to fit into the column and even bolded the words of each fact of the fish to emphasize the information of it. I also centered the text and text input box in every route so that it looked better for the user when they first access my web page, the input box would be right in front of their eyes instead of all the way to the left by default.

## Self analysis of  your code
A self-analysis of my code I would say I did a pretty good job. I ensured where I had the time to let the user know if they entered in an invalid input to redo their input with a valid one. I also let the user know if they had an invalid token and that allowed the user to know that they would have to go back to the /auth route to get a new token. In turn that route lets the user know a token has been created or if there is already a token that hasn't yet expired.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
