function showIncentiveOne(){
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
            
    $('#donationticker').toggle("clip",{size:10},1000);        
};

function showIncentiveTwo(){
    $.ajax
    ({
        type: "GET",
        dataType : 'Text',
        async: false,
        url: 'Tracker2.txt',
        cache: false,
        success: function (data) {
            $("#donationticker").text(data);
        },
        failure: function() {}
    });
            
    $('#donationticker').toggle("clip",1000);        
};

function showMessage1(){
    $.ajax
    ({
        type: "GET",
        dataType : 'Text',
        async: false,
        url: 'message1.txt',
        cache: false,
        success: function (data) {
            $("#donationticker").text(data);
        },
        failure: function() {}
    });
            
    $('#donationticker').toggle("clip",1000);  
}

function showMessage2(){
    $.ajax
    ({
        type: "GET",
        dataType : 'Text',
        async: false,
        url: 'message2.txt',
        cache: false,
        success: function (data) {
            $("#donationticker").text(data);
        },
        failure: function() {}
    });
            
    $('#donationticker').toggle("clip",1000);  
}

function returnInc(){
    $('#donationticker').toggle("clip",1000);
}

//Remember to end the previous slide
function showSlide(){
    $('#slideshow').toggle("clip",1000);
}



function showMoney(){
    $.ajax
    ({
        type: "GET",
        dataType : 'Text',
        async: false,
        cache: false,
        url: 'TwitchAlerts/session_donation_amount.txt',
        success: function (data) {
            $("#dollarvalue").text(data);
        },
        failure: function() {}
    });
}