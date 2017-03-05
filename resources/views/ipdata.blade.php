@extends("layout")

@section('content')

<div class="contentdiv" style="text-align:center">
    <p>Your IP:<br><?= $IP ?></p>
</div>
<br>
<div class="contentdiv">
    Your information:
    <br>
    <ul>
        <li>Country: {{ $country }} {{ $countryCode }}</li>
        <li>Region: {{ $regionName }} {{ $region }})</li>
        <li>City: {{ $city }}</li>
        <li>Zip: {{ $zip }}</li>
        <li>Coordinates: {{ $lat }}, {{ $lon }})</li>
        <li>Time Zone: {{ $timezone }}</li>
        <li>Internet Service Provider: {{ $isp }}</li>
        <li>Organization: {{ $org }}</li>
        <li>As Number/Name: {{ $as }}</li>
    </ul>
</div>
<br>
<div class="contentdiv">
    <p>Powered by: <a href="http://ip-api.com/">ip-api.com</a></p>
</div>

@endsection