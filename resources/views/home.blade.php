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


<style>
    .mySlides {display:none;}
    label.error
    {
        color: red;
    }
    </style>
    <style>
     .nounder
     {
         text-decoration:none;
     }
    .nounder:hover
    {
        color:#0C6;
    }
</style>
<body  style="background-image: linear-gradient(to right,black,black)">
<div id="dashboard">
@if(Session::has('message'))
    <script>alert('{{ Session::get('message') }}')</script>
    @endif
@if(Session::has('salmessage'))
    <script>alert('{{ Session::get('salmessage') }}')</script>
    @endif
    @if(Session::has('msg'))
        <script>alert('{{ Session::get('msg') }}')</script>
    @endif
@include('HR.sidebar')
@include('HR.body')

</div>

</body>


<script src="public/js/sidebar.js"></script>