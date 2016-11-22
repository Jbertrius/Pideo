

var OneSignal = window.OneSignal || [];
/*OneSignal.push(["init", {
    appId: "974a88e2-bae1-4e31-a47a-f698c53d388e",
    persistNotification: false,
    autoRegister: true,
    promptOptions: {

        actionMessage: "We'd like to show you notifications for the latest news and updates.",

        acceptButtonText: "ALLOW",

        cancelButtonText: "NO THANKS"
    }
}]);*/


OneSignal.push(["init", {
    appId: "343c41b3-7975-4d7a-beec-e23aa6f71597",
    persistNotification: false,
    autoRegister: false,
    subdomainName: 'pideo.onesignal.com',
    promptOptions: {
        /* These prompt options values configure both the HTTP prompt and the HTTP popup. */
        /* actionMessage limited to 90 characters */
        actionMessage: "We'd like to show you notifications for the latest news and updates.",
        /* acceptButtonText limited to 15 characters */
        acceptButtonText: "ALLOW",
        /* cancelButtonText limited to 15 characters */
        cancelButtonText: "NO THANKS"
    }
}]);


OneSignal.push(function() {
    OneSignal.getUserId(function(userId) {
        console.log("OneSignal User ID:", userId);
        if(userId != null)
            sendUserId(userId).done(function (data) {
               return true;
            });
        else
            OneSignal.showHttpPrompt();

    });
});

function sendUserId($userId) {
    var jqxhr = $.ajax({
        url: '/webpush',
        type: 'POST',
        data:{UserId: $userId},
        dataType: 'html'
    });

    return jqxhr;
}

