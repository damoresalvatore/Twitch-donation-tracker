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
    <script src="trackerGet.js"></script>
</head>
<body>
    
    <div id="frame">
        <div id="timer">
            <p> 00:00:00 </p>
        </div>
        <div id="donationticker">
            <p> Test donation </p>
        </div>
        <div id="dollarvalue">
            <p> Total Raised </p>
        </div>
        <div id="slideshow"></div>
    </div>
    
    <script>
        var waitTimer = 10000;
        $('#slideshow').toggle("slide",{direction:'left',size:10},2000);
        returnInc();
        var myvar = function(){

                /*
                    Only two incentives
                    Capable of adding new slides.
                    Show logo
                    Show charity logo
                    Addition of simple phrases.
                */
                showMoney();
                showIncentiveOne();
                setTimeout(showMoney,2*waitTimer-2000);
                setTimeout(returnInc,2*waitTimer-2000);

                setTimeout(showIncentiveTwo,2*waitTimer);
                setTimeout(returnInc,4*waitTimer-2000);     
                setTimeout(showMoney,4*waitTimer-2000);     
                
                setTimeout(showSlide,4*waitTimer);
                setTimeout(showSlide,6*waitTimer-2000);
                setTimeout(showMoney,6*waitTimer-2000);
                
                setTimeout(showMessage1,6*waitTimer);
                setTimeout(returnInc,8*waitTimer-2000);     
                setTimeout(showMoney,8*waitTimer-2000);     
                
                setTimeout(showMessage2,8*waitTimer);
                setTimeout(returnInc,10*waitTimer-2000);     
                setTimeout(showMoney,10*waitTimer-2000);     
                
            
                // If less than raised, set current, then set next
                
                setTimeout(myvar,10*waitTimer);    
            }

        
        myvar();
        
        var seconds = 0;
        var minutes = 0;
        var hours = 0;
        var stopwatch = function() {
            seconds++;
            if (seconds % 60 == 0) {
                minutes++;
                seconds = 0;
            }
            if (minutes % 60 == 0 && minutes != 0) {
                hours++;
                minutes = 0;
            }
            $("#timer").text("" + hours + ":" + minutes + ":" + seconds + "");
//            $("#timer").text("0" + ":" + "00" + ":" + "0" + "");
            setTimeout(stopwatch,1000);

        }
        stopwatch();
    </script>
</body>
</html>
