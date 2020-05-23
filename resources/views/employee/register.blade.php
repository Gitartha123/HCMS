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
<style>
    @media screen and (min-width: 992px) {
        .topnav {
            right:0;left:15%;position:absolute;
        }
    }
    input {
        text-transform: uppercase;
    }
    ::-webkit-input-placeholder { /* WebKit browsers */
        text-transform: none;
    }
    :-moz-placeholder { /* Mozilla Firefox 4 to 18 */
        text-transform: none;
    }
    ::-moz-placeholder { /* Mozilla Firefox 19+ */
        text-transform: none;
    }
    :-ms-input-placeholder { /* Internet Explorer 10+ */
        text-transform: none;
    }
    ::placeholder { /* Recent browsers */
        text-transform: none;
    }
</style>
<script src="public/js/photovalidation.js"></script>
@include('HR.sidebar');
<div id="register" class="w3-card-4 w3-padding  w3-animate-zoom  item topnav" >
    <div class="w3-card-4  w3-padding w3-border-aqua w3-round-medium w3-light-gray">
        <div class="w3-panel w3-border  w3-padding w3-border-gray w3-round-xlarge w3-center">
            <strong style="color:black;font-size: 20px;">EMPLOYEE REGISTRATION FORM</strong>
        </div>
        <form  method="post" action="{{ route('employeeregistration') }}" id="form1" enctype="multipart/form-data" onsubmit="return Validate(this);">
            @csrf
            <div class="w3-center w3-gray w3-border w3-round  w3-padding"><strong>PERSONAL RECORDS</strong></div>
            <div class="w3-row " >
                <div class="w3-third w3-padding">
                    <input type="text"  name="fname" id="fname" class="w3-input w3-border w3-round-xlarge " placeholder="Firstname*"  >
                </div>
                <div class="w3-third w3-padding" >
                    <input type="text"  name="mname" id="mname" class="w3-input w3-border w3-round-xlarge " placeholder="Middlename">
                </div>
                <div class="w3-third w3-padding" >
                    <input type="text"  name="lname" id="lname" class="w3-input w3-border w3-round-xlarge " placeholder="Lastname*" >
                </div>
            </div>
            <div class="w3-row " >
                <div class="w3-third w3-padding">
                    <select name="gender" id="gender" class="w3-input w3-border w3-round-xlarge" >
                        <option disabled selected id="gender">Select Gender</option>
                        <option >Male</option>
                        <option>Female</option>
                        <option>Transgender</option>
                    </select>
                </div>
                <div class="w3-third w3-padding">
                    <div class='input-group date' id='Date' name="dob">
                        <input type='text'  class="w3-input w3-border " placeholder="Date-of -birth*" id="dob" name="dob">
                        <span class="input-group-addon ">
                  <span class="glyphicon glyphicon-calendar "></span>
              </span>
                    </div>
                </div>
                <div class="w3-third w3-padding">
                    <input type="text"  name="nationality" class="w3-input w3-border w3-round-xlarge " placeholder="Nationality*" id="nationality">
                </div>
            </div>
            <div class="w3-row " >
                <div class="w3-third w3-padding">
                    <input type="text"  name="father" id="father" class="w3-input w3-border w3-round-xlarge " placeholder="Father's name*" >
                </div>
                <div class="w3-third w3-padding">
                    <input type="text"  name="mother" id="mother" class="w3-input w3-border w3-round-xlarge " placeholder="Mother's name*">
                </div>
                <div class="w3-third w3-padding">
                    <select   name="mstatus" id="mstatus" class="w3-input w3-border w3-round-xlarge ">
                        <option value="" disabled selected>Marital Status</option>
                        <option>Single</option>
                        <option>Married</option>
                        <option>Divorced</option>
                    </select>
                </div>
            </div>
            <div class="w3-row " >
                <div class="w3-half w3-padding">
                    <textarea class="w3-input w3-border w3-round-xlarge " name="paddress" placeholder="Permanent Address*" id="paddress" style="height: 200px;"></textarea>
                </div>
                <div class="w3-half w3-padding">
                    <textarea class="w3-input w3-border w3-round-xlarge " placeholder="Present Address*"name="caddress" id="caddress" style="height: 200px;"></textarea>
                    <span> <a class="w3-button  w3-text w3-hover" onclick="copyAddress()" id="do">Same as Permanent address(Do)</a> </span>
                    <span> <a class="w3-button  w3-text w3-hover" onclick="copyAdd()" style="display: none;" id="undo">Same as Permanent address(Undo)</a> </span>
                </div>
            </div>
            <div class="w3-row " >
                <div class="w3-third w3-padding">
                    <input type="text"  name="ph" id="ph" class="w3-input w3-border w3-round-xlarge" placeholder="Phone number*" onkeypress='return restrictAlphabets(event)'  >
                </div>
                <div class="w3-third w3-padding">
                    <input type="text"  name="altph" id="altph" class="w3-input w3-border w3-round-xlarge " placeholder="Alternate Phone number" onkeypress='return restrictAlphabets(event)' >
                </div>
                <div class="w3-third w3-padding">
                    <input type="email" value="{{ old('email') }}" name="email" id="email" class="w3-input w3-border w3-round-xlarge @error('email') is-invalid @enderror" placeholder="Email id" style="text-transform: none;">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>
            <div class="w3-center w3-gray  w3-border w3-round  w3-padding"><strong>OFFICIAL RECORDS</strong></div>
            <div class="w3-row " >
                <div class="w3-third w3-padding">
                    <label class="w3-margin">Department</label>
                    <select   name="department" id="department" class="w3-input w3-border w3-round-xlarge " >
                        <option value="" disabled selected>Select Department</option>
                        @php $dept = DB::table('department')->pluck("name","id");@endphp
                        @foreach ($dept as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="w3-third w3-padding">
                    <label class="w3-margin">Designation</label>
                    <select   name="designation" class="w3-input w3-border w3-round-xlarge "  id="desg" onchange="copyValue()">
                        <option value="" disabled selected>Select Designation</option>
                    </select>

                </div>
                <div class="w3-third w3-padding">
                    <label class="w3-margin">Salary</label>
                    <input type="text"  name="desgid" id="desgid" class="w3-input w3-border w3-round-xlarge " placeholder="Salary*"  readonly>
                </div>
            </div>
            <div class="w3-row" >
                <div class="w3-half w3-padding">
                    <div class='input-group date' id='Joindate'>
                        <input type='text' class="w3-input w3-border" id="joindate" name="joindate" placeholder="Joining Date*">
                        <span class="input-group-addon ">
                  <span class="glyphicon glyphicon-calendar "></span>
              </span>
                    </div>
                </div>
                <div class="w3-half w3-padding" >

                </div>
            </div>
            <div class="w3-row " >
                <div class="w3-half w3-padding">
                    <label class="w3-margin">Upload photo</label>
                    <input type="file" name="photo" class="w3-input w3-border w3-round-xlarge btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Image size should be greater than 150KB and not more than 1MB and choose only JPEG,JPG and PNG image" onchange="validateImage()" id="img">
                </div>
                <div class="w3-half w3-padding">
                    <label class="w3-margin">Upload Signature</label>
                    <input type="file"  name="signature" class="w3-input w3-border w3-round-xlarge btn btn-secondary"  data-toggle="tooltip" data-placement="top" title="Image size should be greater than 150KB and not more than 1MB and choose only JPEG,JPG and PNG image" onchange="validateSignature()" id="signature">
                </div>
            </div>
            <p>&nbsp;</p>
            <div class="w3-center">
                <button  type="submit" class="zoom w3-button  w3-hover-red w3-border w3-border-grey w3-round-xlarge " id="record">Preview <i class="fa fa-arrow-right"></i>  </button>
            </div>
        </form>
    </div>
</div>
</body>

<script>
    function copyAddress(){
        var x = document.getElementById('paddress').value;
        document.getElementById('caddress').value = x;
        document.getElementById('undo').style.display ='block';
        document.getElementById('do').style.display ='none';
    }
    function copyAdd(){
        document.getElementById('caddress').value = " ";
        document.getElementById('do').style.display ='block';
        document.getElementById('undo').style.display ='none';
    }
</script>


<script type="text/javascript">
 $(function(){
     $('[data-toggle = "tooltip"]').tooltip()
 })
</script>







