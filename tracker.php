<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--
  <link rel="stylesheet" type="text/css" href="../../assets/bootstrap-3.3.4-dist/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="streams.css">
  <script src="../../assets/bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="streams.js"></script>
-->
  <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
</head>
<body>
    
<!--

    The Plan:
        Set up timer.
        Read From file into JSON

        Check for new donations
            - Use old total Vs. new total
            - Difference added to the JSON
        Do Manipilations
        Display the results to stream
        Save to text file
        
    First steps:
        - Read from text file
        - Save to text file

    Writing to completed incentives:
        - When incentive met, add to achieved incentives
        - hajdas \n
        
        title
            $$ : dahkdjsh \n
            
        title2

    Starting syestem is a sperate case.
-->
    
    <script>
        //      Get the text file
        var xmlhttp, jsonstuff, donationtotal;
        xmlhttp = new XMLHttpRequest();
//      gets me the json object
        xmlhttp.open('GET', 'general.json', false);
        xmlhttp.send();
        jsonstuff = xmlhttp.responseText;
        
        // This gets the session donation total.
        xmlhttp.open('GET', 'TwitchAlerts/session_donation_amount.txt', false);
        xmlhttp.send();
        donationtotal = xmlhttp.responseText;
        
//      Games array, that you iterate through to get to different games
//      Access like this: testme.games[1].incentives[0].money
        testme = JSON.parse(jsonstuff);

        console.log(donationtotal);
        
//      Write dummy stuff to the json file
        
        
//      Use small php server side script to save the text file
        
       /*Get the current game*/
        $.getJSON("https://api.twitch.tv/kraken/streams/Destiny.json?callback=?", function(channel) {
                console.log(channel);
                if (channel["stream" == null]) {
                    
                } else {
                    cucked = channel["stream"];
                    console.log(cucked["game"]);
                }
            });
        
        var trolling = 1;
        
        var myvar = function(){
            
//            test operation
            testme.games[0].Name = "The Legend of Lonk" + trolling + " ";
            
            $.ajax
            ({
                type: "GET",
                dataType : 'json',
                async: false,
                url: 'save_json.php',
                data: { data: JSON.stringify(testme) },
                success: function () {alert("Thanks!"); },
                failure: function() {alert("Error!");}
            });
            
            console.log("hello");
            setTimeout(myvar,1000);
        }
        
        myvar();
    </script>
</body>
</html>
