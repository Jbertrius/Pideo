
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Post
    </title>
    <meta name="description" content="Pideo" />
    <meta name="keywords" content="html, pideo, streaming, social network, web design" />
    <meta name="author" content="Jbertrius" />
    <meta name="csrf-token" content="OG0Unm2N4PkTi31K5L2sNzrahB501NteWN8zrJ7I" />

    <!-- Favicons (created with http://realfavicongenerator.net/)-->
    <link rel="apple-touch-icon" sizes="57x57" href="http://pideo.com/img/favicons/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="http://pideo.com/img/favicons/apple-touch-icon-60x60.png">
    <link rel="icon" type="image/png" href="http://pideo.com/img/favicons/favicon-32x32.png&quot; sizes=&quot;32x32">
    <link rel="icon" type="image/png" href="http://pideo.com/img/favicons/favicon-16x16.png&quot; sizes=&quot;16x16">
    <link rel="manifest" href="http://pideo.com/img/favicons/manifest.json">
    <link rel="shortcut icon" href="http://pideo.com/img/favicons/favicon.ico">
    <meta name="msapplication-TileColor" content="#00a8ff">
    <meta name="msapplication-config" content="img/favicons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <script charset="UTF-8" src="//cdn.sendpulse.com/js/push/bb3da0af76b30bd3cd0143dfee6f15fc_1.js" async></script>

    <!--[if lt IE 9]>
    <link media="all" type="text/css" rel="stylesheet" href="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js">

    <link media="all" type="text/css" rel="stylesheet" href="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js">

    <![endif]-->

    <!-- Styles -->

    <link rel="stylesheet" type="text/css" href="http://pideo.com/css/normalize.css">
    <link rel="stylesheet" type="text/css" id="theme" href="http://pideo.com/css/theme-blue.css"/>
    <style>
        .breadcrumb{
            margin-bottom: 0px !important;
        }
    </style>
    <link rel="stylesheet" type="text/css"   href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>











</head>


<body>



<div class="page-container">
    <div class="page-sidebar" xmlns="http://www.w3.org/1999/html">
        <!-- START X-NAVIGATION -->
        <ul class="x-navigation">
            <li class="xn-logo">
                <a href= http://pideo.com ><img src="http://pideo.com/img/logo2.png" style="margin-top: -10px;"></a>
                <a href="#" class="x-navigation-control"></a>
            </li>
            <li class="xn-profile">
                <a href="#" class="profile-mini">
                    <img src="http://pideo.com/img/icons/user.png" alt="Charles  XAVIER"/>
                </a>
                <div class="profile">
                    <div class="profile-image">
                        <img src="http://pideo.com/img/icons/user.png"   alt="Charles  XAVIER"/>

                        <a class="edit-group" href="#">
                            <div class="edit-back" ></div>
                            <span class="fa fa-camera edit"></span>
                            <div class="edit-banner">Edit picture</div>
                        </a>

                    </div>

                    <div class="profile-data">
                        <div class="profile-data-name"><b>Charles  XAVIER</b></div>
                        <div class="profile-data-title"></div>
                    </div>
                    <div class="profile-controls">
                        <a href= http://pideo.com/profile class="profile-control-left"><span class="fa fa-info"></span></a>
                        <a href= http://pideo.com/messages class="profile-control-right"><span class="fa fa-envelope"></span></a>
                    </div>
                </div>
            </li>

            <li  class="active" >
                <a href= http://pideo.com/home >
                    <span class="fa fa-upload"></span> <span class="xn-text">Post a problem</span></a>
            </li>

            <li >
                <a href= http://pideo.com/map ><span class="fa fa-map-marker"></span> <span class="xn-text">Map</span></a>
            </li>


            <li >
                <a href= http://pideo.com/makepideo ><span class="fa fa-film"></span> <span class="xn-text">Make a Pideo</span></a>
            </li>


            <li >
                <a href= http://pideo.com/request ><span class="fa fa-share-square"></span> <span class="xn-text">My requests</span></a>
            </li>
        </ul>
        <input type="file" class="pp" >
        <!-- END X-NAVIGATION -->
    </div>
    <div class="page-content">
        <ul class="x-navigation x-navigation-horizontal x-navigation-panel">
            <!-- TOGGLE NAVIGATION -->
            <li class="xn-icon-button">
                <a href="#" class="x-navigation-minimize"><span class="fa fa-dedent"></span></a>
            </li>
            <!-- END TOGGLE NAVIGATION -->
            <!-- SEARCH -->
            <li class="xn-search">
                <form role="form">
                    <input type="text" name="search" placeholder="Search..."/>
                </form>
            </li>
            <!-- END SEARCH -->
            <!-- SIGN OUT -->
            <li class="xn-icon-button pull-right">
                <a href="#" class="mb-control" data-box="#mb-signout"><span class="fa fa-sign-out"></span></a>
            </li>
            <!-- END SIGN OUT -->
            <!-- MESSAGES -->
            <li class="xn-icon-button pull-right" id="counter1">
                <a href="#"><span class="fa fa-comments"></span></a>

                <div class="panel panel-primary animated zoomIn xn-drop-left xn-panel-dragging">
                    <div class="panel-heading">
                        <h3 class="panel-title"><span class="fa fa-comments"></span> Messages</h3>
                        <div class="pull-right" id="counter2">
                        </div>
                    </div>
                    <div class="panel-body list-group list-group-contacts scroll" id="msgNotif" style="height: 200px;">

                        <a href="/messages/?conversation=IgupCrZi8P8XIbAXiVUdxWH4J3sjo6" id = "1" class="list-group-item">
                            <div class="list-group-status status-online"></div>
                            <img src="img/icons/user.png" class="pull-left" alt="Pietro MAXIMOFF"/>
                            <span class="contacts-title">Pietro MAXIMOFF</span>

                            <p>


                                Fuck you!


                            </p>
                        </a>

                    </div>
                    <div class="panel-footer text-center">
                        <a href= http://pideo.com/messages >Show all messages</a>
                    </div>
                </div>
            </li>
            <!-- END MESSAGES -->

            <!-- TASKS -->
            <li class="xn-icon-button pull-right">
                <a href="#"><span class="fa fa-exclamation-circle"></span></a>

                <div class="informer informer-warning" >1</div>

                <div class="panel panel-primary animated zoomIn xn-drop-left xn-panel-dragging">
                    <div class="panel-heading">
                        <h3 class="panel-title"><span class="fa fa-exclamation-circle"></span>  Requests</h3>
                        <div class="pull-right">
                            <div class="label label-warning" >1 new</div>
                        </div>
                    </div>
                    <div class="panel-body list-group scroll" style="height: 200px;">

                        <a class="list-group-item" href="/post/6">
                            <strong>Test</strong>
                            <br>
                            <span class="label label-success">Accountancy, finance, business &amp; management studie</span>
                            <p>
                                <small class="text-muted">Charles XAVIER, 18/10/2016 </small>
                            </p>
                        </a>
                    </div>
                    <div class="panel-footer text-center">
                        <a href= http://pideo.com/notifications >Show all requests</a>
                    </div>
                </div>
            </li>
            <!-- END TASKS -->
        </ul>

        <!-- MESSAGE BOX-->
        <div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-sign-out"></span> Log <strong>Out</strong> ?</div>
                    <div class="mb-content">
                        <p>Are you sure you want to log out?</p>
                        <p>Press No if you want to continue work. Press Yes to logout current user.</p>
                    </div>
                    <div class="mb-footer">
                        <div class="pull-right">
                            <a href= "http://pideo.com/auth/logout" class="btn btn-success btn-lg">Yes</a>
                            <button class="btn btn-default btn-lg mb-control-close">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MESSAGE BOX-->

        <!-- START PRELOADS -->
        <audio id="audio-alert" src="http://pideo.com/audio/alert.mp3" preload="auto"></audio>
        <audio id="audio-fail" src="http://pideo.com/audio/fail.mp3" preload="auto"></audio>
        <!-- END PRELOADS -->

        <div class="page-title">
            <h2>Post</h2>
        </div>

        <div class="row">
            <div class="col-md-9">

                <div class="panel panel-default">
                    <div class="panel-body posts">

                        <div class="post-item">
                            <div class="post-title">
                                Test

                                <div class="pull-right"><div class="label label-warning" style="font-size: 12px">Accountancy, finance, business &amp; management studie</div> </div>
                            </div>
                            <div class="post-date"><span class="fa fa-calendar"></span> 18/10/2016 /  by Charles XAVIER </div>
                            <div class="post-text">
                                This sis  a test
                            </div>
                            <div class="post-row">
                                <button class="btn btn-default btn-rounded "><span class="fa fa-envelope"></span> Respond</button>
                                <button class="btn btn-default btn-rounded "><span class="fa fa-film"></span> Respond with a pideo</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>



        </div>
    </div>


</div>



<!-- Scripts -->
<script src="/build/js/app-7447d25fa6.js"></script>

<script type="text/javascript">
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('/sp-push-worker.js').then(function(registration) {
            // Registration was successful
            console.log('ServiceWorker registration successful with scope: ', registration.scope);
        }).catch(function(err) {
            // registration failed :(
            console.log('ServiceWorker registration failed: ', err);
        });
    }
