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

<script>
    function response() {
        document.getElementById('contact').style.display = "none";
        var x = document.getElementById('item').value
        if (x == 1){
            document.getElementById('phonelabel').style.display = "block";
            document.getElementById('phonetext').style.display = "block";
            document.getElementById('emailtext').disabled = true;
        }
        else if(x == 2){
            document.getElementById('emaillabel').style.display = "block";
            document.getElementById('emailtext').style.display = "block";
            document.getElementById('phonetext').disabled = true;
        }
        else if(x == 3){
            document.getElementById('emaillabel').style.display = "block";
            document.getElementById('emailtext').style.display = "block";
            document.getElementById('phonelabel').style.display = "block";
            document.getElementById('phonetext').style.display = "block";
        }
    }
</script>
<div  class="w3-card-4 w3-padding  w3-animate-zoom topnav" id="profile" >
    <div class="w3-card-4  w3-padding w3-border-aqua w3-round-medium w3-light-gray">


            <input type="text" name="item" value="{{ $item }}" id="item">

            <div class="w3-center w3-gray w3-border w3-round  w3-padding"><strong> UPDATE CONTACT DETAILS</strong></div>
            <span id="contact">
                <strong style="color: red" class="w3-margin w3-medium">Your request has been approved . Please click here to edit your contact details.</strong>
            <button style="text-decoration: none;" class="w3-button w3-hover w3-hover-red w3-border w3-border-grey w3-round-xlarge zoom w3-margin" onclick="response()">Click Here  </button>
            </span>

        <form  method="post" action="{{ route('sendcontact') }}">
            @csrf
            <div class="w3-row w3-row-padding w3-margin w3-border w3-border-blue-grey" >
                <div class="w3-quarter">
                    <label class="w3-margin" id="phonelabel" style="display: none"> <strong>Enter your new phone number : </strong></label>
                </div>
                <div class="w3-quarter">
                   <input type="text" name="ph" class="w3-input w3-margin-right w3-margin-top w3-margin-bottom" id="phonetext" style="display: none" required onkeypress='return restrictAlphabets(event)'>
                </div>
                <div class="w3-quarter">
                    <label class="w3-margin" id="emaillabel" style="display: none"> <strong>Enter your new email id : </strong></label>
                </div>
                <div class="w3-quarter">
                    <input type="email" name="email" class="w3-input w3-margin-right w3-margin-top w3-margin-bottom" id="emailtext" style="display: none" required>
                </div>
            </div>

            <div class="w3-row w3-center">
                <button type="submit" class="w3-button w3-hover w3-hover-red w3-border w3-border-grey w3-round-xlarge zoom w3-margin-left" >Submit  </button>
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
</script>




