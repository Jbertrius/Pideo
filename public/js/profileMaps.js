if($("#google_ptm_map").length > 0){
    var gPTMCords = new google.maps.LatLng(lat, lng);
    var gPTMOptions = {zoom: 8,center: gPTMCords, mapTypeId: google.maps.MapTypeId.ROADMAP}
    var gPTM = new google.maps.Map(document.getElementById("google_ptm_map"), gPTMOptions);

    var cords = new google.maps.LatLng(lat, lng);
    var marker = new google.maps.Marker({position: cords, map: gPTM, title: "Your Location"});
}