</script>

<script src="//js.pusher.com/3.2.0/pusher.min.js"></script>
<script type="text/javascript" src="http://pideo.com/js/editPic.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


<script>
    Pusher.logToConsole = true; var pusher = new Pusher('457aa5e1207d59c5598f', { cluster: "eu" }), user_id   = "1";
</script>
<script src="js/notif.js"></script>
<script type="text/javascript" src="http://pideo.com/js/plugins/jquery/jquery-ui.min.js"></script>
<script type='text/javascript' src="http://pideo.com/js/plugins/icheck/icheck.min.js"></script>
<script type="text/javascript" src="http://pideo.com/js/plugins/dropzone/dropzone.min.js"></script>
<script type="text/javascript" src="http://pideo.com/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
<script type="text/javascript" src="http://pideo.com/js/plugins/scrolltotop/scrolltopcontrol.js"></script>
<script type="text/javascript" src="http://pideo.com/js/plugins/backstretch/jquery.backstretch.min.js"></script>
<script type="text/javascript" src="http://pideo.com/js/settings.js"></script>
<script type="text/javascript" src="http://pideo.com/js/plugins.js"></script>


<link rel='stylesheet' type='text/css' property='stylesheet' href='http://pideo.com/_debugbar/assets/stylesheets?v=1472092711'><script type='text/javascript' src='http://pideo.com/_debugbar/assets/javascript?v=1472092700'></script><script type="text/javascript">jQuery.noConflict(true);</script>
<script type="text/javascript">
    var phpdebugbar = new PhpDebugBar.DebugBar();
    phpdebugbar.addTab("messages", new PhpDebugBar.DebugBar.Tab({"icon":"list-alt","title":"Messages", "widget": new PhpDebugBar.Widgets.MessagesWidget()}));
    phpdebugbar.addIndicator("time", new PhpDebugBar.DebugBar.Indicator({"icon":"clock-o","tooltip":"Request Duration"}), "right");
    phpdebugbar.addTab("timeline", new PhpDebugBar.DebugBar.Tab({"icon":"tasks","title":"Timeline", "widget": new PhpDebugBar.Widgets.TimelineWidget()}));
    phpdebugbar.addIndicator("memory", new PhpDebugBar.DebugBar.Indicator({"icon":"cogs","tooltip":"Memory Usage"}), "right");
    phpdebugbar.addTab("exceptions", new PhpDebugBar.DebugBar.Tab({"icon":"bug","title":"Exceptions", "widget": new PhpDebugBar.Widgets.ExceptionsWidget()}));
    phpdebugbar.addTab("views", new PhpDebugBar.DebugBar.Tab({"icon":"leaf","title":"Views", "widget": new PhpDebugBar.Widgets.TemplatesWidget()}));
    phpdebugbar.addTab("route", new PhpDebugBar.DebugBar.Tab({"icon":"share","title":"Route", "widget": new PhpDebugBar.Widgets.VariableListWidget()}));
    phpdebugbar.addIndicator("currentroute", new PhpDebugBar.DebugBar.Indicator({"icon":"share","tooltip":"Route"}), "right");
    phpdebugbar.addTab("queries", new PhpDebugBar.DebugBar.Tab({"icon":"inbox","title":"Queries", "widget": new PhpDebugBar.Widgets.SQLQueriesWidget()}));
    phpdebugbar.addTab("emails", new PhpDebugBar.DebugBar.Tab({"icon":"inbox","title":"Mails", "widget": new PhpDebugBar.Widgets.MailsWidget()}));
    phpdebugbar.addTab("session", new PhpDebugBar.DebugBar.Tab({"icon":"archive","title":"Session", "widget": new PhpDebugBar.Widgets.VariableListWidget()}));
    phpdebugbar.addTab("request", new PhpDebugBar.DebugBar.Tab({"icon":"tags","title":"Request", "widget": new PhpDebugBar.Widgets.VariableListWidget()}));
    phpdebugbar.setDataMap({
        "messages": ["messages.messages", []],
        "messages:badge": ["messages.count", null],
        "time": ["time.duration_str", '0ms'],
        "timeline": ["time", {}],
        "memory": ["memory.peak_usage_str", '0B'],
        "exceptions": ["exceptions.exceptions", []],
        "exceptions:badge": ["exceptions.count", null],
        "views": ["views", []],
        "views:badge": ["views.nb_templates", 0],
        "route": ["route", {}],
        "currentroute": ["route.uri", ],
        "queries": ["queries", []],
        "queries:badge": ["queries.nb_statements", 0],
        "emails": ["swiftmailer_mails.mails", []],
        "emails:badge": ["swiftmailer_mails.count", null],
        "session": ["session", {}],
        "request": ["request", {}]
    });
    phpdebugbar.restoreState();
    phpdebugbar.ajaxHandler = new PhpDebugBar.AjaxHandler(phpdebugbar);
    phpdebugbar.ajaxHandler.bindToXHR();
    phpdebugbar.setOpenHandler(new PhpDebugBar.OpenHandler({"url":"http:\/\/pideo.com\/_debugbar\/open"}));
    phpdebugbar.addDataSet({"__meta":{"id":"8ca5d41cfe14851af04065c45466e774","datetime":"2016-10-19 03:18:55","utime":1476847135.0856,"method":"GET","uri":"\/post\/6","ip":"127.0.0.1"},"php":{"version":"5.6.16","interface":"apache2handler"},"messages":{"count":0,"messages":[]},"time":{"start":1476847132.821,"end":1476847135.0866,"duration":2.2656087875366,"duration_str":"2.27s","measures":[{"label":"Booting","start":1476847132.821,"relative_start":0,"end":1476847133.9705,"relative_end":1476847133.9705,"duration":1.1495449542999,"duration_str":"1.15s","params":[],"collector":null},{"label":"Application","start":1476847133.4185,"relative_start":0.59751296043396,"end":1476847135.0866,"relative_end":0,"duration":1.6680958271027,"duration_str":"1.67s","params":[],"collector":null}]},"memory":{"peak_usage":11534336,"peak_usage_str":"11MB"},"exceptions":{"count":0,"exceptions":[]},"views":{"nb_templates":4,"templates":[{"name":"front.post (\\resources\\views\\front\\post.blade.php)","param_count":5,"params":["description","content","users","date","category"],"type":"blade"},{"name":"partials.sidebar (\\resources\\views\\partials\\sidebar.blade.php)","param_count":19,"params":["obLevel","__env","app","errors","description","content","users","date","category","posts","postCounter","post","conversations","counter","conversation","firstname","lastname","page","profilePic"],"type":"blade"},{"name":"partials.navbar (\\resources\\views\\partials\\navbar.blade.php)","param_count":15,"params":["obLevel","__env","app","errors","description","content","users","date","category","posts","postCounter","post","conversations","counter","conversation"],"type":"blade"},{"name":"layouts.master (\\resources\\views\\layouts\\master.blade.php)","param_count":15,"params":["obLevel","__env","app","errors","description","content","users","date","category","posts","postCounter","post","conversations","counter","conversation"],"type":"blade"}]},"route":{"uri":"GET post\/{id?}","middleware":"0, 1","as":"getpost","controller":"App\\Http\\Controllers\\PostController@index","namespace":"App\\Http\\Controllers","prefix":null,"where":[],"file":"\\app\\Http\\Controllers\\PostController.php:17-32"},"queries":{"nb_statements":13,"nb_failed_statements":0,"accumulated_duration":0.019,"accumulated_duration_str":"19ms","statements":[{"sql":"select * from `users` where `users`.`id` = '1' limit 1","params":{"0":"1","hints":"Use <code>SELECT *<\/code> only if you need all columns from table<br \/><code>LIMIT<\/code> without <code>ORDER BY<\/code> causes non-deterministic results, depending on the query execution plan"},"duration":0.002,"duration_str":"2ms","stmt_id":null,"connection":"pideo"},{"sql":"select * from `post` where `id` = '6' limit 1","params":{"0":"6","hints":"Use <code>SELECT *<\/code> only if you need all columns from table<br \/><code>LIMIT<\/code> without <code>ORDER BY<\/code> causes non-deterministic results, depending on the query execution plan"},"duration":0.001,"duration_str":"1ms","stmt_id":null,"connection":"pideo"},{"sql":"select * from `users` where `users`.`id` = '1' limit 1","params":{"0":"1","hints":"Use <code>SELECT *<\/code> only if you need all columns from table<br \/><code>LIMIT<\/code> without <code>ORDER BY<\/code> causes non-deterministic results, depending on the query execution plan"},"duration":0.001,"duration_str":"1ms","stmt_id":null,"connection":"pideo"},{"sql":"select * from `subjects` where `subjects`.`id` = '1' limit 1","params":{"0":"1","hints":"Use <code>SELECT *<\/code> only if you need all columns from table<br \/><code>LIMIT<\/code> without <code>ORDER BY<\/code> causes non-deterministic results, depending on the query execution plan"},"duration":0.002,"duration_str":"2ms","stmt_id":null,"connection":"pideo"},{"sql":"select * from `post_notification` where `user_id` = '1' order by `created_at` desc","params":{"0":"1","hints":"Use <code>SELECT *<\/code> only if you need all columns from table"},"duration":0.002,"duration_str":"2ms","stmt_id":null,"connection":"pideo"},{"sql":"select `conversations`.*, `conversations_users`.`user_id` as `pivot_user_id`, `conversations_users`.`conversation_id` as `pivot_conversation_id` from `conversations` inner join `conversations_users` on `conversations`.`id` = `conversations_users`.`conversation_id` where `conversations_users`.`user_id` = '1' order by `update_at` desc","params":{"0":"1","hints":"Use <code>SELECT *<\/code> only if you need all columns from table"},"duration":0.001,"duration_str":"1ms","stmt_id":null,"connection":"pideo"},{"sql":"select count(*) as aggregate from `messages_notifications` where `messages_notifications`.`conversation_id` = '1' and `messages_notifications`.`conversation_id` is not null and `read` = '0' and `user_id` = '1'","params":{"0":"1","1":"0","2":"1"},"duration":0.002,"duration_str":"2ms","stmt_id":null,"connection":"pideo"},{"sql":"select `users`.*, `conversations_users`.`conversation_id` as `pivot_conversation_id`, `conversations_users`.`user_id` as `pivot_user_id` from `users` inner join `conversations_users` on `users`.`id` = `conversations_users`.`user_id` where `conversations_users`.`conversation_id` = '1' and `user_id` <> '1'","params":{"0":"1","1":"1","hints":"Use <code>SELECT *<\/code> only if you need all columns from table"},"duration":0.002,"duration_str":"2ms","stmt_id":null,"connection":"pideo"},{"sql":"select * from `messages` where `messages`.`conversation_id` = '1' and `messages`.`conversation_id` is not null","params":{"0":"1","hints":"Use <code>SELECT *<\/code> only if you need all columns from table"},"duration":0.001,"duration_str":"1ms","stmt_id":null,"connection":"pideo"},{"sql":"select count(*) as aggregate from `messages_notifications` where `messages_notifications`.`conversation_id` = '1' and `messages_notifications`.`conversation_id` is not null and `read` = '0' and `user_id` = '1'","params":{"0":"1","1":"0","2":"1"},"duration":0.002,"duration_str":"2ms","stmt_id":null,"connection":"pideo"},{"sql":"select * from `post` where `post`.`id` = '6' limit 1","params":{"0":"6","hints":"Use <code>SELECT *<\/code> only if you need all columns from table<br \/><code>LIMIT<\/code> without <code>ORDER BY<\/code> causes non-deterministic results, depending on the query execution plan"},"duration":0.001,"duration_str":"1ms","stmt_id":null,"connection":"pideo"},{"sql":"select * from `subjects` where `subjects`.`id` = '1' limit 1","params":{"0":"1","hints":"Use <code>SELECT *<\/code> only if you need all columns from table<br \/><code>LIMIT<\/code> without <code>ORDER BY<\/code> causes non-deterministic results, depending on the query execution plan"},"duration":0.001,"duration_str":"1ms","stmt_id":null,"connection":"pideo"},{"sql":"select * from `users` where `users`.`id` = '1' limit 1","params":{"0":"1","hints":"Use <code>SELECT *<\/code> only if you need all columns from table<br \/><code>LIMIT<\/code> without <code>ORDER BY<\/code> causes non-deterministic results, depending on the query execution plan"},"duration":0.001,"duration_str":"1ms","stmt_id":null,"connection":"pideo"}]},"swiftmailer_mails":{"count":0,"mails":[]},"session":{"_token":"OG0Unm2N4PkTi31K5L2sNzrahB501NteWN8zrJ7I","locale":"fr","login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d":"1","statut":"user","_previous":"array:1 [\n  \"url\" => \"http:\/\/pideo.com\/post\/6\"\n]","PHPDEBUGBAR_STACK_DATA":"[]","flash":"array:2 [\n  \"old\" => []\n  \"new\" => []\n]"},"request":{"format":"html","content_type":"text\/html; charset=UTF-8","status_text":"OK","status_code":"200","request_query":"[]","request_request":"[]","request_headers":"array:9 [\n  \"host\" => array:1 [\n    0 => \"pideo.com\"\n  ]\n  \"connection\" => array:1 [\n    0 => \"keep-alive\"\n  ]\n  \"upgrade-insecure-requests\" => array:1 [\n    0 => \"1\"\n  ]\n  \"user-agent\" => array:1 [\n    0 => \"Mozilla\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\/537.36 (KHTML, like Gecko) Chrome\/53.0.2785.143 Safari\/537.36\"\n  ]\n  \"accept\" => array:1 [\n    0 => \"text\/html,application\/xhtml+xml,application\/xml;q=0.9,image\/webp,*\/*;q=0.8\"\n  ]\n  \"referer\" => array:1 [\n    0 => \"http:\/\/pideo.com\/\"\n  ]\n  \"accept-encoding\" => array:1 [\n    0 => \"gzip, deflate\"\n  ]\n  \"accept-language\" => array:1 [\n    0 => \"fr-FR,fr;q=0.8,en-US;q=0.6,en;q=0.4\"\n  ]\n  \"cookie\" => array:1 [\n    0 => \"__utma=219508888.1950535221.1474163890.1474163890.1474163890.1; __utmz=219508888.1474163890.1.1.utmcsr=(direct)|utmccn=(direct)|utmcmd=(none); VisitorID=e775caf0-32de-468a-8ea1-c417be30aa53&Exp=9\/23\/2019 10:38:48 PM; remember_web_59ba36addc2b2f9401580f014c7f58ea4e30989d=eyJpdiI6Imp4MHNUeEg3dTVLR1p6MENjalFKaEE9PSIsInZhbHVlIjoiWWNXNGFhRUVWYWZlNTNpQWJNQ29yVE5wVWVUeGZwbFZCNFFDVVRjcnp2Y3NJUWxtRGFISHcxVnd2clJKSVhPMVpiTXZXOTlNckRFTWpsOEdzSE54blBGN3pic3M1cXBSQW1lNzM5UyswV1E9IiwibWFjIjoiNmI0ZWRlOWZmNzhkNzU1MDM2NGNiNDdlMTlmODQ2OTE5MjIwNjk0MmM0M2EyZmQ0MDMwYWYyMzA1Mjg5MmEwZiJ9; XSRF-TOKEN=eyJpdiI6InIybk93WVFNN3RzNm15WFZqM1FpNkE9PSIsInZhbHVlIjoiSHNLbXpDTGdTN01EQlwvV0czcFFDWEVLQTRTVHlXTzBldk1oNkJDZzc0RTd1VEtpVUx1VlRyOUlWVVJQUmJXVEpoTjg5VHlsczJxS1QzU1pubUpJMEtBPT0iLCJtYWMiOiI3YTNjZjIwZjhiZDczOGI2OTc3MThjM2I4NjZkOTdkYTEyOWU2NjI4Mzk4MjI0ZGZkNGVkNzU1YzY3ODU0NmMxIn0%3D; laravel_session=eyJpdiI6Im1LbE5iZ01tZnRnKzNjRFN1STdGM1E9PSIsInZhbHVlIjoiMUk1dnFHTFJBWlVrTVlDMTY0OHRKV3B6TXlLOWw1UVZpSHVXQU13RHprODhwejZuMStMdHR2RTYrRXRGWkx5MXJNNk9BdXMxXC9QV015NzFXdnU3OVpnPT0iLCJtYWMiOiJjM2JlYzk1ODhiMmMyNTdlMWJjZTAxZWJhOWY2MjQ1NWU2ZmYxMjk1YjRmNDdmYzk0MGY1ODE0YWQzNzgxZWE4In0%3D\"\n  ]\n]","request_server":"array:38 [\n  \"REDIRECT_STATUS\" => \"200\"\n  \"HTTP_HOST\" => \"pideo.com\"\n  \"HTTP_CONNECTION\" => \"keep-alive\"\n  \"HTTP_UPGRADE_INSECURE_REQUESTS\" => \"1\"\n  \"HTTP_USER_AGENT\" => \"Mozilla\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\/537.36 (KHTML, like Gecko) Chrome\/53.0.2785.143 Safari\/537.36\"\n  \"HTTP_ACCEPT\" => \"text\/html,application\/xhtml+xml,application\/xml;q=0.9,image\/webp,*\/*;q=0.8\"\n  \"HTTP_REFERER\" => \"http:\/\/pideo.com\/\"\n  \"HTTP_ACCEPT_ENCODING\" => \"gzip, deflate\"\n  \"HTTP_ACCEPT_LANGUAGE\" => \"fr-FR,fr;q=0.8,en-US;q=0.6,en;q=0.4\"\n  \"HTTP_COOKIE\" => \"__utma=219508888.1950535221.1474163890.1474163890.1474163890.1; __utmz=219508888.1474163890.1.1.utmcsr=(direct)|utmccn=(direct)|utmcmd=(none); VisitorID=e775caf0-32de-468a-8ea1-c417be30aa53&Exp=9\/23\/2019 10:38:48 PM; remember_web_59ba36addc2b2f9401580f014c7f58ea4e30989d=eyJpdiI6Imp4MHNUeEg3dTVLR1p6MENjalFKaEE9PSIsInZhbHVlIjoiWWNXNGFhRUVWYWZlNTNpQWJNQ29yVE5wVWVUeGZwbFZCNFFDVVRjcnp2Y3NJUWxtRGFISHcxVnd2clJKSVhPMVpiTXZXOTlNckRFTWpsOEdzSE54blBGN3pic3M1cXBSQW1lNzM5UyswV1E9IiwibWFjIjoiNmI0ZWRlOWZmNzhkNzU1MDM2NGNiNDdlMTlmODQ2OTE5MjIwNjk0MmM0M2EyZmQ0MDMwYWYyMzA1Mjg5MmEwZiJ9; XSRF-TOKEN=eyJpdiI6InIybk93WVFNN3RzNm15WFZqM1FpNkE9PSIsInZhbHVlIjoiSHNLbXpDTGdTN01EQlwvV0czcFFDWEVLQTRTVHlXTzBldk1oNkJDZzc0RTd1VEtpVUx1VlRyOUlWVVJQUmJXVEpoTjg5VHlsczJxS1QzU1pubUpJMEtBPT0iLCJtYWMiOiI3YTNjZjIwZjhiZDczOGI2OTc3MThjM2I4NjZkOTdkYTEyOWU2NjI4Mzk4MjI0ZGZkNGVkNzU1YzY3ODU0NmMxIn0%3D; laravel_session=eyJpdiI6Im1LbE5iZ01tZnRnKzNjRFN1STdGM1E9PSIsInZhbHVlIjoiMUk1dnFHTFJBWlVrTVlDMTY0OHRKV3B6TXlLOWw1UVZpSHVXQU13RHprODhwejZuMStMdHR2RTYrRXRGWkx5MXJNNk9BdXMxXC9QV015NzFXdnU3OVpnPT0iLCJtYWMiOiJjM2JlYzk1ODhiMmMyNTdlMWJjZTAxZWJhOWY2MjQ1NWU2ZmYxMjk1YjRmNDdmYzk0MGY1ODE0YWQzNzgxZWE4In0%3D\"\n  \"PATH\" => \"C:\\Program Files (x86)\\AMD APP\\bin\\x86_64;C:\\Program Files (x86)\\AMD APP\\bin\\x86;C:\\ProgramData\\Oracle\\Java\\javapath;C:\\Program Files (x86)\\NVIDIA Corporation\\PhysX\\Common;C:\\Windows\\system32;C:\\Windows;C:\\Windows\\System32\\Wbem;C:\\Windows\\System32\\WindowsPowerShell\\v1.0\\;C:\\Program Files (x86)\\ATI Technologies\\ATI.ACE\\Core-Static;C:\\Program Files (x86)\\MacType;C:\\Program Files\\MATLAB\\R2013b\\runtime\\win64;C:\\Program Files\\MATLAB\\R2013b\\bin;C:\\Program Files\\MATLAB\\R2013b\\polyspace\\bin;C:\\Program Files (x86)\\QuickTime\\QTSystem\\;C:\\Program Files (x86)\\Java\\jdk1.7.0_45\\bin;c:\\Program Files (x86)\\Microsoft SQL Server\\100\\Tools\\Binn\\;c:\\Program Files\\Microsoft SQL Server\\100\\Tools\\Binn\\;c:\\Program Files\\Microsoft SQL Server\\100\\DTS\\Binn\\;C:\\Program Files (x86)\\Universal Extractor;C:\\Program Files (x86)\\Universal Extractor\\bin;C:\\Program Files (x86)\\AMD\\ATI.ACE\\Core-Static;C:\\Program Files (x86)\\Xilinx92i\\bin\\nt;C:\\Program Files (x86)\\Skype\\Phone\\;C:\\Program Files\\3CX PhoneSystem\\Bin;C:\\Xampp\\php;C:\\ProgramData\\ComposerSetup\\bin;C:\\Users\\Jean.Bertrand\\Logiciels\\Ffmpeg\\bin;C:\\Users\\Jean.Bertrand\\Logiciels\\PhantomJS\\bin;C:\\Users\\Jean.Bertrand\\AppData\\Roaming\\Dashlane\\4.5.0.13208\\bin\\Firefox_Extension\\{442718d9-475e-452a-b3e1-fb1ee16b8e9f}\\components;C:\\Users\\Jean.Bertrand\\AppData\\Roaming\\Dashlane\\4.5.1.15044\\bin\\Firefox_Extension\\{442718d9-475e-452a-b3e1-fb1ee16b8e9f}\\components;C:\\Program Files (x86)\\Nmap\"\n  \"SystemRoot\" => \"C:\\Windows\"\n  \"COMSPEC\" => \"C:\\Windows\\system32\\cmd.exe\"\n  \"PATHEXT\" => \".COM;.EXE;.BAT;.CMD;.VBS;.VBE;.JS;.JSE;.WSF;.WSH;.MSC\"\n  \"WINDIR\" => \"C:\\Windows\"\n  \"SERVER_SIGNATURE\" => \"\"\n  \"SERVER_SOFTWARE\" => \"Apache\/2.4.17 (Win32) OpenSSL\/1.0.2d PHP\/5.6.16\"\n  \"SERVER_NAME\" => \"pideo.com\"\n  \"SERVER_ADDR\" => \"127.0.0.1\"\n  \"SERVER_PORT\" => \"80\"\n  \"REMOTE_ADDR\" => \"127.0.0.1\"\n  \"DOCUMENT_ROOT\" => \"C:\/laragon\/www\/Pideo\/public\/\"\n  \"REQUEST_SCHEME\" => \"http\"\n  \"CONTEXT_PREFIX\" => \"\"\n  \"CONTEXT_DOCUMENT_ROOT\" => \"C:\/laragon\/www\/Pideo\/public\/\"\n  \"SERVER_ADMIN\" => \"admin@example.com\"\n  \"SCRIPT_FILENAME\" => \"C:\/laragon\/www\/Pideo\/public\/index.php\"\n  \"REMOTE_PORT\" => \"22320\"\n  \"REDIRECT_URL\" => \"http:\/\/pideo.com\/post\/6\"\n  \"GATEWAY_INTERFACE\" => \"CGI\/1.1\"\n  \"SERVER_PROTOCOL\" => \"HTTP\/1.1\"\n  \"REQUEST_METHOD\" => \"GET\"\n  \"QUERY_STRING\" => \"\"\n  \"REQUEST_URI\" => \"\/post\/6\"\n  \"SCRIPT_NAME\" => \"\/index.php\"\n  \"PHP_SELF\" => \"\/index.php\"\n  \"REQUEST_TIME_FLOAT\" => 1476847132.821\n  \"REQUEST_TIME\" => 1476847132\n]","request_cookies":"array:6 [\n  \"__utma\" => null\n  \"__utmz\" => null\n  \"VisitorID\" => null\n  \"remember_web_59ba36addc2b2f9401580f014c7f58ea4e30989d\" => \"1|eONHzHxd64CZIUaBhh1L9YXbQhEdtchaRlV7Me5hKKVba8xJoSDrhLOqepEN\"\n  \"XSRF-TOKEN\" => \"OG0Unm2N4PkTi31K5L2sNzrahB501NteWN8zrJ7I\"\n  \"laravel_session\" => \"b81d450e809b7414aae120b4f87169d8fcfb523f\"\n]","response_headers":"array:3 [\n  \"cache-control\" => array:1 [\n    0 => \"no-cache\"\n  ]\n  \"content-type\" => array:1 [\n    0 => \"text\/html; charset=UTF-8\"\n  ]\n  \"Set-Cookie\" => array:2 [\n    0 => \"XSRF-TOKEN=eyJpdiI6IjErQmJ6cDVGeStMRXlQQ1dCSVBYbVE9PSIsInZhbHVlIjoic0lqWHZuXC9xbDBkWG03bkJUOWNkcHBzSGxUYnBHeHJJXC9oN0VIbmRDd1dPYUhzVlhpUHA5REMxdXB3Sysxd1JLNk5haWZ1K3JxQ3V1b3dqY3FLdExGUT09IiwibWFjIjoiZmRlZTNiZjJhZjNjZmVhZGI0MzNmNGQ3YjkwODk4YTA0MTk3MWRmYTZhYjkwN2FkNjU0ZjUxZWFiNzUzNWMyNiJ9; expires=Wed, 19-Oct-2016 05:18:54 GMT; path=\/\"\n    1 => \"laravel_session=eyJpdiI6IlwvVXJwNVlRUlI4R3AzQkEyeDloWDhRPT0iLCJ2YWx1ZSI6ImhURDhGMGhpZWQ3QVMyUndvdjErOFVNN3Q1OENsSHVBTFFpY25CQnBpcHNXcjRiM0tDNjJHS1VzdEZhQU9kMzlrTldvVUUrUDJYclk0UFpaQmhTd2Z3PT0iLCJtYWMiOiIxNmZjNmQ4MDkxNWQ3M2ZmN2EyMzJjZTlhZTU3OTRkNGIzYzcyYzE5MDFjNGY5ZjI0M2E4NTNmOTQ3NWUwNWQ2In0%3D; expires=Wed, 19-Oct-2016 05:18:55 GMT; path=\/; httponly\"\n  ]\n]","path_info":"\/post\/6","session_attributes":"array:7 [\n  \"_token\" => \"OG0Unm2N4PkTi31K5L2sNzrahB501NteWN8zrJ7I\"\n  \"locale\" => \"fr\"\n  \"login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d\" => 1\n  \"statut\" => \"user\"\n  \"_previous\" => array:1 [\n    \"url\" => \"http:\/\/pideo.com\/post\/6\"\n  ]\n  \"PHPDEBUGBAR_STACK_DATA\" => []\n  \"flash\" => array:2 [\n    \"old\" => []\n    \"new\" => []\n  ]\n]"}}, "8ca5d41cfe14851af04065c45466e774");

</script>
</body>
</html>