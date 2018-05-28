@extends("layout")

@section('content')

<div class="contentdiv">
    <p>I have used the following languages:</p>
    <ul class='shrink-list'>
        <li>PHP</li>
        <li>JavaScript</li>
        <li>SQL</li>
        <li>Linux</li>
        <li>ASP</li>
        <li>Java</li>
        <li>Python</li>
        <li>VB.NET</li>
    </ul>
</div>

<br>

<div class="contentdiv">
    <p>I have used the following APIs, libraries, frameworks, and softwares:</p>
    <ul class='shrink-list'>
        <li>KnockoutJS</li>
        <li>jQuery</li>
        <li>MySQL</li>
        <li>Linux</li>
        <li>PHPMailer</li>
        <li>GIMP 2</li>
        <li>WordPress</li>
        <li>Google Maps API</li>
        <li>Foursquare API</li>
        <li>IP-API</li>
        <li>cPanel</li>
        <li>XAMPP</li>
    </ul>
</div>

<br>

<div class="contentdiv">
    <p>This website uses:</p>
    <ul class='shrink-list'>
        <li>PHP (<?= phpversion(); ?>)</li>
        <li>Laravel ({{ App::VERSION() }})</li>
        <li>JavaScript</li>
        <li>jQuery</li>
        <li>Git</li>
        <li>MySQL (PDO)</li>
        <li>PHPMailer</li>
        <li>IP-API</li>
    </ul>
</div>

<br>

<div class="contentdiv">
    <p><a href="{{ config('constants.GITHUB')}}"> My code is available on GitHub</a></p>
</div>

@endsection
