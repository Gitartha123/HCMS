
function EmployeeRegister(item){
    var i;
    var x = document.getElementsByClassName("item");
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
    }
    document.getElementById(item).style.display = "block";
    document.getElementById('mySidebar').style.display = "none";
}

