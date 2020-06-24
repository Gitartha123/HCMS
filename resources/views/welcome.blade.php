<style>
    .blink {
        animation: blinker 1s ;
        color: red;
        font-size: 15px;
        font-weight: bold;
        font-family: sans-serif;
    }
    @keyframes blinker {
        50% {
            opacity: 0;
        }
    }
    .fa-user-o{
        color: white;
    }
    .fa-pencil{
        color:white;
    }
</style>
    @extends('layout')
    @section('body')
<div class="w3-card-4 w3-padding w3-center w3-border w3-border-blue" style="max-width: 600px;margin:auto auto; top:25%;left:15%;right:15%;position:absolute;" align="center">
        <div class="w3-card-4 w3-margin w3-padding  w3-round-medium w3-border w3-border-white" style="background-color: rgba(0,0,0, 0.4);">
            <div class="w3-panel w3-border w3-margin w3-padding w3-border-white w3-round-xlarge">
                <strong style="color:white;font-size: 20px;" >LOGIN</strong>
            </div>
            @if(Session::has('nopermit'))
                <strong style="color: red">{{ Session::get('nopermit') }}</strong>
                @endif
                    <form class="w3-container" method="post" action="{{ route('Employeelogin') }}">
                        <div class="w3-row w3-section">
                            <div class="w3-col" style="width:50px;">
                                <i class="w3-xxlarge fa fa-user-o w3-right w3-margin-right "></i>
                            </div>
                            <div class="w3-rest">
                                <input type="text"  name="username" class="w3-input w3-border w3-round-xlarge form-control " placeholder="Please enter your userid" style="max-width: 500px;" required autocomplete="username" autofocus>
                            </div>
                        </div>
                        <div class="w3-row w3-section">
                            <div class="w3-col" style="width:50px">
                                <i class="w3-xxlarge fa fa-pencil w3-margin-right w3-right"></i>
                            </div>
                            <div class="w3-rest">
                                <input type="password" id="myInput" class="w3-input w3-border w3-round-xlarge form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Please enter your password"style="max-width: 500px;">
                                <span class="fa fa-fw fa-eye field-icon  w3-right  w3-xlarge" onclick="myFunction()" ></span>
                                @if(Session::has('error'))
                                    <h6 class="blink">{{ Session::get('error') }}</h6>
                                @endif
                            </div>
                        </div>
                        <div class="w3-row w3-section">
                            <div class="w3-col" style="width:50px">
                               &nbsp;
                            </div>
                            <div class="w3-rest">
                                <button type="submit" class="zoom w3-button  w3-hover w3-hover-red w3-red w3-round-xlarge">Sign in</button>
                                <p>
                                    <a href="#" style="text-decoration: none;"><span style="text-align: center;color: white;font-size: 15px;">forgot password ?</span></a>
                                </p>
                            </div>
                        </div>
                        {{ csrf_field() }}
                    </form>
        </div>
    </div>
        <script>
            function myFunction() {
                var x = document.getElementById("myInput");
                if (x.type === "password") {
                    x.type = "text";
                } else {
                    x.type = "password";
                }
            }
        </script>
@endsection