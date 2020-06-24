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
<link href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('HR.sidebar');
<div  class=" w3-padding w3-animate-zoom item topnav" id="viewemployee" >
    <div class="w3-card-4  w3-padding w3-border-aqua w3-round-medium w3-margin" style="background-color: rgba(0,0,0,0.5);">
        <div class="table-responsive">
            <div class="w3-panel w3-border  w3-padding w3-border-white w3-round-xlarge w3-center">
                <strong style="color:white;font-size: 20px;">SALARIES OF ALL EMPLOYEES</strong>
            </div>
            <div id="add">
                <form >
                    @csrf
                    <table id="salary" class="display" cellspacing="0" width="100%">
                        <thead>
                        <tr class="w3-green trow">
                            <th width="300px">Name</th>
                            <th>Department</th>
                            <th>Designation</th>
                            <th width="100px"></th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($data as $value)
                            <tr class="trow">
                                <td>{{ $value->fname.' '.$value->mname.' '.$value->lname }}</td>
                                <td>{{ $value->department }}</td>
                                <td>{{ $value->designation }}</td>
                                <td>
                                   <a class="w3-green w3-hover w3-hover-red w3-button" href="viewempsalary?empno={{ $value->empno }}&department={{ $value->department }}&designation={{ $value->designation }}&name={{ $value->fname.' '.$value->mname.' '.$value->lname }}&joindate={{ $value->joindate }}&presentdays={{ $value->presentdays }}&clleave={{ $value->clleave }}&plleave={{ $value->plleave }}&lopleave={{ $value->lopleave }}&salary={{ $value->salary }}&actualsal={{ $value->actualsal }}&deductedsal={{ $value->deductedsal }}&empsalary={{ $value->empsalary }}&year_month={{ $value->year_month }}">Download</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>

<script>

    $(document).ready(function() {
        var table = $('#salary').DataTable();
    });

</script>