
google.maps.event.addDomListener(window, 'load', load);

var googleMaps = null;
var marker;
var sub;


$('a[href="#tab-second"]').on('shown.bs.tab', function() {   // When tab is displayed...
    var map = googleMaps,
        center = map.getCenter();
    google.maps.event.trigger(map, 'resize');         // fixes map display
    map.setCenter(center);                            // centers map correctly
});

function load(){

    var mapOptions = {
        center: new google.maps.LatLng(lat ,lng),
        zoom: 6,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    var map = new google.maps.Map(document.getElementById("google_edit_map"), mapOptions);
    var cords = new google.maps.LatLng(lat, lng);

    marker = new google.maps.Marker({position: cords, map: map, title: "Your Location"});
    googleMaps = map;
}

jQuery(document).ready(function() {
    var sub1 = $('#sub1').val();
    var sub2 = $('#sub2').val();
});

$('body').on('click', '.simple',  function (e) {
    e.preventDefault();
    $content = $(this).parent();
    $(this).tooltip('destroy');
    $value = $content.text().trim();
    $content.html('<input type="text" value="'+ $value +'" class="form-control">');
    $content.parent().append('<button class="btn btn-primary update">Edit</button>&nbsp'+
        '<button  class="btn btn-default cancel">Cancel</button>');
    $content.parent().data('val', $value);

});

$('body').on('click', '.cancel', function () {
    $val = $(this).parent().data('val');

    if($(this).parent().find('.edit-style').data('attr') == 'lang')
        $class = "lang";
    else if($(this).parent().find('.edit-style').data('attr') == 'city')
        $class = 'city';
    else if($(this).parent().find('.edit-style').data('attr') == 'pwd')
        $class = 'pwd';
    else
        $class = 'simple';

    $(this).parent().find('.edit-style').html($val+' <a href="#" class="'+ $class +'" data-toggle="tooltip" data-placement="top" title="Edit">'+
        '<span class="fa fa-pencil edit-icon"></span>'+
        '</a>');

    $(this).parent().find('button').remove();

});

$('body').on('click', '.update', function (e) {
    e.preventDefault();

    $(this).attr('disabled','disabled');
    $(this).html('Edit'+'<span class="fa fa-spinner fa-spin fa-fw"></span>');


    $var = $(this).parent().find('.edit-style').data('attr');
    $val = ($var == 'lang') ?  $('.selectpicker').val().trim() : $(this).parent().find('input').val().trim();

    if($val == '')
        $('.cancel').trigger("click");

    editProfile($var, $val).done(function (data) {
        $('.update').parent().data('val',data);
        $('.cancel').trigger("click");
    });

});

function editProfile($var, $val){

    var jqxhr = $.ajax({
        url: '/user/update/'+$var,
        type: 'POST',
        data: { value: $val },
        dataType: 'html'
    });

    return jqxhr;
}

$('body').on('click', '.lang',  function (e) {
    e.preventDefault();
    $(this).tooltip('destroy');

    $lang = ['Français','English'];

    $content = $(this).parent();
    $value = $content.text().trim();

    $other = ($value == $lang[0])? $lang[1] : $lang[0];

    $content.html('<select class="form-control selectpicker"  title="Choose one of the following category" >'+
        '<option value="'+ $value +'">'+ $value +'</option>'+
        '<option value="'+ $other +'">'+ $other +'</option>'+
        '</select>');

    $content.parent().append('<button class="btn btn-primary update">Edit</button>&nbsp'+
        '<button  class="btn btn-default cancel">Cancel</button>');
    $content.parent().data('val', $value);
    $('.selectpicker').selectpicker();
});

$('body').on('click', '.city',  function (e) {
    e.preventDefault();
    $(this).tooltip('destroy');

    $content = $(this).parent();
    $value = $content.text().trim();

    $content.html('<input type="text" id="city" class="form-control">');

    var input = document.getElementById('city');
    var autocomplete = new google.maps.places.Autocomplete(input);

    $content.parent().append('<button class="btn btn-primary update-city">Edit</button>&nbsp'+
        '<button  class="btn btn-default cancel">Cancel</button>');
    $content.parent().data('val', $value);

});

$('body').on('click', '.pwd',  function (e) {
    e.preventDefault();
    $(this).tooltip('destroy');

    $content = $(this).parent();
    $value = $content.text().trim();

    $content.html('<div class="row"><div class="col-md-4 col-xs-12"><input type="password" id="old" placeholder="Old" class="form-control">'
        +'</div> <div class="col-md-4 col-xs-12"> <input type="password" id="new" placeholder="New" class="form-control">'
        +'</div> <div class="col-md-4 col-xs-12"> <input type="password" id="confirm" placeholder="Confim" class="form-control">'
        +'</div> </div>');

    $content.parent().append('<button class="btn btn-primary update" style="margin-left: 19px;">Edit</button>&nbsp'+
        '<button  class="btn btn-default cancel">Cancel</button>');
    $content.parent().data('val', $value);

});

$('body').on('click', '.update-city', function (e) {
    e.preventDefault();

    $(this).attr('disabled','disabled');
    $(this).html('Edit'+' <span class="fa fa-spinner fa-spin fa-fw"></span>');


    $var =  $(this).parent().find('.edit-style').data('attr');
    $val =  $(this).parent().find('input').val();


    var addressInput = document.getElementById('city').value;

    var geocoder = new google.maps.Geocoder();

    geocoder.geocode({address: addressInput}, function(results, status) {

        if (status == google.maps.GeocoderStatus.OK) {

            var myResult = results[0].geometry.location;

            createSimpleMarker(myResult.lat(), myResult.lng());

            getCoords(myResult.lat(), myResult.lng());

            googleMaps.setCenter(myResult);

            googleMaps.setZoom(6);

            editProfileCity($var, $val).done(function (data) {
                $('.update-city').parent().data('val',data);
                $('.cancel').trigger("click");
            });
        }
    });




});

$('body').on('click', '.subject',  function (e) {
    e.preventDefault();
    $(this).tooltip('destroy');

    $content = $(this).parent();
    $value = $content.text().trim();

    $content.html($value+'<span class="fa fa-spinner fa-spin fa-fw"></span>');

    getSubject($value).done(function (data) {
        sub = '<div class="col-md-5 col-xs-6">' + data + '</div>';
        $content.html(sub);

        $content.append('<div class="col-md-5 col-xs-6">'+'<button class="btn btn-primary update-subject">Edit</button>&nbsp'+
            '<button  class="btn btn-default cancel-subject">Cancel</button>'+'</div>');
        $content.data('val', $value);
        $('.selectpicker').selectpicker();
    });


});

$('body').on('click', '.cancel-subject', function (e) {
    e.preventDefault();
    $val = $($(this).parents('.row')[0]).data('val');

    $($(this).parents('.row')[0]).html($val+' <a href="#" class="subject" data-toggle="tooltip" data-placement="top" title="Edit">'+
        '<span class="fa fa-pencil edit-icon"></span>'+
        '</a>');

});

$('body').on('click', '.update-subject', function (e) {
    e.preventDefault();

    $row = $($('.update-subject').parents('.row')[0])
    $(this).attr('disabled','disabled');
    $(this).html('Edit'+' <span class="fa fa-spinner fa-spin fa-fw"></span>');

    $new = $row.find('.selectpicker').val();

    $cur = $row.data('val');

    updateSubject($cur, $new).done(function (data) {
        $row.data('val',data);
        $row.find('.cancel-subject').trigger('click');
    });


});

function updateSubject($cur, $new) {
    var jqxhr = $.ajax({
        url: '/subject/update',
        type: 'POST',
        data:{current: $cur, update: $new},
        dataType: 'html'
    });

    return jqxhr;
}





function createMarker(lat, lng) {

    // The purpose is to create a single marker, so
    // check if there is already a marker on the map.
    // With a new click on the map the previous
    // marker is removed and a new one is created.

    // If the marker variable contains a value
    if (marker) {
        // remove that marker from the map
        marker.setMap(null);
        // empty marker variable
        marker = "";
    }

    // Set marker variable with new location
    marker = new google.maps.Marker({
        position: new google.maps.LatLng(lat, lng),
        draggable: true, // Set draggable option as true
        map: googleMaps
    });


    // This event detects the drag movement of the marker.
    // The event is fired when left button is released.
    google.maps.event.addListener(marker, 'dragend', function() {

        // Updates lat and lng position of the marker.
        marker.position = marker.getPosition();

        // Get lat and lng coordinates.
        var lat = marker.position.lat().toFixed(6);
        var lng = marker.position.lng().toFixed(6);

        // Update lat and lng values into text boxes.
        getCoords(lat, lng);

    });
}

function createSimpleMarker(lat, lng) {

    // The purpose is to create a single marker, so
    // check if there is already a marker on the map.
    // With a new click on the map the previous
    // marker is removed and a new one is created.

    // If the marker variable contains a value
    if (marker) {
        // remove that marker from the map
        marker.setMap(null);
        // empty marker variable
        marker = "";
    }

    // Set marker variable with new location
    marker = new google.maps.Marker({
        position: new google.maps.LatLng(lat, lng),
        draggable: false, // Set draggable option as true
        map: googleMaps
    });


}


function getCoords(lat, lng) {

    // Reference input html element with id="lat".
    var coords_lat = document.getElementById('lat');

    // Update latitude text box.
    coords_lat.value = lat;

    // Reference input html element with id="lng".
    var coords_lng = document.getElementById('lng');

    // Update longitude text box.
    coords_lng.value = lng;
}

function editProfileCity($var, $val){

    var jqxhr = $.ajax({
        url: '/user/update_city/'+$var,
        type: 'POST',
        data: { value: $val , lat : $('#lat').val() ,lng : $('#lng').val()},
        dataType: 'html'
    });

    return jqxhr;
}

function refreshName($val, $kind) {
    $fullname = $('.profile-data-name').text().split('  ');

    $i = ($kind == 'firstname') ? 0 : 1;
    $fullname[$i] = $val;


}

function getSubject($cur) {
    var jqxhr = $.ajax({
        url: '/subject',
        type: 'GET',
        data:{subject: $cur},
        dataType: 'html'
    });

    return jqxhr;
}













function add() {
    var subject = $('#subs').val();

    if((subject == null)||(subject.length < 2)) {
        $('#ctrlsub').html('<div class="input-group"><input type="text" id="newsub1" class="form-control" placeholder="Enter new subject"/><span class="input-group-addon" onclick="remove();"><span class="fa fa-minus"></span></span></div>');
        $('#groupsub').append('<div class="col-md-2" id="ctrlsub2"><button class="btn btn-primary" onclick="add2()">Add Subject <span class="fa fa-plus fa-right"></span></button> </div>');
        $('#subs').selectpicker({
            maxOptions:1
        });
        $('#subs').selectpicker('refresh');
    }else {
        event.preventDefault();
    }

}

function add2() {
    var subject = $('#subs').val();

    if((subject == null)||(subject.length < 1)) {
        $('#ctrlsub2').html('<div class="input-group"><input type="text" id="newsub2" class="form-control" placeholder="Enter another subject"/><span class="input-group-addon" onclick="remove2();"><span class="fa fa-minus"></span></span></div>');
        $('#subs').prop('disabled', true);
        $('#subs').selectpicker('refresh');
    }else
        event.preventDefault();
}

function remove() {
    $('#ctrlsub').html('<button class="btn btn-primary" onclick="add();">Add Subject <span class="fa fa-plus fa-right"></span></button>');
    $('#groupsub').find('#ctrlsub2').each(function() {
        $(this).remove();
    });
    $('#subs').prop('disabled', false);
    $('#subs').selectpicker({
        maxOptions:2
    });
    $('#subs').selectpicker('refresh');
}

function remove2() {
    $('#ctrlsub2').html('<button class="btn btn-primary" onclick="add2();">Add Subject <span class="fa fa-plus fa-right"></span></button>');
    $('#subs').prop('disabled', false);
    $('#subs').selectpicker({
        maxOptions:1
    });
    $('#subs').selectpicker('refresh');
}

$('.form-horizontal').submit( function() {

    if($('#subs').val() == null)
    {
        if($('#newsub1').val() != "")
            $('#sub1').val($('#newsub1').val());

        if($('#newsub2').val() != "")
            $('#sub2').val($('#newsub2').val());
    }
    else if($('#subs').val().length == 2){
        $('#sub1').val($('#subs').val()[0]);
        $('#sub2').val($('#subs').val()[1]);
    }
    else if($('#subs').val().length == 1){
        $('#sub1').val($('#subs').val());

        if($('#newsub1').val() != "")
            $('#sub2').val($('#newsub1').val());
    }




});