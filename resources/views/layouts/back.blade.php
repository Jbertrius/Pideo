<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>Juizy Slideshow - Full CSS3/HTML5 slideshow</title>

    <link href='http://fonts.googleapis.com/css?family=Mr+Dafoe' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Amaranth:700' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" type="text/css" href="{{asset('css/styles.css')}}">
</head>
<body>



<h1><span class="cursive"></span> <span>Full CSS3/HTML5 slideshow</span></h1>
<h2 class="sread">The slideshow</h2>


<section id="slideshow">


    <a class="play_commands pause" href="#sl_pause" title="Maintain paused">Pause</a>
    <a class="play_commands play" href="#sl_play" title="Play the animation">Play</a>

    <div class="container">
        <div class="c_slider"></div>
        <div class="slider">
@for($i = 0; $i< $cpt; $i++)
            <figure>
                <img src=" {{ 'images/'.${'img'.$i}.'/0' }} " alt="" width="1000" height="563" />
            </figure>
@endfor
        </div>
    </div>

    <span id="timeline"></span>

    <ul class="dots_commands"><!--
			--><li><a title="Show slide 1" href="#sl_i1">Slide 1</a></li><!--
			--><li><a title="Show slide 2" href="#sl_i2">Slide 2</a></li><!--
			--><li><a title="Show slide 3" href="#sl_i3">Slide 3</a></li><!--
			--><li><a title="Show slide 4" href="#sl_i4">Slide 4</a></li>
    </ul>

</section>



</body>
</html>