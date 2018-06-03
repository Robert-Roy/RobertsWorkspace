@extends("adminlayout")

@section('content')

<div class="centerxy">
    <div class="contentdiv">
        <p>You are signed in.</p>
        <p>Your session will last <?= $sessionMinutes ?> minutes.</p>
        <a href="signout">Sign Out</a>
    </div>
</div>

@endsection