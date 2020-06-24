<!-- DESIGN FOR HR SIDEBAR-->
<style>
    .fa-home{
        color: white;
    }
    .fa-user-o{
        color: white;
    }
    .fa-caret-down{
        color: white;
    }
    .fa-money{
        color: white;
    }
    .fa-power-off{
        color: white;
    }
    @media screen and (min-width: 992px) {
        .topnav {
            right:0;left:15%;position:absolute;
        }
    }
    .dataTables_filter{
        margin-right:2%;
    }
    table{
        font-size: small;
    }
    #salary_length label{
        color: white;
    }
    select{
        color: black;
    }
    #salary_filter{
        color: white;
    }
    #salary_info{
        color: white;
    }
    input{
        color: black;
    }
    .paginate{
        color: white;
    }
    .dataTables_filter{
        margin-right:2%;
    }
    table{
        font-size: small;
    }
    #DataTables_Table_0_length{
        color: white;
    }
    #DataTables_Table_0_filter{
        color: white;
    }
</style>
<!DOCTYPE html>
<html>
<title>W3.CSS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<body style="background-image: url('{{ asset('resources/views/image/effective-employee-management.jpg') }}');  background-size: cover;   background-position: center;height: 100%;-webkit-background-size:cover;">

<div class="w3-sidebar w3-bar-block w3-collapse w3-card w3-animate-left" style="width:200px; position: fixed;left: 0;top: 0;background-color: rgba(0,0,0,.2);background-image: linear-gradient(to right,darkslategray,darkslategray)" id="mySidebar" >
    <a  href="{{ route('logout') }}" class="w3-row w3-bar-item " onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-power-off w3-right w3-margin w3-xlarge "></i> </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <a href="{{ url('/home') }}" class="w3-bar-item" style="text-decoration: none;" onclick="EmployeeRegister('dashboard')"><b style="color: white"><i class="w3-left fa fa-home w3-xlarge w3-margin-right"></i> Home</b></a>
    <p></p>
    <div class="w3-bar-item w3-hover-red w3-button w3-border-top w3-border-white" onclick="myAccFunc()"><i class="w3-left fa fa-user-o  w3-xlarge w3-margin-right"></i><b style="color: white">Employee</b><i class="w3-right fa fa-caret-down"></i></div>
    <div id="demoAcc" class="w3-hide w3-white w3-card-4">
        <a class="w3-button w3-bar-item" href="{{ route('register') }}" style="text-decoration: none">Employee Registration</a>
        <a class="w3-button w3-bar-item" href="{{ route('viewemployee') }}" style="text-decoration: none">View Employee</a>
    </div>
    <div class="w3-bar-item w3-hover-red w3-button w3-border-top w3-border-bottom w3-border-white" onclick="myAccFunc1()"><i class="w3-left fa fa-money  w3-xlarge w3-margin-right"></i><b style="color: white">Payroll</b><i class="w3-right fa fa-caret-down"></i></div>
    <div id="demoAcc1" class="w3-hide w3-white w3-card-4">
        <a style="text-decoration: none;" onclick="document.getElementById('id02').style.display ='block'" class="w3-button w3-bar-item" ><b><i class="fa fa-pencil w3-xlarge w3-right" ></i>Salary generate</b></a>
        <a style="text-decoration: none;" onclick="document.getElementById('id03').style.display ='block'"class="w3-button w3-bar-item" ><b><i class="fa fa-list w3-xlarge w3-right" ></i>View Salary</b></a>
    </div>
    <button class="w3-bar-item w3-button w3-hide-large w3-border-bottom w3-border-white" onclick="w3_close()"><b style="color: white">Close &times;</b> </button>
</div>

<div class="w3-main" style="margin-left:200px">
    <div class="w3-teal">
        <button class="w3-button w3-teal w3-xlarge w3-hide-large" onclick="w3_open()">&#9776;</button>
    </div>
</div>

<script>
    function w3_open() {
        document.getElementById("mySidebar").style.display = "block";
    }

    function w3_close() {
        document.getElementById("mySidebar").style.display = "none";
    }
    function myAccFunc() {
        var x = document.getElementById("demoAcc");
        if (x.className.indexOf("w3-show") == -1) {
            x.className += " w3-show";
            x.previousElementSibling.className += " w3-green";
        } else {
            x.className = x.className.replace(" w3-show", "");
            x.previousElementSibling.className =
                x.previousElementSibling.className.replace(" w3-green", "");
        }
    }
    function myAccFunc1() {
        var x = document.getElementById("demoAcc1");
        if (x.className.indexOf("w3-show") == -1) {
            x.className += " w3-show";
            x.previousElementSibling.className += " w3-green";
        } else {
            x.className = x.className.replace(" w3-show", "");
            x.previousElementSibling.className =
                x.previousElementSibling.className.replace(" w3-green", "");
        }
    }
</script>


<div id="id02" class="w3-modal">
    <div class="w3-modal-content">
        <div class="w3-container" >
            <div class="w3-card-4 w3-padding  w3-animate-zoom  item topnav w3-center w3-light-blue" id="body" style="max-width: 500px;">
                <div class="w3-card-4  w3-padding w3-border-aqua w3-round-medium ">
                      <span onclick="document.getElementById('id02').style.display='none'"
                            class="w3-button w3-display-topright w3-red"><i class="fa fa-close"></i> </span>
                    <div class="w3-row w3-row-padding w3-margin">
                            <div class="w3-card-4 w3-round w3-padding"; style="background-color: #00CC66;height: 100px;">
                               <form action="{{ route('salary') }}" method="post">
                                   @csrf
                                   <?php $month_array = range(1,date('m')) ?>
                                   <select class="w3-input" name="month">
                                       <option disabled>Select month</option>
                                       <?php
                                          foreach($month_array as $month){
                                              $year = date('Y');
                                              $monthPadding = str_pad($month,2,"0",STR_PAD_LEFT);
                                              $fdate = date('F',strtotime("$year-$monthPadding-01"));
                                              echo '<option value="'.$monthPadding.'">'.$fdate.'</option>';
                                          }
                                       ?>
                                   </select>
                                       <p></p>
                                   <button type="submit" class="w3-btn w3-hover-red w3-round w3-light-blue">Submit</button>
                               </form>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="id03" class="w3-modal">
    <div class="w3-modal-content">
        <div class="w3-container" >
            <div class="w3-card-4 w3-padding  w3-animate-zoom  item topnav w3-center w3-light-blue" id="body" style="max-width: 500px;">
                <div class="w3-card-4  w3-padding w3-border-aqua w3-round-medium ">
                      <span onclick="document.getElementById('id03').style.display='none'"
                            class="w3-button w3-display-topright w3-red"><i class="fa fa-close"></i> </span>
                    <div class="w3-row w3-row-padding w3-margin">
                        <div class="w3-card-4 w3-round w3-padding"; style="background-color: #00CC66;height: 100px;">
                            <form action="{{ route('empsalaryview') }}" method="post">
                                @csrf
                                <?php $month_array = range(1,date('m')) ?>
                                <select class="w3-input" name="month">
                                    <option disabled>Select month</option>
                                    <?php
                                    foreach($month_array as $month){
                                        $year = date('Y');
                                        $monthPadding = str_pad($month,2,"0",STR_PAD_LEFT);
                                        $fdate = date('F',strtotime("$year-$monthPadding-01"));
                                        echo '<option value="'.$monthPadding.'">'.$fdate.'</option>';
                                    }
                                    ?>
                                </select>
                                <p></p>
                                <button type="submit" class="w3-btn w3-hover-red w3-round w3-light-blue">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>


