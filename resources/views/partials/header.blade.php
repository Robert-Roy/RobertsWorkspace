<html>
    <head>
        <meta charset="UTF-8">
        <title>{{ config('constants.SITENAME') }}</title>
        @include("partials.favicon")
        <link rel="stylesheet" href="{{ config('constants.CSS')}}">
        <link href='//fonts.googleapis.com/css?family=Abel' rel='stylesheet'>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script src="{{ config('constants.MAINSCRIPT')}}"></script>
        <script src="{{ config('constants.ANIMSCRIPT')}}"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <div id="main">
            <div id="header">
                <div id="navwrapper">
                    <canvas id="highlighter">                            </canvas>
                    <div id="namebar">
                        <a id="sitename" href="{{ config('constants.HOME')}}">{{ config('constants.SITENAME')}}</a>

                        <a id="header_burger" href="#" onClick="navpop();return false;">
                            <div class='burger'>Menu</div>
                        </a>
                    </div>
                    <nav id="navtop">
                        <a class="header_link" href="{{ config('constants.HOME')}}">Home</a>
                        <a class="header_link" href="{{ config('constants.PROJECTS')}}">Projects</a>
                        <a class="header_link" href="{{ config('constants.CONTACT')}}">Contact</a>
                    </nav>
                </div>
            </div>
            <div class="contentdiv titlediv">
                <h1>{!!$title!!}</h1>
            </div>
            <br>