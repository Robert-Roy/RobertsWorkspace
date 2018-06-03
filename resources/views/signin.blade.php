@extends("adminlayout")

@section('content')

<div class="centerxy">
    <div class="contentdiv">
        <img id="loginbanner" src="public/images/sign.png"/>
        <br>
        <br>
        <br>
        <form action="signin" method="post" onsubmit="">
            <div><center><input type="text" name="username" autocomplete="username" placeholder="username">
                    <input type="password" name="pw" placeholder="password"></center></div>
            <br>
            <input class="crispbutton" type="submit" value="Sign In">
            <?php
            if (!($message === "")) {
                // only print a message if there is one to print
                echo "<br><br>" . $message;
            }
            ?>
            {{ csrf_field() }}
        </form>
    </div>
    <br>
    <span class="colorwhite">Not Robert?</span>
    <a class="colorwhite" href="{{ config('constants.HOME')}}">Click Here</a>
</div>

@endsection