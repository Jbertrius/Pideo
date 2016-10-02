$('.edit-group').on('click', function () {
   $('.pp').click();
});

$('.pp').on('change', function () {
 $inputPic = $('.pp');
  sendpp($inputPic).done(function (data) {
      $('.profile-mini').find('img').attr('src', data);
      
      $('.profile-image').find('img').attr('src', data);
  });
    
});

function sendpp($inputPic) {
    var pic = new FormData();

    if (($inputPic)[0].files.length > 0) {
        file_size = ($inputPic)[0].files[0].size;
        pic.append('pic', ($inputPic)[0].files[0]);
    }
    
    pic.append('user_id', user_id);
 
    var jqxhr = $.ajax({
        url: 'user/profilePic',
        type: 'POST',
        cache: false,
        contentType: false,
        processData: false,
        data:  pic,
        dataType : 'html'
    });

    return jqxhr;
}