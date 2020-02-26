<style>
    @media screen and (min-width: 992px) {
        .topnav {
            right:0;left:15%;position:absolute;
        }
    }
</style>

<body  style="background-image: url('{{ asset('resources/views/image/Web 1920 – 1.png') }}'); background-repeat: no-repeat;   background-size: cover;   background-position: center; height:100%;  -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        ">
<div id="register" class="w3-card-4 w3-padding  w3-animate-zoom  item topnav" style="display: none;">
    <div class="w3-card-4  w3-padding w3-border-aqua w3-round-medium w3-light-gray">
        <div class="w3-panel w3-border  w3-padding w3-border-gray w3-round-xlarge w3-center">
            <strong style="color:black;font-size: 20px;">EMPLOYEE REGISTRATION FORM</strong>
        </div>

        <form  id="form1" method="POST" action="{{ route('employeeregistration') }}">
            <div class="w3-center w3-gray w3-border w3-round  w3-padding"><strong>PERSONAL RECORDS</strong></div>
            <div class="w3-row " >
                <div class="w3-third w3-padding">
                    <input type="text"  name="fname" id="fname" class="w3-input w3-border w3-round-xlarge " placeholder="Firstname*" >
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
                    <select   name="gender" class="w3-input w3-border w3-round-xlarge " id="gender">
                        <option value="" disabled selected>Select Gender</option>
                        <option>Male</option>
                        <option>Female</option>
                        <option>Transgender</option>
                    </select>
                </div>
                <div class="w3-third w3-padding">
                    <div class='input-group date' id='dob'>
                        <input type='text' class="w3-input w3-border "placeholder="Date-of -birth*" id="dob" name="dob">
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
                    <input type="text"  name="mother" id="mother " class="w3-input w3-border w3-round-xlarge " placeholder="Mother's name*">
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
                    <input type="text"  name="ph" id="ph" class="w3-input w3-border w3-round-xlarge " placeholder="Phone number*" >
                </div>
                <div class="w3-third w3-padding">
                    <input type="text"  name="altph" id="altph" class="w3-input w3-border w3-round-xlarge " placeholder="Alternate Phone number">
                </div>
                <div class="w3-third w3-padding">
                    <input type="email"  name="email" id="email" class="w3-input w3-border w3-round-xlarge " placeholder="Email id" >
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
                    <div class='input-group date' id='joindate'>
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
                    <input type="file"  name="username" class="w3-input w3-border w3-round-xlarge " placeholder="Father's name*" >
                </div>
                <div class="w3-half w3-padding">
                    <label class="w3-margin">Upload Signature</label>
                    <input type="file"  name="username" class="w3-input w3-border w3-round-xlarge " placeholder="Father's name*" >
                </div>
            </div>
            <p>&nbsp;</p>
            <div class="w3-rest w3-center">
                <button type="submit" class="w3-button  w3-hover w3-hover-red w3-border w3-border-grey w3-round-xlarge">Save Records</button>
            </div>
            {{ csrf_field() }}
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






