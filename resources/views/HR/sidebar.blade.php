<!-- DESIGN FOR HR SIDEBAR-->

<!DOCTYPE html>
<html>
<title>W3.CSS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<body>

<div class="w3-sidebar w3-bar-block w3-collapse w3-card w3-animate-left" style="width:200px; position: fixed;left: 0;top: 0;background-color: rgba(0,0,0,.2)" id="mySidebar">
    <a  href="{{ route('logout') }}" class="w3-button w3-bar-item " onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-power-off w3-right w3-margin w3-xlarge "></i> </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <a href="#" class=" w3-bar-item " style="text-decoration: none;" onclick="EmployeeRegister('dashboard')"><b>Dashboard</b></a>

    <div class="w3-bar-item w3-button" onclick="myAccFunc()"><b>Employee</b><i class="w3-right fa fa-caret-down"></i></div>
    <div id="demoAcc" class="w3-hide w3-white w3-card-4">
        <button class="w3-button w3-bar-item" onclick="EmployeeRegister('register')">Employee Registration</button>
        <a href="#" class="w3-button w3-bar-item" onclick="EmployeeRegister('viewemployee')">View Employee</a>
    </div>

    <button class="w3-bar-item w3-button w3-hide-large" onclick="w3_close()">Close &times;</button>
</div>

<div class="w3-main" style="margin-left:200px">
    <div class="w3-teal">
        <button class="w3-button w3-teal w3-xlarge w3-hide-large" onclick="w3_open()">&#9776;</button>
    </div>
</div>

<script>
    function w3_open() {
        document.getElementById("mySidebar").style.display = "block";
        document.getElementById('mySidebar').style.backgroundColor = "white";
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
</script>

</body>
</html>


