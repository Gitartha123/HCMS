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
            <form  id="entriesSelected" method="post" data-route = {{ route('generatesalary') }}>
                @csrf
                <table id="salary" class="display" cellspacing="0" width="100%">
                    <thead>
                    <tr class="w3-green trow">
                        <th>Name</th>
                        <th>Department</th>
                        <th>Designation</th>
                        <th>CL Leave</th>
                        <th>PL Leave</th>
                        <th>LOP leave</th>
                        <th>Present Days</th>
                        <th width="100px">Select All <input type="checkbox" class='checkall w3-right' id='checkall'></th>
                    </tr>
                    </thead>
                    @foreach($item as $value)
                    <tbody>
                    <tr class="trow">
                        <td>{{ $value->fname.' '.$value->mname.' '.$value->lname }}<input type="hidden" name="name[]" value="{{ $value->fname.' '.$value->mname.' '.$value->lname }}"></td>
                        <td>{{ $value->name }}<input type="hidden" name="department[]" value="{{ $value->name }}"></td>
                        <td>{{ $value->dname }}<input type="hidden" name="designation[]" value="{{ $value->dname }}"></td>
                        <input type="hidden" value="{{ $value->employeeid }}">
                        <td><input type="hidden" name="clleave[]" value=""></td>
                        <td><input type="hidden" name="plleave[]" value="Male"></td>
                        <td><input type="hidden" name="lopleave[]" value="Male"></td>
                        <td>{{ $value->total }}<input type="hidden" name="presentdays[]" value="{{ $value->total }}"></td>
                        <td><input type="checkbox" class="delete_check " id="delcheck_.'+full.fname+'" onclick="checkcheckbox();" value="'+full.fname+'"></td>
                    </tr>
                    </tbody>
                        @endforeach
                </table>
                <button id="submit" class="w3-button w3-green w3-hover-red">Generate</button>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
var table = $('#salary').DataTable();

$('#salary tbody').on( 'change', 'tr', function () {
   $(this).toggleClass('selected');
    $(this).find('.delete_check').css('background-color','red').toggleClass('checked');

});


$('#checkall').click(function () {
    if($(this).is(':checked')) {
        $('tr').toggleClass('selected');
        $('.delete_check').prop('checked', true);
    }
    else{
        $('.delete_check').prop('checked', false);
        $('tr').toggleClass('selected',false);
    }
});



$('#submit').click( function (e) {
e.preventDefault();
var selectedRowInputs = $('.selected input');

//use the serialized version of selectedRowInputs as the data
//to be sent to the AJAX request
console.log('serlialized inputs: ',selectedRowInputs.serialize());
if(selectedRowInputs.length <= 0){
    alert('You have not seleected');
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
            data: selectedRowInputs.serialize(),
            success:function (Response) {
                console.log(Response);
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