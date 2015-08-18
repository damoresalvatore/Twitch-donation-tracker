function getSessionTotal() {
    var donationTotal = "";
    $.ajax ({
        type: "GET",
        dataType : 'text',
        async: false,
        url: "TwitchAlerts/session_donation_amount.txt",
        success: function(data) {
            donationTotal = data;
            donationTotal = donationTotal.replace("$", "");
        }
    });
    return donationTotal;
}

function getStreamTitle() {
    var weow = {};
    
    var hello = $.ajax({
                type:'GET',
                async: false,
                dataType: 'json',
                url: "getGameName.php",
                success: function(data){
                    weow = data;
                }});
    return weow;
}