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
        <form  action="{{ route('action') }}" method="post" onsubmit ="return ConfirmSave()">
            @foreach($data as $d)
            @csrf
                <div class="w3-center w3-gray w3-border w3-round  w3-padding"><strong>PERSONAL RECORDS</strong></div>
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
                            <label>Gender :</label>
                            {{ $d->gender }}
                        </div>
                        <div class="w3-third w3-padding">
                            <label>Date of Birth :</label>
                            {{ $d->dob }}
                        </div>
                    </div>
                    <div class="w3-row w3-row-padding" >
                        <div class="w3-third w3-padding">
                            <label>Nationality:</label>
                            {{ $d->nationality }}
                        </div>
                        <div class="w3-third w3-padding">
                            <label>Father's Name :</label>
                            {{ $d->father }}
                        </div>
                        <div class="w3-third w3-padding">
                            <label>Mother's Name :</label>
                            {{ $d->mother }}
                        </div>
                    </div>
                    <div class="w3-row w3-row-padding" >
                        <div class="w3-third w3-padding">
                            <label>Marital Status:</label>
                            {{ $d->mstatus }}
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
                            <input type="hidden" name="email" value="{{ $d->email }}">
                        </div>
                    </div>
                </div>
            </div>



            <div class="w3-center w3-gray w3-border w3-round  w3-padding"><strong>OFFICIAL RECORDS</strong></div>

            <div class="w3-row w3-row-padding w3-margin w3-border w3-border-blue-grey" >
                <div class="w3-quarter w3-padding">
                    <label>Department :</label>
                    {{ $dept }}
                </div>
                <div class="w3-quarter w3-padding">
                    <label>Designation :</label>
                            {{ $dname  }}
                </div>
                <div class="w3-quarter w3-padding">
                    <label>Salary :</label>
                    {{ $d->salary }}
                </div>
                <div class="w3-quarter w3-padding">
                    <label>Date of Joining :</label>
                    {{ $d->joindate }}
                </div>
            </div>

                <div class="w3-row w3-row-padding w3-margin w3-border w3-border-blue-grey" >
                    <div class="w3-quarter w3-padding">
                        <label>Employee Status :</label>
                        @if($d->status == 1)
                            {{ "Active" }}
                        @endif
                        @if($d->status == 2)
                            {{ "Deactivated" }}
                        @endif
                        @if($d->status == 3)
                            {{ "Resigned" }}
                        @endif
                        @if($d->status == 4)
                            {{ "Suspended" }}
                        @endif
                    </div>
                    <div class="w3-quarter w3-padding" >
                        <label>From:</label>
                        {{ $d->fromdate }}
                    </div>
                    <div class="w3-quarter w3-padding" >
                        <label>To:</label>
                        {{ $d->todate }}
                    </div>
                </div>


                <div class="w3-margin w3-center">
                    @if(Session::has('date'))
                        <strong style="color: red">{{ Session::get('date') }}</strong>
                    @endif
                </div>

                <div class="w3-row w3-row-padding w3-margin w3-border w3-border-blue-grey" >
                    <div class="w3-third w3-padding">
                        <label>Take Action :</label>
                        <select class="w3-input w3-round" name="action">
                            <option  disabled selected>Select option</option>
                            <option value="1">Active</option>
                            <option value="2">Deactive</option>
                            <option value="3">Resign</option>
                            <option value="4">Suspend</option>
                        </select>
                    </div>

                    <div class="w3-third w3-padding" id="fromDate" style="display: none;">
                        <label>From :</label>
                        <div class='input-group date' id='fromdate'>
                            <input type='text' class="w3-input w3-border" id="fromdate" name="fromdate" placeholder="Enter Date*">
                            <span class="input-group-addon ">
                                <span class="glyphicon glyphicon-calendar "></span>
                            </span>
                        </div>
                    </div>
                    <div class="w3-third w3-padding" id="toDate" style="display: none;">
                        <label>To :</label>
                        <div class='input-group date' id='todate'>
                            <input type='text' class="w3-input w3-border" id="todate" name="todate" placeholder="Enter Date*">
                            <span class="input-group-addon ">
                                <span class="glyphicon glyphicon-calendar "></span>
                            </span>
                        </div>
                    </div>
                </div>
            <div class="w3-row w3-center">
                <button type="submit" class="w3-button w3-hover w3-hover-red w3-border w3-border-grey w3-round-xlarge zoom" >Submit</button>
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

jQuery(document).ready(function ()
{
    jQuery('select[name="action"]').on('change',function() {
        var departmentID = jQuery(this).val();
        if (departmentID == 2) {
            document.getElementById('fromDate').style.display = "block";
            document.getElementById('toDate').style.display = "block";

        }
        else if (departmentID == 3) {
            document.getElementById('fromDate').style.display = "block";
            document.getElementById('toDate').style.display = "none";

        }
        else if (departmentID == 4) {
            document.getElementById('fromDate').style.display = "block";
            document.getElementById('toDate').style.display = "block";

        }
        else if (departmentID == 1) {
            document.getElementById('fromDate').style.display = "none";
            document.getElementById('toDate').style.display = "none";

        }
    });
});

$(function(){
    $('#fromdate').datetimepicker({
        format:'D-M-Y'
    });
});
$(function(){
    $('#todate').datetimepicker({
        format:'D-M-Y'
    });
});
</script>


