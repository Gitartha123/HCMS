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
<style>
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
</style>
@include('HR.sidebar');
<div  class="w3-card-4 w3-padding w3-animate-zoom item topnav" id="viewemployee" >
    <div class="w3-card-4  w3-padding w3-border-aqua w3-round-medium w3-light-gray w3-margin">
        <div class="table-responsive">
            <div class="w3-panel w3-border  w3-padding w3-border-gray w3-round-xlarge w3-center">
                <strong style="color:black;font-size: 20px;">EMPLOYEE DETAILS</strong>
            </div>
            <div id="add">
                <form  id="entriesSelected" method="post" data-route = "{{ route('generatesalary') }}" action="{{ route('generatesalary') }}">
                    @csrf
                    <table id="salary" class="display" cellspacing="0" width="100%">
                        <thead>
                        <tr class="w3-green trow">
                            <th>Name</th>
                            <th>Department</th>
                            <th>Designation</th>
                            <th>Present Days</th>
                            <th>CL Leave</th>
                            <th>PL Leave</th>
                            <th>LOP leave</th>
                            <th></th>
                            <th width="100px">Select All <input type="checkbox" class='checkall w3-right' id='checkall'></th>
                        </tr>
                        </thead>


                        @foreach($new_item as $value)
                            <tbody>

                            <tr class="trow">
                                <td>{{ $value->fname.' '.$value->mname.' '.$value->lname }}<input type="hidden" name="name" value="{{ $value->fname.' '.$value->mname.' '.$value->lname }}"></td>
                                <td>{{ $value->name }}<input type="hidden" name="department" value="{{ $value->name }}"></td>
                                <td>{{ $value->dname }}<input type="hidden" name="designation" value="{{ $value->dname }}"></td>
                                <td>{{ $value->total }}<input type="hidden" name="presentdays" value="{{ $value->total }}"></td>
                                <input type="hidden" value="{{ $value->employeeid }}" name="employeeid">
                                <input type="hidden" value="{{ $value->year_month }}" name="year_month">
                                <input type="hidden" value="{{ $value->salary }}" name="salary">
                                <input type="hidden" value="{{ $value->holidaycount }}" name="holidaycount">
                                <input type="hidden" value="{{ $status }}" name="status">

                                <td><input type="hidden" name="clleave" value="{{ $value->clleave }}">{{ $value->clleave }}</td>

                                <td><input type="hidden" name="plleave" value="{{ $value->plleave }}">{{ $value->plleave }}</td>

                                <td><input type="hidden" name="lopleave" value="{{ $value->lopleave }}">{{ $value->lopleave }}</td>
                                <td><select name="deduction">
                                        <option disabled selected>Deduction</option>
                                        @php
                                            for ($i=0;$i<=31;$i++)
                                            echo'<option value="'.$i.'">'.$i.'</option>';
                                        @endphp
                                    </select> </td>
                                <td><input type="checkbox" class="delete_check " id="delete_check" onclick="checkcheckbox();" value="'+full.fname+'" name="delete_check"></td>
                            </tr>

                            </tbody>
                        @endforeach
                    </table>
                    <button id="submit" class="w3-button w3-green w3-hover-red" value="1">Generate</button>
                    <button id="revert" class="w3-button w3-green w3-hover-red w3-margin" value="2">Revert</button>
                    <button id="confirm" class="w3-button w3-green w3-hover-red w3-margin" value="3">Confirm</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>

    $(document).ready(function() {
        var table = $('#salary').DataTable();

        $('#checkall').click(function () {
            if($(this).is(':checked')) {
                $('.delete_check').prop('checked', true);
            }
            else{
                $('.delete_check').prop('checked', false);
            }
        });

        if($('input[name=status]').val()==1){
            $('#submit').prop('disabled',true);
            $('#revert').prop('disabled',true);
        }
        $('#submit').click( function (e) {
            e.preventDefault();
            var value = [];
            $("#add input[name=delete_check]:checked").each(function(){
                row = $(this).closest("tr");
                value.push({
                    emp_id :$(row).find("input[name=employeeid]").val(),
                    presentdays : $(row).find("input[name=presentdays]").val(),
                    clleave : $(row).find("input[name=clleave]").val(),
                    plleave : $(row).find("input[name=plleave]").val(),
                    lopleave : $(row).find("input[name=lopleave]").val(),
                    deduction : $(row).find("select[name=deduction]").val(),
                    salary : $(row).find("input[name=salary]").val(),
                    year_month : $(row).find("input[name=year_month]").val(),
                    holidaycount : $(row).find("input[name=holidaycount]").val(),
                    department : $(row).find("input[name=department]").val(),
                    designation : $(row).find("input[name=designation]").val(),
                    button_id : $("button[id=submit]").val()
                });
            });

            if(value.length <= 0){
                alert('You have not selected');
            }
            else{
                var x = confirm('Are you sure want to generate salary ?');
                if(x){
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "POST",
                        url: $('#entriesSelected').data('route'),
                        contentType: 'application/json',
                        data: JSON.stringify(value),
                        success:function (html) {
                            alert('Salary generated');
                        }
                    });
                }
                else{
                    return false;
                }
            }
        });
        $('#confirm').click( function (e) {
            e.preventDefault();
            var value3 = [];
            value3.push({
                emp_id : 0,
                presentdays : 0,
                clleave : 0,
                plleave : 0,
                lopleave : 0,
                deduction : 0,
                salary : 0,
                year_month : $("input[name=year_month]").val(),
                holidaycount :0,
                department : 0,
                designation : 0,
                button_id : $("button[id=confirm]").val(),

            });

            var x2 = confirm('Are you sure want to confirm?');
                if(x2){
                    $('#submit').prop('disabled',true);
                    $('#revert').prop('disabled',true);
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "POST",
                        url: $('#entriesSelected').data('route'),
                        contentType: 'application/json',
                        data: JSON.stringify(value3),
                        success:function (html) {
                            alert('Final salary list is generated');
                        }
                    });
                }
                else{
                    return false;
                }

        });
        $('#revert').click( function (e) {
            e.preventDefault();
            var value2 = [];
            $("#add input[name=delete_check]:checked").each(function(){
                row2 = $(this).closest("tr");
                value2.push({
                    emp_id :$(row2).find("input[name=employeeid]").val(),
                    presentdays : $(row2).find("input[name=presentdays]").val(),
                    clleave : $(row2).find("input[name=clleave]").val(),
                    plleave : $(row2).find("input[name=plleave]").val(),
                    lopleave : $(row2).find("input[name=lopleave]").val(),
                    deduction : $(row2).find("select[name=deduction]").val(),
                    salary : $(row2).find("input[name=salary]").val(),
                    year_month : $(row2).find("input[name=year_month]").val(),
                    holidaycount : $(row2).find("input[name=holidaycount]").val(),
                    department : $(row).find("input[name=department]").val(),
                    designation : $(row).find("input[name=designation]").val(),
                    button_id : $("button[id=revert]").val()
                });
            });

            if(value2.length <= 0){
                alert('You have not selected');
            }
            else{
                var x2 = confirm('Are you sure want to revert salary ?');
                if(x2){
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "POST",
                        url: $('#entriesSelected').data('route'),
                        contentType: 'application/json',
                        data: JSON.stringify(value2),
                        success:function (html) {
                            alert('Data reverted');
                        }
                    });
                }
                else{
                    return false;
                }
            }
        });
    });
    // Checkbox checked
    function checkcheckbox(){
        // Total checkboxes
        var length = $('.delete_check').length;
        // Total checked checkboxes
        var totalchecked = 0;
        $('.delete_check').each(function(){
            if($(this).is(':checked')){
                totalchecked+=1;
            }
        });
        // Checked unchecked checkbox
        if(totalchecked == length){
            $("#checkall").prop('checked', true);
        }else{
            $('#checkall').prop('checked', false);
        }
    }


</script>