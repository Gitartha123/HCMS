<style>
    a{
        text-decoration: none;
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<script src="https://cdn.jsdelivr.net/momentjs/2.14.1/moment.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<body  style="background-image: url('{{ asset('resources/views/image/Web 1920 – 1.png') }}'); background-repeat: no-repeat;   background-size: cover;   background-position: center; height:100%;-webkit-background-size:cover;
        -o-background-size:cover;">
<div id="register" class="w3-card-4 w3-padding w3-center w3-animate-zoom item w3-margin item" style="max-width: 100%;margin:auto auto; display: none;" align="center">
    <div class="w3-card-4 w3-margin w3-padding w3-border-aqua w3-round-medium w3-light-gray">
        <div class="w3-panel w3-border w3-margin w3-padding w3-border-gray w3-round-xlarge ">
            <strong style="color:black;font-size: 20px;" >EMPLOYEE REGISTRATION FORM</strong>
        </div>
        <div class="w3-center w3-gray w3-red w3-border w3-round w3-margin w3-padding"><strong>PERSONAL RECORDS</strong></div>
        <form class="w3-container">
            <div class="w3-row w3-bar" style="width: 100%">
                    <div class="w3-third">
                        <input type="text"  name="username" class="w3-input w3-border w3-round-xlarge w3-margin" placeholder="Firstname*" style="width: 95%">
                    </div>
                    <div class="w3-third" >
                        <input type="text"  name="username" class="w3-input w3-border w3-round-xlarge w3-margin" placeholder="Middlename"style="width: 95%">
                    </div>
                    <div class="w3-third" >
                        <input type="text"  name="username" class="w3-input w3-border w3-round-xlarge w3-margin" placeholder="Lastname*" style="width: 95%">
                    </div>
            </div>
            <div class="w3-row " style="width: 100%">
                <div class="w3-third">
                    <select   name="username" class="w3-input w3-border w3-round-xlarge w3-margin" style="width: 95%">
                        <option value="" disabled selected>Select Gender</option>
                        <option>Male</option>
                        <option>Female</option>
                        <option>Transgender</option>
                    </select>
                </div>
                <div class="w3-third" >
                    <div class='input-group date w3-margin' id='format'>
                        <input type='text' class="w3-input " placeholder="Date-of -birth*">
                        <span class="input-group-addon ">
                  <span class="glyphicon glyphicon-calendar "></span>
              </span>
                    </div>
                </div>
                <div class="w3-third" >
                    <input type="text"  name="username" class="w3-input w3-border w3-round-xlarge w3-margin" placeholder="Nationality*" style="width: 95%">
                </div>
            </div>
            <div class="w3-row w3-margin">
                <div class="w3-half">
                    <textarea class="w3-input w3-border w3-round-xlarge w3-margin-right" placeholder="Permanent Address*" id="paddress" style="height: 25%;"></textarea>
                </div>
                <div class="w3-half">
                    <textarea class="w3-input w3-border w3-round-xlarge w3-margin-left" placeholder="Present Address*" id="caddress" style="height: 25%;"></textarea>
                    <span> <a class="w3-button  w3-text w3-hover" onclick="copyAddress()" id="do">Same as Permanent address(Do)</a> </span>
                    <span> <a class="w3-button  w3-text w3-hover" onclick="copyAdd()" style="display: none;" id="undo">Same as Permanent address(Undo)</a> </span>
                </div>
            </div>
            <div class="w3-row w3-bar" style="width: 100%">
                <div class="w3-third">
                    <input type="text"  name="username" class="w3-input w3-border w3-round-xlarge w3-margin" placeholder="Father's name*" style="width: 95%">
                </div>
                <div class="w3-third" >
                    <input type="text"  name="username" class="w3-input w3-border w3-round-xlarge w3-margin" placeholder="Mother's name*"style="width: 95%">
                </div>
                <div class="w3-third" >
                    <input type="text"  name="username" class="w3-input w3-border w3-round-xlarge w3-margin" placeholder="Marital Status*" style="width: 95%">
                </div>
            </div>
            <div class="w3-row w3-bar" style="width: 100%">
                <div class="w3-third">
                    <input type="text"  name="username" class="w3-input w3-border w3-round-xlarge w3-margin" placeholder="Phone number*" style="width: 95%">
                </div>
                <div class="w3-third" >
                    <input type="text"  name="username" class="w3-input w3-border w3-round-xlarge w3-margin" placeholder="Alternate Phone number"style="width: 95%">
                </div>
                <div class="w3-third" >
                    <input type="text"  name="username" class="w3-input w3-border w3-round-xlarge w3-margin" placeholder="Email id" style="width: 95%">
                </div>
            </div>
            <div class="w3-center w3-gray w3-red w3-border w3-round w3-margin w3-padding"><strong>OFFICIAL RECORDS</strong></div>
            <div class="w3-row w3-bar" style="width: 100%">
                <div class="w3-third">
                    <select   name="username" class="w3-input w3-border w3-round-xlarge w3-margin" style="width: 95%">
                        <option value="" disabled selected>Select Department</option>
                        <option>Technical</option>
                        <option>Non Technical</option>
                        <option>HR</option>
                    </select>
                </div>
                <div class="w3-third" >
                    <input type="text"  name="username" class="w3-input w3-border w3-round-xlarge w3-margin" placeholder="Designation*"style="width: 95%">
                </div>
                <div class="w3-third" >
                    <input type="text"  name="username" class="w3-input w3-border w3-round-xlarge w3-margin" placeholder="Salary*" style="width: 95%">
                </div>
            </div>
            <div class="w3-row " style="width: 100%">
                <div class="w3-half">
                    <select   name="username" class="w3-input w3-border w3-round-xlarge w3-margin" style="width: 95%">
                        <option value="" disabled selected>Employee Status</option>
                        <option>Working</option>
                        <option>Left</option>
                        <option>On Leave</option>
                    </select>
                </div>
                <div class="w3-half" >
                    <div class='input-group date w3-margin' id='format'>
                        <input type='text' class="w3-input " placeholder="Joining Date*">
                        <span class="input-group-addon ">
                  <span class="glyphicon glyphicon-calendar "></span>
              </span>
                    </div>
                </div>
            </div>
            <div class="w3-row w3-bar" style="width: 100%">
                <div class="w3-half">
                    <span class="w3-margin">Upload photo</span>
                    <input type="file"  name="username" class="w3-input w3-border w3-round-xlarge w3-margin" placeholder="Father's name*" style="width: 95%">
                </div>
                <div class="w3-half">
                    <span class="w3-margin">Upload Signature</span>
                    <input type="file"  name="username" class="w3-input w3-border w3-round-xlarge w3-margin" placeholder="Father's name*" style="width: 95%">
                </div>
            </div>
            <p>&nbsp;</p>
            <div class="w3-rest">
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
<script type="text/javascript">
    $(function () {
        $('#format').datetimepicker({
            format:'D-M-Y'
        });
    });
</script>
