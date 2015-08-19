<html lang="en">
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
            gameIndicator = gameValue(channel.stream.game);
            // Sets the games baseline value to total, if its the first time
            // the game is played
            if (incentiveObject.games[gameIndicator].touched == false) {
                incentiveObject.games[gameIndicator].baseline = sessionTotal;
                incentiveObject.games[gameIndicator].touched = true
            } else {
                // Money first
                currentRaised = sessionTotal - incentiveObject.games[gameIndicator].baseline;
                
                for (i = 0; i < incentiveObject.games[gameIndicator].incentives.length; i++) {
                    currentIncentiveNum = 0;
                    //If complete is false, check money.
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
                        // Set the 
                        currentIncentiveNum = incentiveObject.games[gameIndicator].incentives.length - 1;
                    }
                }
                
                // Do this if we've met the final incentive for this game
                if (currentIncentiveNum == incentiveObject.games[gameIndicator].incentives.length - 1 && currentRaised>= incentiveObject.games[gameIndicator].incentives[currentIncentiveNum].money) {
                    currentIncentive = "all incentives met in this game";
                } else {
                
                    var globaTotal = incentiveObject.games[gameIndicator].incentives[currentIncentiveNum].money + incentiveObject.games[gameIndicator].baseline;
                    var remainingUntil = globaTotal - sessionTotal;
                    currentIncentive = "$" + remainingUntil + " until " + incentiveObject.games[gameIndicator].incentives[currentIncentiveNum].desc + "";
                    
                    if (currentIncentiveNum + 1 <= incentiveObject.games[gameIndicator].incentives.length - 1) {
                        nextIncentive = "" + incentiveObject.games[gameIndicator].incentives[currentIncentiveNum + 1].desc + ""
                    } else {
                        nextIncentive = "weow";
                    }
                    
                    $("#donationticker").text("$" + remainingUntil + " until " + incentiveObject.games[gameIndicator].incentives[currentIncentiveNum].desc + "");
        
                }
                
                // Setup the dollar value in the bottom right
                $("#dollarvalue").text("$"+ sessionTotal +"");
                // If less than raised, set current, then set next
                
                   
            }

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
    
            
            setTimeout(myvar,2000);
        }
        
        myvar();
    </script>
</body>
</html>
