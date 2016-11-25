

google.maps.event.addDomListener(window, 'load', load);

var googleMaps = null;

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
    
    var marker = new google.maps.Marker({position: cords, map: map, title: "Your Location"});
    googleMaps = map;

}

jQuery(document).ready(function() {
   var sub1 = $('#sub1').val();
   var sub2 = $('#sub2').val();
});

$('body').on('click', '.simple',  function () {
   $content = $(this).parent();
    $(this).tooltip('destroy');
   $value = $content.text().trim();
   $content.html('<input type="text" value="'+ $value +'" class="form-control">');
   $content.parent().append('<button class="btn btn-primary">Edit</button>&nbsp'+
                          '<button  class="btn btn-default cancel">Cancel</button>');
    $content.parent().data('val', $value);
});

$('body').on('click', '.cancel',function () {
    $val = $(this).parent().data('val');
    $(this).parent().find('.edit-style').html($val+' <a href="#" class="simple" data-toggle="tooltip" data-placement="top" title="Edit">'+
        '<span class="fa fa-pencil edit-icon"></span>'+
        '</a>');

    $(this).parent().find('button').remove();

});

















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
