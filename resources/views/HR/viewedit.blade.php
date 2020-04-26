<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="public/css/style.css" rel="stylesheet" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/momentjs/2.14.1/moment.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="public/js/DropdownForRegistration.js"></script>
<script src="public/js/DateTimePicker.js"></script>
<script src="public/js/jquery.validate.js"></script>
<script src="public/js/ValidationForRegistration.js"></script>
<script src="public\js\confirmSubmit.js"></script>
<link href="public/css/zoombutton.css" rel="stylesheet" type="text/css">

@include('HR.sidebar')
<style>
    label{
        font-weight: bold;
    }

    @media screen and (min-width: 992px) {
        .topnav {
            right:0;left:15%;position:absolute;
        }
    }
    a{
        text-decoration: none;
    }
</style>

<div  class="w3-card-4 w3-padding  w3-animate-zoom topnav" id="action">
    <div class="w3-card-4  w3-padding w3-border-aqua w3-round-medium w3-light-gray">
        <div class="w3-panel w3-border  w3-padding w3-border-gray w3-round-xlarge w3-center">
            <strong style="color:black;font-size: 20px;"> EMPLOYEE DETAILS</strong>
        </div>
        <form >
            @foreach($data as $d)
                @csrf
                <div class="w3-center w3-gray w3-border w3-round  w3-padding"><strong>OLD CONTACT DETAILS</strong></div>
                <div class="w3-row w3-row-padding w3-margin w3-border w3-border-blue-grey">
                    <div class="w3-quarter  w3-padding">
                        <div class="w3-row">
                            <div class="w3-center w3-padding-small"> <img src="{{ 'storage/app/public/uploads/'.$d->photo }}" alt="" title="" width="150" height="200"></div>
                        </div>
                    </div>
                    <div class="w3-threequarter ">
                        <div class="w3-row w3-row-padding " >
                            <div class="w3-third w3-padding">
                                <label>Employee Name :</label>
                                {{ $d->fname." ".$d->mname." ".$d->lname }}
                            </div>
                            <div class="w3-third w3-padding">
                                <label>Permanent Address :</label>
                                {{ $d->paddress }}
                            </div>
                            <div class="w3-third w3-padding">
                                <label>Current Address:</label>
                                {{ $d->caddress }}
                            </div>
                        </div>

                        <div class="w3-row w3-row-padding" >
                            <div class="w3-third w3-padding">
                                <label>Phone number:</label>
                                {{ $d->ph }}
                            </div>
                            <div class="w3-third w3-padding">
                                <label>Alternate Phone number :</label>
                                {{ $d->altph }}
                            </div>
                            <div class="w3-third w3-padding">
                                <label>Email :</label>
                                {{ $d->email }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w3-center w3-gray w3-border w3-round  w3-padding"><strong>REQUESTED CONTACT DETAILS TO BE UPDATED</strong></div>
                <div class="w3-row w3-row-padding w3-margin w3-border w3-border-blue-grey">
                    <div class="w3-half" >
                        <label>Phone number : </label>
                        {{ $phone }}
                    </div>
                    <div class="w3-half">
                        <label> Email :</label>
                        {{ $mail }}
                    </div>
                </div>

                <div class="w3-row w3-center">
                    <a id="b1" href="{{ route('ignore') }}?uid={{ $d->id }}" style="text-decoration: none" class="zoom w3-button w3-border w3-round w3-green w3-hover-red">Ignore</a>
                    <a id="b2" href="{{ route('accept') }}?uid={{ $d->id }}&mail={{ $mail }}&phone={{ $phone }}" style="text-decoration: none" class="zoom w3-button w3-border w3-round w3-green w3-hover-red w3-margin-left">Accept</a>
                    <a style="text-decoration: none;" class="w3-button w3-hover w3-hover-red w3-border w3-border-grey w3-round-xlarge zoom  w3-margin-left"  onclick="Exit()" href="{{ url('home') }}">Exit  </a>
                </div>
            @endforeach
        </form>
    </div>
</div>
</body>

<script>
    function Exit() {
        var x = confirm('Do you want to exit ?')
        if(x){
            document.getElementById('action').style.display = "none";
            document.getElementById('dashboard').style.display = "block";
        }
        else{
            return false;
        }
    }
</script>


