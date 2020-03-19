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
@if(Session::has('errornetwork'))
    <script>alert('{{ Session::get('errornetwork') }}')</script>
    @endif
<div  class="w3-card-4 w3-padding  w3-animate-zoom topnav" id="preview">
    <div class="w3-card-4  w3-padding w3-border-aqua w3-round-medium w3-light-gray">
        <div class="w3-panel w3-border  w3-padding w3-border-gray w3-round-xlarge w3-center">
            <strong style="color:black;font-size: 20px;">PREVIEW EMPLOYEE DETAILS</strong>
        </div>
        <form  method="post" action="{{ route('submission') }}" onsubmit ="return ConfirmSave()">
            @csrf
            <input type="hidden" name="fname" value="{{ Session::get('fname') }}" id="FNAME">
            <input type="hidden" name="mname" value="{{ Session::get('mname') }}" id="MNAME">
            <input type="hidden" name="lname" value="{{ Session::get('lname') }}" id="LNAME">
            <input type="hidden" name="gender" value=" {{ Session::get('gender') }}" id="GENDER">
            <input type="hidden" name="dob" value=" {{ Session::get('dob') }}" id="DOB">
            <input type="hidden" name="nationality" value=" {{ Session::get('nationality') }}" id="NATIONALITY">
            <input type="hidden" name="father" value=" {{ Session::get('father') }}" id="FATHER">
            <input type="hidden" name="mother" value=" {{ Session::get('mother') }}" id="MOTHER">
            <input type="hidden" name="mstatus" value=" {{ Session::get('mstatus') }}" id="MSTATUS">
            <input type="hidden" name="paddress" value=" {{ Session::get('paddress') }}" id="PADDRESS">
            <input type="hidden" name="caddress" value=" {{ Session::get('caddress') }}" ID="CADDRESS">
            <input type="hidden" name="ph" value="  {{ Session::get('ph') }}" id="PH">
            <input type="hidden" name="altph" value=" {{ Session::get('altph') }}" id="ALTPH">
            <input type="hidden" name="email" value="  {{ Session::get('email') }}" id="EMAIL">
            <input type="hidden" name="salary" value="  {{ Session::get('salary') }}" id="SALARY">
            <input type="hidden" name="joindate" value=" {{ Session::get('joindate') }}" id="JOINDATE">
            <input type="hidden" name="deptid" value=" {{ Session::get('department') }}" >
            <input type="hidden" name="desgid" value=" {{ Session::get('desg') }}">
            <input type="hidden" id="DEPT" value=" {{ Session::get('deptname') }}" >
            <input type="hidden"  id="DESG" value=" {{ Session::get('designationname') }}">
            <input type="hidden"  id="IMG" value="{{ Session::get('myfile') }}" name="IMG">
            <input type="hidden"  id="sign" value=" {{ Session::get('sign') }}" name="sign">
            <input type="hidden" name="id" value="{{ Session::get('id') }}" id="id">
            <div class="w3-center w3-gray w3-border w3-round  w3-padding"><strong>PERSONAL RECORDS</strong></div>
            <div class="w3-row w3-row-padding w3-margin w3-border w3-border-blue-grey">
                <div class="w3-quarter  w3-padding">
                    <div class="w3-row">
                        <div class="w3-center w3-padding-small"> <img src="{{ 'storage/app/public/uploads/'.Session::get('myfile') }}" alt="" title="" width="150" height="200"></div>
                    </div>
                </div>
                <div class="w3-threequarter ">
                    <div class="w3-row w3-row-padding " >
                        <div class="w3-third w3-padding">
                            <label>Employee Name :</label>
                            {{ Session::get('fname').' '.Session::get('mname').' '.Session::get('lname') }}
                        </div>
                        <div class="w3-third w3-padding">
                            <label>Gender :</label>
                            {{ Session::get('gender') }}
                        </div>
                        <div class="w3-third w3-padding">
                            <label>Date of Birth :</label>
                            {{ Session::get('dob') }}
                        </div>
                    </div>
                    <div class="w3-row w3-row-padding" >
                        <div class="w3-third w3-padding">
                            <label>Nationality:</label>
                            {{ Session::get('nationality') }}
                        </div>
                        <div class="w3-third w3-padding">
                            <label>Father's Name :</label>
                            {{ Session::get('father') }}
                        </div>
                        <div class="w3-third w3-padding">
                            <label>Mother's Name :</label>
                            {{ Session::get('mother') }}
                        </div>
                    </div>
                    <div class="w3-row w3-row-padding" >
                        <div class="w3-third w3-padding">
                            <label>Marital Status:</label>
                            {{ Session::get('mstatus') }}
                        </div>
                        <div class="w3-third w3-padding">
                            <label>Permanent Address :</label>
                            {{ Session::get('paddress') }}
                        </div>
                        <div class="w3-third w3-padding">
                            <label>Current Address:</label>
                            {{ Session::get('caddress') }}
                        </div>
                    </div>
                    <div class="w3-row w3-row-padding" >
                        <div class="w3-third w3-padding">
                            <label>Phone number:</label>
                            {{ Session::get('ph') }}
                        </div>
                        <div class="w3-third w3-padding">
                            <label>Alternate Phone number :</label>
                            {{ Session::get('altph') }}
                        </div>
                        <div class="w3-third w3-padding">
                            <label>Email :</label>
                            {{ Session::get('email') }}
                            @if(Session::has('erroruser'))
                                <script>alert('{{ Session::get('erroruser') }}')</script>
                                @endif
                        </div>
                    </div>
                </div>
            </div>



            <div class="w3-center w3-gray w3-border w3-round  w3-padding"><strong>OFFICIAL RECORDS</strong></div>
            <div class="w3-row w3-row-padding w3-margin w3-border w3-border-blue-grey" >
                    <div class="w3-quarter w3-padding">
                        <label>Department :</label>
                        <div >{{ Session::get('deptname') }}</div>
                    </div>
                    <div class="w3-quarter w3-padding">
                        <label>Designation :</label>
                        <div >{{ Session::get('designationname') }}</div>
                    </div>
                    <div class="w3-quarter w3-padding">
                        <label>Salary :</label>
                        {{ Session::get('salary') }}
                    </div>
                    <div class="w3-quarter w3-padding">
                        <label>Date of Joining :</label>
                        {{ Session::get('joindate') }}
                    </div>
                </div>
                <div class="w3-row w3-border w3-border-blue-grey w3-right w3-margin">
                    <div class="w3-right w3-padding-small "> <img src="{{ 'storage/app/public/signature/'.Session::get('sign') }}" alt="" title="" width="300" height="50"></div>
                </div>

            <div class="w3-row w3-center">
                <a  style="text-decoration: none;" class="w3-button w3-hover w3-hover-red w3-border w3-border-grey w3-round-xlarge zoom" onclick="getRegistrationForm()">Edit  </a>
                <button type="submit" class="w3-button w3-hover w3-hover-red w3-border w3-border-grey w3-round-xlarge zoom w3-margin-left" >Submit  </button>
                <a  style="text-decoration: none;" class="w3-button w3-hover w3-hover-red w3-border w3-border-grey w3-round-xlarge zoom w3-margin-left" onclick="Exit()" href="{{ url('home') }}">Exit  </a>
            </div>
        </form>
    </div>
