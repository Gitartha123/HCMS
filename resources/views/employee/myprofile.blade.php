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
@include('employee.employeeSidebar')
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
<div  class="w3-card-4 w3-padding  w3-animate-zoom topnav" id="profile" >
    <div class="w3-card-4  w3-padding w3-border-aqua w3-round-medium w3-light-gray">
        <div class="w3-panel w3-border  w3-padding w3-border-gray w3-round-xlarge w3-center">
            <strong style="color:black;font-size: 20px;">  MY PROFILE </strong>
        </div>
        <form  onsubmit ="return ConfirmSave()" method="post" action="{{ route('request') }}">
            @csrf
            <input type="hidden" name="uid" value="{{ Auth::user()->id }}">
            <div class="w3-center w3-gray w3-border w3-round  w3-padding"><strong>PERSONAL RECORDS</strong></div>
            <div class="w3-row w3-row-padding w3-margin w3-border w3-border-blue-grey">
                <div class="w3-quarter  w3-padding">
                    <div class="w3-row">
                        <div class="w3-center w3-padding-small"> <img src="{{ 'storage/app/public/uploads/'.Auth::user()->photo }}" alt="" title="" width="150" height="200"></div>
                    </div>
                </div>
                <div class="w3-threequarter ">
                    <div class="w3-row w3-row-padding " >
                        <div class="w3-third w3-padding">
                            <label>Employee Name :</label>
                            {{ Auth::user()->fname.' '.Auth::user()->mname.' '.Auth::user()->lname }}
                        </div>
                        <div class="w3-third w3-padding">
                            <label>Gender :</label>
                            {{ Auth::user()->gender }}
                        </div>
                        <div class="w3-third w3-padding">
                            <label>Date of Birth :</label>
                            {{ Auth::user()->dob }}
                        </div>
                    </div>
                    <div class="w3-row w3-row-padding" >
                        <div class="w3-third w3-padding">
                            <label>Nationality:</label>
                            {{ Auth::user()->nationality }}
                        </div>
                        <div class="w3-third w3-padding">
                            <label>Father's Name :</label>
                            {{ Auth::user()->father }}
                        </div>
                        <div class="w3-third w3-padding">
                            <label>Mother's Name :</label>
                            {{ Auth::user()->mother }}
                        </div>
                    </div>
                    <div class="w3-row w3-row-padding" >
                        <div class="w3-third w3-padding">
                            <label>Marital Status:</label>
                            {{ Auth::user()->mstatus }}
                        </div>
                        <div class="w3-third w3-padding">
                            <label>Permanent Address :</label>
                            {{ Auth::user()->paddress }}
                        </div>
                        <div class="w3-third w3-padding">
                            <label>Current Address:</label>
                            {{ Auth::user()->caddress }}
                        </div>
                    </div>
                    <div class="w3-row w3-row-padding" >
                        <div class="w3-third w3-padding">
                            <label>Phone number:</label>
                            {{ Auth::user()->ph }}
                        </div>
                        <div class="w3-third w3-padding">
                            <label>Alternate Phone number :</label>
                            {{ Auth::user()->altph }}
                        </div>
                        <div class="w3-third w3-padding">
                            <label>Email :</label>
                            {{ Auth::user()->email }}
                        </div>
                    </div>
                </div>
            </div>



            <div class="w3-center w3-gray w3-border w3-round  w3-padding"><strong>OFFICIAL RECORDS</strong></div>
            <div class="w3-row w3-row-padding w3-margin w3-border w3-border-blue-grey" >
                <div class="w3-quarter w3-padding">
                    <label>Department :</label>
                    @php
                        $deptname = DB::table('department')->where('id','=',Auth::user()->dept)->pluck('name');
                    @endphp
                    @foreach($deptname as $dept)
                    <div >{{ $dept }}</div>
                        @endforeach
                </div>
                <div class="w3-quarter w3-padding">
                    @php
                        $desgname = DB::table('designation')->where('id','=',Auth::user()->desg)->pluck('dname');
                    @endphp
                    @foreach($desgname as $desg)
                    <label>Designation :</label>
                    <div >{{ $desg }}</div>
                        @endforeach
                </div>
                <div class="w3-quarter w3-padding">
                    <label>Salary :</label>
                    {{ Auth::user()->salary }}
                </div>
                <div class="w3-quarter w3-padding">
                    <label>Date of Joining :</label>
                    {{ Auth::user()->joindate }}
                </div>
            </div>


            <div class="w3-center w3-gray w3-border w3-round  w3-padding"><strong>REQUEST FOR UPDATING CONTACT DETAILS</strong></div>
            <div class="w3-row w3-row-padding w3-margin w3-border w3-border-blue-grey" >
                    <div class="w3-quarter">
                        <label class="w3-margin"> <strong>Choose option : </strong></label>
                    </div>
                    <div class="w3-quarter">
                        <input type="radio" name="phone" value="1" class="w3-margin"  id="ph" onclick="getcontact()">Phone number
                    </div>
                    <div class="w3-quarter">
                        <input type="radio" name="email" value="2" class="w3-margin"  id="e" onclick="getcontact()">Email
                    </div>
                @if(Session::has('radio'))
                     <span class="w3-center"><strong style="color: red">{{ Session::get('radio') }}</strong></span>
                    @endif
            </div>

            <div class="w3-row w3-row-padding w3-margin w3-border w3-border-blue-grey">
                <div class="w3-half" >
                   <input type="text" name="phone" class="w3-input w3-margin w3-margin-right" id="phone" style="display: none;" placeholder="Enter Phone number" required disabled>
                </div>
                <div class="w3-half">
                    <input type="email"  name="email" class="w3-input w3-margin w3-margin-right" placeholder="Enter email" id="email" style="display: none" required disabled>
                </div>
            </div>

            <div class="w3-row w3-center">
                <button type="submit" class="w3-button w3-hover w3-hover-red w3-border w3-border-grey w3-round-xlarge zoom w3-margin-left" >Send Request  </button>
                <a  style="text-decoration: none;" class="w3-button w3-hover w3-hover-red w3-border w3-border-grey w3-round-xlarge zoom w3-margin-left" onclick="Exit()">Exit  </a>
            </div>
        </form>
    </div>
</div>
</body>
<script>
    function Exit() {
        var x = confirm('Do you want to exit ?')
        if(x){
            document.getElementById('profile').style.display = "none";
            document.getElementById('dashboard').style.display = "block";
        }
        else{
            return false;
        }
    }


    $('#ph').click(function() {
        var checked = $(this).attr('checked');
        if(checked){
            $(this).attr('checked', false);
            document.getElementById('phone').style.display = "none";
            document.getElementById('phone').disabled = true;
        }
        else{
            $(this).attr('checked', true);
            document.getElementById('phone').style.display ="block";
            document.getElementById('phone').disabled = false;
        }
    });

    $('#e').click(function() {
        var checked = $(this).attr('checked');
        if(checked){
            $(this).attr('checked', false);
            document.getElementById('email').style.display = "none";
            document.getElementById('email').disabled = true;
        }
        else{
            $(this).attr('checked', true);
            document.getElementById('email').style.display ="block";
            document.getElementById('email').disabled = false;

        }
    });

</script>




