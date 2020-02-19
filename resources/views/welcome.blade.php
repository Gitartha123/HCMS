@extends('layout')
@section('body')
    <div class="w3-card-4 w3-padding w3-center" style="max-width: 600px;margin:auto auto; top:40%;left:15%;right:15%;position:absolute;" align="center">
        <div class="w3-card-4 w3-margin w3-padding w3-border-aqua w3-round-medium w3-light-gray">
            <div class="w3-panel w3-border w3-margin w3-padding w3-border-gray w3-round-xlarge ">
                <strong style="color:black;font-size: 20px;" >LOGIN</strong>
            </div>
                    <form class="w3-container" method="post" action="{{ route('viewdashboard') }}">
                        <div class="w3-row w3-section">
                            <div class="w3-col" style="width:50px;">
                                <i class="w3-xxlarge fa fa-user w3-right w3-margin-right "></i>
                            </div>
                            <div class="w3-rest">
                                <input type="text"  name="username" class="w3-input w3-border w3-round-xlarge form-control" placeholder="Please enter your username" style="max-width: 500px;">
                            </div>
                        </div>
                        <div class="w3-row w3-section">
                            <div class="w3-col" style="width:50px">
                                <i class="w3-xxlarge fa fa-pencil w3-margin-right w3-right"></i>
                            </div>
                            <div class="w3-rest">
                                <input type="password"  name="password" id="myInput" class="w3-input w3-border w3-round-xlarge form-control" placeholder="Please enter your password"style="max-width: 500px;">
                                <span class="fa fa-fw fa-eye field-icon  w3-right  w3-xlarge" onclick="myFunction()" ></span>
                            </div>
                        </div>
                        <div class="w3-row w3-section">
                            <div class="w3-col" style="width:50px">
                               &nbsp;
                            </div>
                            <div class="w3-rest">
                                <button type="submit" class="w3-button  w3-hover w3-hover-red w3-border w3-border-grey w3-round-xlarge">Sign in</button>
                                <p>
                                    <a href="#" style="text-decoration: none;"><span style="text-align: center;color: blue;font-size: 15px;">forgot password ?</span></a>
                                </p>
                            </div>
                        </div>
                        {{ csrf_field() }}
                    </form>
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