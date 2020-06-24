<!DOCTYPE html>
<html>

<head>

    <title>Employee salary </title>

</head>

<body>
<div class="w3-row w3-center">

    <h1 >Employee Salary of {{ $data['year_month'] }}</h1>

</div>


<p>
<div class="w3-panel w3-center w3-border w3-margin"><h3>Employee Details</h3></div>
<table class="w3-responsive w3-center">
    <tr>
        <td>Employee id :</td>
        <td>{{ $data['empno'] }}</td>
    </tr>
    <tr>
        <td>Employee name :</td>
        <td>{{ $data['name']}}</td>
    </tr>
    <tr>
        <td>Date of joining :</td>
        <td>{{ $data['joindate'] }}</td>
    </tr>
    <tr>
        <td>Department :</td>
        <td>{{ $data['department'] }}</td>
    </tr>
    <tr>
        <td>Designation :</td>
        <td>{{ $data['designation'] }}</td>
    </tr>
</table>
</p>

<p>
<div class="w3-panel w3-center w3-border"><h3>Attendance and leave Details</h3></div>
<table class="w3-responsive w3-center">
    <tr>
        <td>Present Days :</td>
        <td>{{ $data['presentdays']." " }}Days</td>
    </tr>
    <tr>
        <td>Casual leave :</td>
        <td>{{ $data['clleave']." " }}Days</td>
    </tr>
    <tr>
        <td>Paid leave :</td>
        <td>{{ $data['plleave']." " }}Days</td>
    </tr>
    <tr>
        <td>Loss of pay leave :</td>
        <td>{{ $data['lopleave']." " }}Days</td>
    </tr>
</table>
</p>

<p>
<div class="w3-panel w3-center w3-border"><h3>Salary Details</h3></div>
<table class="w3-responsive w3-center">
    <tr>
        <td>Salary per month:</td>
        <td>{{ $data['salary']." " }} Rs.</td>
    </tr>
    <tr>
        <td>Salary by attendance :</td>
        <td>{{ $data['actualsal']." " }} Rs.</td>
    </tr>
    <tr>
        <td>Deduction :</td>
        <td>{{ $data['deductedsal']." " }} Rs.</td>
    </tr>
    <tr>
        <td>Final amount :</td>
        <td>{{ $data['empsalary']." " }} Rs.</td>
    </tr>
</table>
</p>
</body>

</html>