<!DOCTYPE html>

<html>

<head>

    <title>Employee salary of {{ $data[0]->year_month }}</title>

</head>

<body>
<div class="w3-row">

    <h1>Employee Salary</h1>

</div>


<p>
    <div class="w3-panel w3-center w3-border"><h3>Employee Details</h3></div>
    <table class="w3-responsive w3-center">
        <tr>
            <td>Employee id :</td>
            <td>{{ $data[0]->empno }}</td>
        </tr>
        <tr>
            <td>Employee name :</td>
            <td>{{ $data[0]->fname.$data[0]->mname.$data[0]->lname }}</td>
        </tr>
        <tr>
            <td>Date of joining :</td>
            <td>{{ $data[0]->joindate }}</td>
        </tr>
        <tr>
            <td>Department :</td>
            <td>{{ $data[0]->department }}</td>
        </tr>
        <tr>
            <td>Designation :</td>
            <td>{{ $data[0]->designation }}</td>
        </tr>
    </table>
</p>

<p>
<div class="w3-panel w3-center w3-border"><h3>Attendance and leave Details</h3></div>
<table class="w3-responsive w3-center">
    <tr>
        <td>Present Days :</td>
        <td>{{ $data[0]->presentdays." " }}Days</td>
    </tr>
    <tr>
        <td>Casual leave :</td>
        <td>{{ $data[0]->clleave." " }}Days</td>
    </tr>
    <tr>
        <td>Paid leave :</td>
        <td>{{ $data[0]->plleave." " }}Days</td>
    </tr>
    <tr>
        <td>Loss of pay leave :</td>
        <td>{{ $data[0]->lopleave." " }}Days</td>
    </tr>
</table>
</p>

<p>
<div class="w3-panel w3-center w3-border"><h3>Salary Details</h3></div>
<table class="w3-responsive w3-center">
    <tr>
        <td>Salary per month:</td>
        <td>{{ $data[0]->salary." " }} Rs.</td>
    </tr>
    <tr>
        <td>Salary by attendance :</td>
        <td>{{ $data[0]->actualsal." " }} Rs.</td>
    </tr>
    <tr>
        <td>Deduction :</td>
        <td>{{ $data[0]->deductedsal." " }} Rs.</td>
    </tr>
    <tr>
        <td>Final amount :</td>
        <td>{{ $data[0]->empsalary." " }} Rs.</td>
    </tr>
</table>
</p>
</body>

</html>