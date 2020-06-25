<!DOCTYPE html>
<html>
<head>
    <title>Employee salary </title>
</head>
<style>

</style>
<body style="max-height: 30%">
@include('style')
<div class="w3-row w3-center">
    <h4 >Employee Salary of {{ date('F-Y',strtotime($data["year_month"])) }}</h4>
</div>


<p>

<div class="w3-panel w3-center w3-border "><h5>Employee Details</h5></div>
<div class="w3-center w3-border w3-padding">
    <div class="w3-row">
        <div class="w3-quarter">&nbsp;</div>
        <div class="w3-quarter w3-left-align">Employee id :</div>
        <div class="w3-quarter w3-left-align">{{ $data['empno'] }}</div>
        <div class="w3-quarter">&nbsp;</div>
    </div>
    <div class="w3-row">
        <div class="w3-quarter">&nbsp;</div>
        <div class="w3-quarter w3-left-align">Employee name :</div>
        <div class="w3-quarter w3-left-align">{{ $data['name']}}</div>
        <div class="w3-quarter">&nbsp;</div>
    </div>
    <div class="w3-row">
        <div class="w3-quarter">&nbsp;</div>
        <div class="w3-quarter w3-left-align">Date of joining :</div>
        <div class="w3-quarter w3-left-align">{{ $data['joindate'] }}</div>
        <div class="w3-quarter">&nbsp;</div>
    </div>
    <div class="w3-row">
        <div class="w3-quarter">&nbsp;</div>
        <div class="w3-quarter w3-left-align">Department :</div>
        <div class="w3-quarter w3-left-align">{{ $data['department'] }}</div>
        <div class="w3-quarter">&nbsp;</div>
    </div>
    <div class="w3-row">
        <div class="w3-quarter">&nbsp;</div>
        <div class="w3-quarter w3-left-align">Designation :</div>
        <div class="w3-quarter w3-left-align">{{ $data['designation'] }}</div>
        <div class="w3-quarter">&nbsp;</div>
    </div>
</div>
</p>

<p>
<div class="w3-panel w3-center w3-border"><h5>Attendance and leave Details</h5></div>
<div class="w3-padding w3-center w3-border">
    <div class="w3-row">
        <div class="w3-quarter">&nbsp;</div>
        <div class="w3-quarter w3-left-align">Present Days :</div>
        <div class="w3-quarter w3-left-align">{{ $data['presentdays']." " }}Days</div>
        <div class="w3-quarter">&nbsp;</div>
    </div>
    <div class="w3-row">
        <div class="w3-quarter">&nbsp;</div>
        <div class="w3-quarter w3-left-align">Casual leave :</div>
        <div class="w3-quarter w3-left-align">{{ $data['clleave']." " }}Days</div>
        <div class="w3-quarter">&nbsp;</div>
    </div>
    <div class="w3-row">
        <div class="w3-quarter">&nbsp;</div>
        <div class="w3-quarter w3-left-align">Paid leave :</div>
        <div class="w3-quarter w3-left-align">{{ $data['plleave']." " }}Days</div>
        <div class="w3-quarter">&nbsp;</div>
    </div>
    <div class="w3-row">
        <div class="w3-quarter">&nbsp;</div>
        <div class="w3-quarter w3-left-align">Loss of pay leave :</div>
        <div class="w3-quarter w3-left-align">{{ $data['lopleave']." " }}Days</div>
        <div class="w3-quarter">&nbsp;</div>
    </div>
</div>
</p>

<p>
<div class="w3-panel w3-center w3-border"><h5>Salary Details</h5></div>
<div class="w3-center w3-border w3-padding">
    <div class="w3-row">
        <div class="w3-quarter">&nbsp;</div>
        <div class="w3-quarter w3-left-align">Salary per month:</div>
        <div class="w3-quarter w3-left-align">{{ $data['salary']." " }} Rs.</div>
        <div class="w3-quarter">&nbsp;</div>
    </div>
    <div class="w3-row">
        <div class="w3-quarter">&nbsp;</div>
        <div class="w3-quarter w3-left-align">Salary by attendance :</div>
        <div class="w3-quarter w3-left-align">{{ $data['actualsal']." " }} Rs.</div>
        <div class="w3-quarter">&nbsp;</div>
    </div>
    <div class="w3-row">
        <div class="w3-quarter">&nbsp;</div>
        <div class="w3-quarter w3-left-align">Deduction :</div>
        <div class="w3-quarter w3-left-align">{{ $data['deductedsal']." " }} Rs.</div>
        <div class="w3-quarter">&nbsp;</div>
    </div>
    <div class="w3-row">
        <div class="w3-quarter">&nbsp;</div>
        <div class="w3-quarter w3-left-align">Final amount :</div>
        <div class="w3-quarter w3-left-align">{{ $data['empsalary']." " }} Rs.</div>
        <div class="w3-quarter">&nbsp;</div>
    </div>
</div>
</p>
</body>

</html>