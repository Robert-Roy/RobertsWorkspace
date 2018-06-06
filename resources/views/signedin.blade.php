@extends("adminlayout")

@section('content')

<div class="centerxy">
    <div class="contentdiv">
        <p>You are signed in.</p>
        <p>Your session will last <?= $sessionMinutes ?> minutes.</p>
        <form action="{{config('constants.PROJECTS')}}" method="get">
            <input class="crispbutton" style="margin-top:3px" type="submit" value="Edit Projects">
        </form>
        <form action="{{env('APP_URL')}}" method="get">
            <input class="crispbutton" style="margin-top:3px" type="submit" value="Return Home">
        </form>
        <form action="{{config('constants.SIGNOUT')}}" method="get">
            <input class="crispbutton" style="margin-top:3px" type="submit" value="Sign Out">
        </form>
    </div>
</div>

@endsection