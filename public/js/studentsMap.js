
if(image_path.indexOf('/2') == -1)
    image_path = image_path + '/2';
else
    image_path =  image_path.replace('2', '3');

var customIcons = {
    studentOn: {
        url:  '/img/icons/stdon.ico',
        size: new google.maps.Size(20, 32),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(0, 32)
    },
    studentOff: {
        url:  '/img/icons/stdoff.ico',
        size: new google.maps.Size(20, 32),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(0, 32)
    },
    studentMe: {
        url:  image_path,
        size: new google.maps.Size(20, 32),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(0, 32)
    }
};

$(document).ready(function(){
    load('/user/xml');
    
});

function load(url) {
    var map = new google.maps.Map(document.getElementById("google_search_map"), {
        center: new google.maps.LatLng(28.890554,-10.023368),
        zoom: 2,
        mapTypeId: 'roadmap'
    });

    var searchBox = new google.maps.places.SearchBox(document.getElementById('search'));

    google.maps.event.addListener(searchBox, 'places_changed', function () {
        var places = searchBox.getPlaces();

        if (places.length == 0) {
            return;
        }

        var bounds = new google.maps.LatLngBounds();
        for (var i = 0, place; place = places[i]; i++) {
            bounds.extend(place.geometry.location);
        }

        map.fitBounds(bounds);
    });

    downloadUrl(url, function(data) {
        setupMarker(data,map)
    });
}

function setupMarker(data,map) {
    var infoWindow = new google.maps.InfoWindow;
    var xml = data.responseXML;
    var markers = xml.documentElement.getElementsByTagName("marker");
    
    
    $( "#amount" ).html( markers.length +" students found" );
    
    for (var i = 0; i < markers.length; i++) {
        var firstname = markers[i].getAttribute("firstname");
        var lastname = markers[i].getAttribute("lastname");
        var city = markers[i].getAttribute("city");
        var sub1 = markers[i].getAttribute("sub1");
        var id = markers[i].getAttribute("id");
        var sub2 = markers[i].getAttribute("sub2");
        var language = markers[i].getAttribute("language");
        var point = new google.maps.LatLng(
            parseFloat(markers[i].getAttribute("lat")),
            parseFloat(markers[i].getAttribute("lng")));
        var html = "<b>" + firstname + " " + lastname + "</b>" +
            "<br/> City : <b>" + city +
            "</b> <br/> Language : <b>" + language + "</b>" +
            "</b> <br/> Subjects : <b>" + sub1 +", "+ sub2 +"</b>" +
            "<br/>"

        var html2 = "<button class='btn btn-default SendMessage' onclick='modal("+id+");'><span class='fa fa-comments'></span>Write him a message</button>";

        var icon =  customIcons['studentMe'];
        if(id != user_id)
        {
            html = html + html2;
            icon = customIcons['studentOn'] || {};
        }
        

        var marker = new google.maps.Marker({
            map: map,
            position: point,
            icon: icon.url
        });
        bindInfoWindow(marker, map, infoWindow, html);
    }

}

function bindInfoWindow(marker, map, infoWindow, html) {
    google.maps.event.addListener(marker, 'click', function() {
        infoWindow.setContent(html);
        infoWindow.open(map, marker);
    });
}

function downloadUrl(url, callback) {
    var request = window.ActiveXObject ?
        new ActiveXObject('Microsoft.XMLHTTP') :
        new XMLHttpRequest;

    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            request.onreadystatechange = doNothing;
            callback(request, request.status);
        }
    };

    request.open('GET', url, true);
    request.send(null);
}

function doNothing() {}

$('#lang, #sub').on('change', function(e){
    var lang = $('#lang').val();
    var sub =  $('#sub').val();
    $( "#amount" ).html( " " );
    load('/user/xml/lang/' + lang + '/sub/' + sub);

});



    /***
     Initialization
     ***/

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    function getModal(user) {
        var jqxhr = $.ajax({
            url: '/newmsg',
            type: 'GET',
            data: { user: user },
            dataType: 'html'
        });

        return jqxhr;
    }

   function modal(id) {

       var $modal = $('#new_message');
       //$modal.html('<div id="spin"><span class="fa fa-spinner fa-spin fa-5x fa-fw" style="color: white"></span></div>');
       $modal.html('<img  style="display: block; margin: auto;" src="img/ring.svg">');
       $modal.modal('show');
       getModal(id).done(function(data) {
           if(data.indexOf('redirect') != -1)
               window.location.replace(data.replace('redirect',''));
           else
           {
               $modal.html(data);
               $modal.modal('show');
           }

       });
   }

$('body').on('click', '.send-msg', function (e) {
    e.preventDefault();

    $(this).html('Send'+'<i class="fa fa-spinner fa-spin fa-fw"></i>');

    $val = $('#messageBox').val();
    $form = $('#form');

    if($val != '')
        $form.submit();
    else
        event.preventDefault();
});


        //evt.preventDefault();


