<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="public/css/style.css" rel="stylesheet" type="text/css">
@include('header')
@include('footer')
<body  style="background-image: url('{{ asset('resources/views/image/Web 1920 – 1.png') }}'); background-repeat: no-repeat;   background-size: auto;   background-position: center; height:100%;-webkit-background-size:cover;
        -o-background-size:cover;">


<!-- DESIGN FOR SIDEBAR-->

<div class="w3-sidebar w3-bar-block  w3-animate-left w3-border w3-light-gray" style="display: none;" id="mySidebar">
    <button class="w3-bar-item w3-xlarge w3-button w3-right w3-hover-red"  onclick="w3close()">&times;</button>
    <a href="#" class="w3-button w3-bar-item " onclick="EmployeeRegister('dashboard')">Dashboard</a>
    <div class="w3-dropdown-hover">
        <button class="w3-button">Employee</button>
        <div class="w3-dropdown-content w3-card-4 w3-bar-block">
            <button class="w3-button w3-bar-item " onclick="EmployeeRegister('register')">Employee Registration</button>
            <a href="#" class="w3-button w3-bar-item " onclick="EmployeeRegister('viewemployee')">View Employee</a>
        </div>
    </div>
</div>



<!-- DESIGN FOR BODY -->

<div id="main">
    <button id="openNav" class="w3-button w3-xlarge w3-hover-red w3-margin w3-border w3-round-xlarge w3-card" onclick="w3open()">&#9776;</button>
</div>

<!-- INCLUDE EMPLOYEE REGISTRATION FORM -->

@include('employee.registration')
</body>


<script>
    function w3open(){
        document.getElementById('main').style.marginLeft = "25%";
        document.getElementById('mySidebar').style.width = "25%";
        document.getElementById('mySidebar').style.display = "block";
        document.getElementById('openNav').style.display ="none";
    }
    function w3close() {
        document.getElementById('mySidebar').style.display = "none";
        document.getElementById('main').style.marginLeft = "0%";
        document.getElementById('openNav').style.display ="inline-block";
    }
    function EmployeeRegister(item){
        var i;
        var x = document.getElementsByClassName("item");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        document.getElementById(item).style.display = "block";
        w3close();
    }
</script>
