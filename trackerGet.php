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
    <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
</head>
<body>
    
    <div id="frame">
        <div id="donationticker">
            <p> Test donation </p>
        </div>
        <div id="nextInc">
            <p> Test donation </p>
        </div>
        <div id="dollarvalue">
            <p> Total Raised </p>
        </div>
    </div>
    
    <script>
        var myvar = function(){

                $.ajax
                ({
                    type: "GET",
                    dataType : 'Text',
                    async: false,
                    url: 'Tracker.txt',
                    cache: false,
                    success: function (data) {
                        $("#donationticker").text(data);
                    },
                    failure: function() {}
                });
            
                $('#donationticker').toggle("slide",{direction:'down',size:10},3000);
                
                $.ajax
                ({
                    type: "GET",
                    dataType : 'Text',
                    async: false,
                    url: 'Tracker2.txt',
                    cache: false,
                    success: function (data) {
                        $("#nextInc").text(data);
                    },
                    failure: function() {}
                });
            
                 $.ajax
                ({
                    type: "GET",
                    dataType : 'Text',
                    async: false,
                    url: 'TwitchAlerts/session_donation_amount.txt',
                    cache: false,
                    success: function (data) {
                        $("#dollarvalue").text(data);
                    },
                    failure: function() {}
                });
            
                // If less than raised, set current, then set next
                
                setTimeout(myvar,5000);    
            }

        
        myvar();
    </script>
</body>
</html>
