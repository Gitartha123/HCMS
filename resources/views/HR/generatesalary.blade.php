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
                <strong style="color:white;font-size: 20px;">GENERATE EMPLOYEE SALARY</strong>
            </div>
            <div id="add">
                <form  id="entriesSelected" method="post" data-route = "{{ route('generatesalary') }}" action="{{ route('generatesalary') }}">
                    @csrf
                    <table id="salary" class="display" cellspacing="0" width="100%">
                        <thead>
                        <tr class="w3-green trow">
                            <th width="100px">Name</th>
                            <th>Dept.</th>
                            <th>Desg.</th>
                            <th>Present Days</th>
                            <th>CL Leave</th>
                            <th>PL Leave</th>
                            <th>LOP leave</th>
                            <th>Deduction</th>
                            <th>Generated Salary</th>
                            <th>Deducted salary</th>
                            <th>Final Salary</th>
                            <th >Select All <input type="checkbox" class='checkall w3-right' id='checkall'></th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($new_item as $value)


                            <tr class="trow">
                                <td>{{ $value->fname.' '.$value->mname.' '.$value->lname }}<input type="hidden" name="name" value="{{ $value->fname.' '.$value->mname.' '.$value->lname }}"></td>
                                <td>{{ $value->name }}<input type="hidden" name="department" value="{{ $value->name }}"></td>
                                <td>{{ $value->dname }}<input type="hidden" name="designation" value="{{ $value->dname }}"></td>
                                <td>{{ $value->total }} Days<input type="hidden" name="presentdays" value="{{ $value->total }}"></td>
                                <input type="hidden" value="{{ $value->id }}" name="employeeid">
                                <input type="hidden" value="{{ $value->year_month }}" name="year_month">
                                <input type="hidden" value="{{ $value->salary }}" name="salary">
                                <input type="hidden" value="{{ $value->holidaycount }}" name="holidaycount">
                                <input type="hidden" value="{{ $status }}" name="status">

                                <td><input type="hidden" name="clleave" value="{{ $value->clleave }}">{{ $value->clleave }} Days</td>

                                <td><input type="hidden" name="plleave" value="{{ $value->plleave }}">{{ $value->plleave }} Days</td>

                                <td><input type="hidden" name="lopleave" value="{{ $value->lopleave }}">{{ $value->lopleave }} Days</td>

                                <td id="ded">
                                    @if($value->deduction==null)
                                    <select name="deduction">
                                        <option disabled selected>Deduction</option>
                                        @php
                                            for ($i=1;$i<=31;$i++)
                                            echo'<option value="'.$i.'">'.$i.'</option>';
                                        @endphp
                                    </select>
                                    @elseif($value->deduction != null)
                                        @if($value->deduction == 100)
                                            0 Days
                                        @else
                                        {{ $value->deduction }} Days<input type="hidden" name="deduct" value="{{ $value->deduction }}">
                                            @endif
                                @endif
                                </td>
                                <td id="s1">{{ $value->salary_by_attendance  }}/-</td>
                                <td id="s2">{{ $value->deducted_salary }}/-</td>
                                <td id="s3">{{ $value->final_salary }}/-<input name="s3" value="{{ $value->final_salary }}" type="hidden"></td>
                                <td><input type="checkbox" class="delete_check " id="delete_check" onclick="checkcheckbox();" value="'+full.fname+'" name="delete_check"></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <button id="submit" class="w3-button w3-green w3-hover-red" value="1">Generate</button>
                    <button id="revert" class="w3-button w3-green w3-hover-red w3-margin" value="2" style="display:none;">Generate</button>
                    <button id="revert1" class="w3-button w3-green w3-hover-red w3-margin" value="4">Revert</button>
                    <button id="confirm" class="w3-button w3-green w3-hover-red w3-margin" value="3">Confirm</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>

    $(document).ready(function() {
        var table = $('#salary').DataTable();


        if ($('input[name=status]').val().length == 0){
            $('#revert1').prop('disabled',true);
            $('#confirm').prop('disabled',true);
        }

        arr = [];

        $('#salary tbody tr').each(function () {
            fs =  $(this).find('input[name=s3]').val();
            if(fs == 0){
                arr.push({
                    'value' : 1
                });
            }
        });
        console.log(arr);
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
            $('#revert1').prop('disabled',true);
        }
        $('#submit').click( function (e) {
            e.preventDefault();
            var value = [];
            $("#add input[name=delete_check]:checked").each(function(){
                row = $(this).closest("tr");
                a = $(row).find('select[name=deduction]').val();
                b = $(row).find("input[name=presentdays]").val();
                c = $(row).find("input[name=clleave]").val();
                f = $(row).find("input[name=plleave]").val();
                h = $(row).find("input[name=salary]").val();
                g = $(row).find("input[name=lopleave]").val();
                i = $(row).find("input[name=holidaycount]").val();
                if(a!=null){
                    $(row).find('#ded').html(a +' '+'Days');
                }
                else{
                    a = 0;
                    $(row).find('#ded').html(a +' '+'Days');
                }
                salary_per_day = h/30;
                actual_salary = salary_per_day * (parseInt(b)+parseInt(c)+ parseInt(f)+parseInt(i));
                deducted_salary = salary_per_day * parseInt(a);
                final_salary = actual_salary - deducted_salary;
                value.push({
                    emp_id :$(row).find("input[name=employeeid]").val(),
                    presentdays : b,
                    clleave :c,
                    plleave : f,
                    lopleave : g,
                    deduction : a,
                    salary : h,
                    year_month : $(row).find("input[name=year_month]").val(),
                    department : $(row).find("input[name=department]").val(),
                    designation : $(row).find("input[name=designation]").val(),
                    actual_salary :actual_salary.toFixed(2),
                    deducted_salary : deducted_salary.toFixed(2),
                    final_salary : final_salary.toFixed(2),
                    button_id : $("button[id=submit]").val()
                });

                if($('#input[name=status]').val() == null){
                    $(row).find('#s1').html(actual_salary.toFixed(2)+' '+'/-');
                    $(row).find('#s2').html(deducted_salary.toFixed(2)+' '+'/-');
                    $(row).find('#s3').html(final_salary.toFixed(2)+' '+'/-');
                }

            });


            if(value.length <= 0){
                alert('You have not selected');
            }
            else {
                var x = confirm('Are you sure want to generate salary ?');
                if (x) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "POST",
                        url: $('#entriesSelected').data('route'),
                        contentType: 'application/json',
                        data: JSON.stringify(value),
                        success: function (html) {
                            alert('Salary generated');
                            $('#revert1').prop('disabled', false);
                            $('#confirm').prop('disabled', false);
                            $('.delete_check').prop('checked', false);
                        }
                    });
                } else {
                    return false;
                }
            }
            $('#salary tbody tr').each(function () {
                fs =  $(this).find('input[name=s3]').val();
                if(fs == 0){
                    arr.push({
                        'value' : 1
                    });
                }
                else{
                    arr.length = 0;
                }
            });
            console.log(arr.length);
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
                actual_salary :0,
                deducted_salary : 0,
                final_salary : 0,
                year_month : $("input[name=year_month]").val(),
                holidaycount :0,
                department : 0,
                designation : 0,
                button_id : $("button[id=confirm]").val(),

            });

            if(arr.length == 0){
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
                            $('#revert1').prop('disabled',true);
                        }
                    });
                }
                else{
                    return false;
                }

            }
            else{
                alert('Salary of all employees are not generated');
            }

        });
        $('#revert').click( function (e) {
            e.preventDefault();
            var value = [];
            $("#add input[name=delete_check]:checked").each(function(){
                row = $(this).closest("tr");
                a = $(row).find('select[name=deduction]').val();
                b = $(row).find("input[name=presentdays]").val();
                c = $(row).find("input[name=clleave]").val();
                f = $(row).find("input[name=plleave]").val();
                h = $(row).find("input[name=salary]").val();
                g = $(row).find("input[name=lopleave]").val();
                i = $(row).find("input[name=holidaycount]").val();
                if(a!=null){
                    $(row).find('#ded').html(a +' '+'Days');
                }
                else{
                    a = 0;
                    $(row).find('#ded').html(a +' '+'Days');
                }
                salary_per_day = h/30;
                actual_salary = salary_per_day * (parseInt(b)+parseInt(c)+ parseInt(f)+parseInt(i));
                deducted_salary = salary_per_day * parseInt(a);
                final_salary = actual_salary - deducted_salary;
                value.push({
                    emp_id :$(row).find("input[name=employeeid]").val(),
                    presentdays : b,
                    clleave :c,
                    plleave : f,
                    lopleave : g,
                    deduction : a,
                    salary : h,
                    year_month : $(row).find("input[name=year_month]").val(),
                    department : $(row).find("input[name=department]").val(),
                    designation : $(row).find("input[name=designation]").val(),
                    actual_salary :actual_salary.toFixed(2),
                    deducted_salary : deducted_salary.toFixed(2),
                    final_salary : final_salary.toFixed(2),
                    button_id : $("button[id=revert]").val()
                });

                if($('#input[name=status]').val() == null){
                    $(row).find('#s1').html(actual_salary.toFixed(2)+' '+'/-');
                    $(row).find('#s2').html(deducted_salary.toFixed(2)+' '+'/-');
                    $(row).find('#s3').html(final_salary.toFixed(2)+' '+'/-');
                }

            });


            if(value.length <= 0){
                alert('You have not selected');
            }
            else{
                var x = confirm('Are you sure want to revert data ?');
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
                            alert('Salary reverted');
                            $('#revert1').show();
                            $('#confirm').show();
                            $('#submit').show();
                            $('#revert').hide();
                            $('.delete_check').prop('checked',false);
                            $('#salary tbody tr').each(function () {
                                fs =  $(this).find('input[name=s3]').val();
                                if(fs == 0){
                                    arr.push({
                                        'value' : 1
                                    });
                                }
                                else{
                                    arr.length = 0;
                                }
                            });
                            console.log(arr.length);
                        }
                    });
                }
                else{
                    return false;
                }
            }
        });

        $('#revert1').click(function (e) {
            e.preventDefault();
            revert_empid = [];
            $("#add input[name=delete_check]:checked").each(function(){
                row4 = $(this).closest("tr");
                $(row4).find('#ded').html('<select name="deduction"><option disabled selected>Deduction</option><?php for($i=1;$i<=31;$i++) echo '<option value="'.$i.'">'.$i.'</option>';?></select>');
                $(row4).find('input[name=deduct]').hide();
                $(row4).find('#s1').html('0/-');
                $(row4).find('#s2').html('0/-');
                $(row4).find('#s3').html('0/-');
                revert_empid = $(row).find('input[name=employeeid]').val();
            });
            if(revert_empid.length <= 0){
              alert('You have not selected');
            }
            else{
                var m = confirm('Click ok to revert');
                if(m){
                    $('#revert').show();
                    $('#submit').hide();
                    $('#revert1').hide();
                    $('#confirm').hide();
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