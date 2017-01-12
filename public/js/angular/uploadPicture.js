//inject angular file upload directives and services.

 $(window).load(function() {
     watchLoad();

  });


$(function() {




    $("iframe, object, embed").each(function() {

        $(this)
        // jQuery .data does not work on object/embed elements
            .attr('data-aspectRatio', this.height / this.width)
            .removeAttr('height')
            .removeAttr('width');

    });

    $(window).resize(function() {

        var newWidth = $('.video').width();
        $("iframe, object, embed").each(function() {

            var $el = $(this);
            $el
                .width(newWidth)
                .height(newWidth * $el.attr('data-aspectRatio'));

        });

    }).resize();

});

function watchLoad(){
    $(window).resize(function(){

   $("body").backstretch("img/bg.jpg"); 
    
    });
}


var app = angular.module('fileUpload', ['ngFileUpload','angularAudioRecorder']);

app.config(function($interpolateProvider) {
    // To prevent the conflict of `{{` and `}}` symbols
    // between Blade template engine and AngularJS templating we need
    // to use different symbols for AngularJS.

    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
});
app.directive('resizeTest', ['$window', function($window) {
  return {
    restrict: 'AC',
    link: function(scope, element) {
      var w = angular.element($window);
      scope.$watch(function() {
        return { 
           width: element.width(),
           height: element.height(),
         };
      }, function(newValue, oldValue) {
        $(window).trigger('resize');
      }, true);
      
      w.bind('resize', function() { scope.$apply(); });
    }
  };
}]);


app.controller('MyCtrl', ['$scope', 'Upload', '$timeout', '$sce',  function ($scope, Upload, $timeout, $sce ) {

    $scope.showme = true;
    $scope.width = '100%';
 
    $scope.style = 'none';
    $scope.youtube = false;

    $scope.loading = false;
    $scope.hint = true;
    $scope.formInfo = true;

    $scope.showGenerate = false;
    $scope.playClass = 'fa ctrlplay fa-play';
    $scope.pauseClass = 'fa ctrlplay fa-pause';
   
    
  

    var  audio = [];
    var  element = [];

 

    $scope.uploadFiles = function (files, audio) {
        
        var username = null;
        
         if($scope.form.username)
             username = $scope.form.username.$modelValue;
        else 
             username = "none";
    
        if (files && files.length && audio && audio.length) {
            Upload.upload({
                url: '/createpideo',
                data: {
                    files: files,
                    audio: audio, 
                    school: $scope.form.school.$modelValue,
                    category: $scope.form.subject.$modelValue,
                    username: username,
                    title : $scope.form.title.$modelValue
                }
            }).then(function (response) {
                $timeout(function () {
                    $scope.loading = false;
                    $scope.result = $sce.trustAsResourceUrl('//www.youtube.com/embed/' + response.data);
                    $scope.youtube = true;
                    $scope.formInfo = false;
                    $scope.youtubelink = "https://youtu.be/"+response.data;
                });
            }, function (response) {
                $scope.ajust = '';
                $scope.loading = false;
                $scope.formInfo = true;
                $scope.style = 'flex';
                $('#fullpage').fullpage({
                    anchors:['firstPage', 'secondPage', 'thirdPage'],
                    responsiveSlides: false
                });


                if (response.status > 0) {
                    $scope.errorMsg = response.status + ': ' + response.data;
                }
            }, function (evt) {
                $scope.progress = 
                    Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
            });
        }
    };



 


    var contains = function(needle) {
    // Per spec, the way to identify NaN is that it is not equal to itself
    var findNaN = needle !== needle;
    var indexOf;

    if(!findNaN && typeof Array.prototype.indexOf === 'function') {
        indexOf = Array.prototype.indexOf;
    } else {
        indexOf = function(needle) {
            var i = -1, index = -1;

            for(i = 0; i < this.length; i++) {
                var item = this[i];

                if((findNaN && item !== item) || item === needle) {
                    index = i;
                    break;
                }
            }

            return index;
        };
    }

    return indexOf.call(this, needle) > -1;
 };





    $scope.countAudioObj = function(index){
        
        if(element.length == 0)
            element.push(index);
        else
            if(!contains.call(element, index))
                element.push(index);           


        checkGenerate();

    };

    var canGenerate = function(){
        return element.length == $scope.files.length ;
    };

    var checkGenerate = function(){
        if(canGenerate())
        {   
            $scope.showGenerate = true;

           setTimeout(function(){
                $.fn.fullpage.moveTo('firstPage', $scope.files.length);
           }, 500) 

        }
      
        


    };



    $scope.deleteFile = function(idx) {
     $scope.files.splice(idx, 1);
     if($scope.files.length == 0){
      $scope.hint = true;
       $scope.reset();
     }

       

        };

  
    $scope.save = function(){
        $scope.loading = true;
        $scope.formInfo = false;
        $scope.style = 'none';
        $.fn.fullpage.destroy('all');
        $scope.ajust = 'ajust';

      for(i=0; i < $scope.files.length; i++)
      {
        var Id = 'recorded-audio-audio'+ i;

        var blob = dataURItoBlob($('#'+Id)[0].src);

        var item = {id: i+1, blob: blob};

        audio.push(item);
      }

        $scope.uploadFiles($scope.files, audio);


    };

    
     $scope.addFile = function(file) {

         if(file != null )
     $scope.files.push(file);
      //checkFiles($scope.files);

       };

    $scope.show = function() {
    
    if($scope.files.length > 0)
    {
       $scope.hint = false;
       $scope.showme = false;
    }
     
       
       
    };

    function dataURItoBlob(dataURI) { 

        var byteString = atob(dataURI.split(',')[1]);
     
        var mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0];
     
        var ab = new ArrayBuffer(byteString.length);
        var ia = new Uint8Array(ab);
        for (var i = 0; i < byteString.length; i++) {
            ia[i] = byteString.charCodeAt(i);
        }
     
        var blob = new Blob([ab], {type: mimeString});
        return blob;

        }

    $scope.reset = function() {
    
    $scope.files = [];
    $scope.showme = true;


       };

    var checkFiles = function (files) {

        for(i=0; i< files.length; i++)
        {
            if(files[i] == null || $scope.files[i].type == undefined)
                 files.splice(i, 1);

        }

    };

   $scope.next = function(){

       $('#main').remove();
       $scope.width = 100/($scope.files.length + 1) + '%';
       $scope.style = 'flex';
       $('#fullpage').fullpage({
        anchors:['firstPage', 'secondPage', 'thirdPage'],
        responsiveSlides: false,
         });

        setTimeout(function(){
            $(window).trigger('resize');
        }, 500);

    
      
   };



   $scope.$watch('files.length', function () {
        

        setTimeout(function(){
            $(window).trigger('resize');
        }, 3000);

      
   });



}]);

app.config(function (recorderServiceProvider) {
    recorderServiceProvider
      .forceSwf(false)
      //.setSwfUrl('/lib/recorder.swf')
      .withMp3Conversion(false)
    ;
  });