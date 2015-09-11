e<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="tracker.css">
<!--
  <link rel="stylesheet" type="text/css" href="../../assets/bootstrap-3.3.4-dist/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="streams.css">
  <script src="../../assets/bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="streams.js"></script>
-->
    <script src="tracker.js"></script>
  <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
</head>
<body>
    
    <div id="frame">
        <div id="donationticker">
            <p> Test donation </p>
        </div>
        <div id="dollarvalue">
            <p> Total Raised </p>
        </div>
    </div>
    
    <script>
        
        //      Get the text file
        var xmlhttp, jsonstuff, sessionTotal;
        xmlhttp = new XMLHttpRequest();
//      gets me the json object
        xmlhttp.open('GET', 'general.json', false);
        xmlhttp.send();
        jsonstuff = xmlhttp.responseText;
        
        // This gets the session donation total.
        xmlhttp.open('GET', 'TwitchAlerts/session_donation_amount.txt', false);
        xmlhttp.send();
        sessionTotal = xmlhttp.responseText;
        
//      Games array, that you iterate through to get to different games
//      Access like this: testme.games[1].incentives[0].money
        console.log(jsonstuff);
        incentiveObject = JSON.parse(jsonstuff);
        
        console.log(sessionTotal);
        
//      Write dummy stuff to the json file
        
        var myvar = function(){
            // Need to interface with these.
            
            var currentRaised = 0;
            var currentIncentiveNum = 0;
            var nextIncentive = "";
            var currentIncentive = "";
            var donationTotal = "";
            var currentRequired = 0;
            var nextRequired = 0;
            var gameIndicator = 10000;
            var gameTitle = "";
            
            // Retrieve Session total
            sessionTotal = getSessionTotal();
            // Get the currently playing game
            var channel = getStreamTitle();
            // Literal value for the game
            
            // REMEMBER TO PUT THIS BACK
            gameIndicator = gameValue(channel.stream.game);
//            console.log(channel.stream.game);
            
            // For website use to select the correct game
            incentiveObject.currentgamenum = gameIndicator;
            
            // Sets the games baseline value to total, if its the first time
            // the game is played
            if (incentiveObject.games[gameIndicator].touched == false) {
                incentiveObject.games[gameIndicator].baseline = sessionTotal;
                incentiveObject.games[gameIndicator].touched = true
            } else {
                // This implies that we don't go BACK to another game once our game is done.
                // We set a baseline for which we start a game, so that all money is relative from there on out
                currentRaised = sessionTotal - incentiveObject.games[gameIndicator].baseline;
                
                // Iterate through all of the incentives
                for (i = 0; i < incentiveObject.games[gameIndicator].incentives.length; i++) {
                    currentIncentiveNum = 0;
                    
                    //If incentive complete is false, check money.
                    if (incentiveObject.games[gameIndicator].incentives[i].complete == false) {
                        
                        // Set to complete if we have raised more money than the current incentive.
                        if (currentRaised >= incentiveObject.games[gameIndicator].incentives[i].money){
                            incentiveObject.games[gameIndicator].incentives[i].complete = true;
                        } else if (currentRaised < incentiveObject.games[gameIndicator].incentives[i].money) {
                           
                            // Set the current Incentives
                            currentIncentiveNum = i;
                            break;
                        }
                    } else {
                        // Set the currentIncentive to the final incentive
                        currentIncentiveNum = incentiveObject.games[gameIndicator].incentives.length - 1;
                    }
                }
                
                // Do this if we've met the final incentive for this game
                if (currentIncentiveNum == incentiveObject.games[gameIndicator].incentives.length - 1 && currentRaised>= incentiveObject.games[gameIndicator].incentives[currentIncentiveNum].money) {
                    currentIncentive = "all incentives met in this game";
                    nextIncentive = "all incentives met in this game"
                } else {
                    
                    // Calculate the money left until the next incentive is reached
                    var globaTotal = incentiveObject.games[gameIndicator].incentives[currentIncentiveNum].money + incentiveObject.games[gameIndicator].baseline;
                    
                    var remainingUntil = globaTotal - sessionTotal;
                    currentIncentive = "$" + remainingUntil + " until " + incentiveObject.games[gameIndicator].incentives[currentIncentiveNum].desc + "";
                    
                    // Set the next incentive to be the incentive that follows current, but if current is the last
                    // Then set the next to be done, so we can not display it
                    if (currentIncentiveNum + 1 <= incentiveObject.games[gameIndicator].incentives.length - 1) {
                        var globaTotal = incentiveObject.games[gameIndicator].incentives[currentIncentiveNum + 1].money + incentiveObject.games[gameIndicator].baseline;
                    
                    var remainingUntil = globaTotal - sessionTotal;
                        nextIncentive = "$" + remainingUntil + " until " + incentiveObject.games[gameIndicator].incentives[currentIncentiveNum + 1].desc + ""
                    } else {
                        nextIncentive = "Only one incentive left";
                    }
                }
                
                // Setup the dollar value in the bottom right
                $("#dollarvalue").text("$"+ sessionTotal +"");
                // If less than raised, set current, then set next
                
                   
            }
            incentiveObject.total = sessionTotal;
// Because OBS is stupid and won't stop caching, we have to save the incentives to text file, then a second script will display these on screen.

//          Call PHP that saves the jsn file.
            $.ajax
            ({
                type: "GET",
                dataType : 'json',
                async: false,
                url: 'save_json.php',
                cache: false,
                data: { data: JSON.stringify(incentiveObject) },
                success: function () {alert("Thanks!"); },
                failure: function() {alert("Error!");}
            });
//          Save the current incentives
            $.ajax
            ({
                type: "GET",
                dataType : 'Text',
                async: false,
                url: 'save_text.php',
                cache: false,
                data: { data: currentIncentive},
                success: function () {},
                failure: function() {}
            });
//          Save the next incentives
            $.ajax
            ({
                type: "GET",
                dataType : 'Text',
                async: false,
                url: 'save_text2.php',
                cache: false,
                data: { data: nextIncentive},
                success: function () {},
                failure: function() {}
            });
    
            
            setTimeout(myvar,5000);
        }
        myvar();
        var sendFile = function() {
            $.ajax({ 
            url: 'sendFTP.php',
            success: function() {
            }
            });
            setTimeout(sendFile,60000);
        }
        sendFile();
        
    </script>
</body>
</html>
