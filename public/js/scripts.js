
jQuery(document).ready(function() {
	
    /*
        Fullscreen background
    */
    $.backstretch('../img/backgrounds/1.jpg');
    
    $('#top-navbar-1').on('shown.bs.collapse', function(){
    	$.backstretch("resize");
    });
    $('#top-navbar-1').on('hidden.bs.collapse', function(){
    	$.backstretch("resize");
    });
    
    /*
        Form
    */
    $('.registration-form fieldset:first-child').fadeIn('slow');
    
    $('.registration-form input[type="text"], .registration-form input[type="password"], .registration-form input[type="number"], .registration-form input[type="email"], .registration-form textarea').on('focus', function() {
    	$(this).removeClass('input-error');
    });


    
    // next step
    $('.registration-form .btn-next').on('click', function() {
    	var parent_fieldset = $(this).parents('fieldset');
    	var next_step = true;
    	
    	parent_fieldset.find('.require').each(function() {


            if( $(this).val() == "" ) {
    			$(this).addClass('input-error');
    			next_step = false;
    		}
    		else {
    			$(this).removeClass('input-error');
    		}

            if( $(this).attr('id') == "email" ){
                if(!validateEmail($('#email').val())){
                    next_step = false;
                    $('#email').addClass('input-error');
                }
            }

            if( $(this).attr('id') == "password" ){
                if($('#password').val() != $('#repeat-password').val() ){
                    next_step = false;
                }
            }


                if(!$('#newsub').hasClass('hidden')) {
                    if ($('#form-newsub').val() == "") {
                        next_step = false;
                        $('#form-newsub').addClass('input-error');
                    }
                }



                if((!$('#newsub2').hasClass('hidden'))&&($('#form-newsub2').val() == "")){
                    next_step = false;
                    $('#form-newsub2').addClass('input-error');
                }

            
            
    	});

        parent_fieldset.find('.sub').each(function() {
            if( $(this).val() == '' ) {
                //$("[data-id='select']").addClass('input-error');
                next_step = false;
            }
        });

    	if( next_step ) {
    		parent_fieldset.fadeOut(400, function() {
	    		$(this).next().fadeIn();
                var center = map.getCenter();
                google.maps.event.trigger(map, "resize");
                map.setCenter(center);
	    	});
          // if(parent_fieldset.find('#next2').length != 0)
            // initialize();
    	}
    	
    });

    $('#next2').on('click', function() {

        searchAddress();

        if($('#password').val() != $('#repeat-password').val() ){
            next_step = false;
            $('#password').addClass('input-error');
            $('#repeat-password').addClass('input-error');
        }

        if(!$('#newsub').hasClass('hidden')){
            if($('#form-newsub').val() == ""){
                next_step = false;
                $('#form-newsub').addClass('input-error');
            }
            else if(!$('#newsub2').hasClass('hidden'))
            {
                $('#sub1').val($('#form-newsub').val());
                $('#sub2').val($('#form-newsub2').val());
            }
            else if($('#newsub2').hasClass('hidden'))
            {
                $('#sub2').val($('#form-newsub').val());
            }
        }

        if((!$('#newsub2').hasClass('hidden'))&&($('#form-newsub2').val() == "")){
            next_step = false;
            $('#form-newsub2').addClass('input-error');
        }

    });
    
    // previous step
    $('.registration-form .btn-previous').on('click', function() {
    	$(this).parents('fieldset').fadeOut(400, function() {
    		$(this).prev().fadeIn();
    	});
    });



    // submit
    $('.registration-form').on('submit', function(e) {
    	
    	
    	$(this).find('.require').each(function() {
    		if( $(this).val() == "" ) {
    			e.preventDefault();
    			$(this).addClass('input-error');
    		}
    		else {
    			$(this).removeClass('input-error');
    		}
    	});
    	
    });
 

   
    $('#select').on('change', function(e){
    
   var subject = $('#select').val();
   var res =  $.inArray("0", subject);
  //console.log((res != -1));
        if(subject != null)
           if(res != -1)
           {
               $('#newsub').removeClass('hidden');

               if($('#select').val().length == 2){
                   $('#sub1').val($('#select').val()[0]);
               }
           }
           else
            {
                $('#newsub').addClass('hidden');
                $('#newsub2').addClass('hidden');

                if($('#select').val().length == 2){
                    $('#sub1').val($('#select').val()[0]);
                    $('#sub2').val($('#select').val()[1]);
                }
            }

    });



     $('#moins').on('click', function(e){
         $('#newsub2').addClass('hidden');
         $('#select').attr('data-max-options', '2');
        });


     $('#plus').on('click', function(e){
        if($('#select').val().length<2)
        {
           $('#newsub2').removeClass('hidden');
           $('#select').attr('data-max-options', '1');
        }
     });

});

function validateEmail(email) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}