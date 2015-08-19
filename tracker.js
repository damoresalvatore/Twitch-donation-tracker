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
    return parseInt(donationTotal);
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

function gameValue(gameName) {
    switch(gameName){
        case "The Legend of Zelda":
            return 0;
            break;
        case "The Legend of Zelda: Ocarina of Time":
            return 1;
            break;
        case "The Legend of Zelda: Twilight Princess":
            return 2;
            break;  
        case "The Legend of Zelda: The Minish Cap":
            return 3;
            break;
        case "The Legend of Zelda: The Wind Waker HD":
            return 4;
            break;
        case "The Legend of Zelda: A Link to the Past":
            return 5;
            break;  
        case "The Legend of Zelda: Majora's Mask":
            return 6;
            break;
    }
}