</div>
</body>
@include('employee.register')
<script>
    function getRegistrationForm(){
        document.getElementById('register').style.display = "block";
        document.getElementById('preview').style.display = 'none';
        document.getElementById('fname').value = document.getElementById('FNAME').value
        document.getElementById('mname').value = document.getElementById('MNAME').value
        document.getElementById('lname').value = document.getElementById('LNAME').value
        $('select[name="gender"]').append('<option selected>'+ document.getElementById('GENDER').value +'</option>');
        document.getElementById('dob').value = document.getElementById('DOB').value
        document.getElementById('nationality').value = document.getElementById('NATIONALITY').value
        document.getElementById('paddress').value = document.getElementById('PADDRESS').value
        document.getElementById('caddress').value = document.getElementById('CADDRESS').value
        document.getElementById('father').value = document.getElementById('FATHER').value
        document.getElementById('mother').value = document.getElementById('MOTHER').value
        $('select[name="mstatus"]').append('<option selected>'+ document.getElementById('MSTATUS').value +'</option>')
        document.getElementById('ph').value = document.getElementById('PH').value
        document.getElementById('altph').value = document.getElementById('ALTPH').value
        document.getElementById('desgid').value = document.getElementById('SALARY').value
        document.getElementById('joindate').value = document.getElementById('JOINDATE').value
        document.getElementById('email').value = document.getElementById('EMAIL').value
    }
    function Exit() {
        var x = confirm('Do you want to exit ?')
        if(x){
            document.getElementById('preview').style.display = "none";
            document.getElementById('dashboard').style.display = "block";
        }
        else{
            return false;
        }
    }
</script>




