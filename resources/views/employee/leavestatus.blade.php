@if(Session::has('message'))
    <script>alert("{{ Session::get('message') }}")</script>
    @endif

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

@include('employee.employeeSidebar')
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
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.21/sorting/datetime-moment.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>


<div  class="w3-card-4 w3-padding w3-animate-zoom item topnav"  >
    <div class="w3-card-4  w3-padding w3-border-aqua w3-round-medium w3-light-gray w3-margin">
        <div class="table-responsive">
            <div class="w3-panel w3-border  w3-padding w3-border-gray w3-round-xlarge w3-center">
                <strong style="color:black;font-size: 20px;">MY REQUESTS</strong>
            </div>
            <table class="table w3-table-all w3-border w3-round w3-hoverable  data-table" width="100%">
                <thead>
                <tr class="w3-green">
                    <th>Sl No.</th>
                    <th>Request Date</th>
                    <th>Leave Type</th>
                    <th>Leave from</th>
                    <th>Leave to</th>
                    <th>Duration</th>
                    <th>Reason</th>
                    <th>Status</th>
                    <th width="100px"></th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function () {

     $('.data-table').DataTable({
            "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                if ( aData['status'] == 0 )
                {
                    $('td', nRow).css('background-color', 'lightblue');
                }
            },

            processing: true,
            serverSide: true,
            ajax : "{{ route('leave') }}",


            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex' },
                {
                    "data": "updated_at",
                    "render": function (data) {
                        var date = new Date(data);
                        var month = date.getMonth() + 1;
                        return (month.toString().length > 1 ? month : "0" + month) + "/" + date.getDate() + "/" + date.getFullYear();
                    }
                },
                {
                    "data" : 'type',
                    render : function (data,type,row) {
                        if (row.type == 1 ) {
                            return "Paid Leave";
                        }
                        else if (row.type == 2){
                            return "Casual Leave";
                        }
                    },
                },
                {data : 'fromdate', name: 'fromdate'},
                {data: 'todate', name : 'todate'},
                {data:'duration',name:'Duration'},
                {
                    "data" : 'reason',
                    render : function (data,type,row) {
                        if (row.reason == 1 ) {
                            return "Medical Purpose";
                        }
                        else if (row.reason == 2){
                            return "Occasion";
                        }
                        else if (row.reason == 3){
                            return "Others";
                        }
                    },
                },
                {
                    data : 'status',
                    render : function (data,type,row) {
                        if (row.status == 0 ) {
                            return "Pending";
                        }
                        else if (row.status == 1){
                            return "Accepted";
                        }
                        else if (row.status == 2){
                            return "Rejected";
                        }
                    },
                },
                {
                    data : null,
                    "render": function ( data, type, full, row ) {
                        var date = new Date(full.fromdate);
                        var year = date.getFullYear();
                        var month = date.getMonth();
                        var day = date.getDate();
                        var today = new Date();
                        var datefrom = new Date(year,month,day);
                        if( full.status == 1 || today > datefrom || full.status == 2 || full.status == 3){
                            return '<button  type="button" class="w3-button w3-border w3-round w3-green w3-hover-red"  disabled>Edit Request</button>'+'   '+'<button  type="button" class="w3-button w3-border w3-round w3-green w3-hover-red"  disabled>Delete Request</button>';
                        }
                        else{
                            return '<button  type="button" class="w3-button w3-border w3-round w3-green w3-hover-red " ><a href="editleave?empid='+full.empid+'&type='+full.type+'&fromdate='+full.fromdate+'&todate='+full.todate+'&reason='+full.reason+'&duration='+full.duration+'&id='+full.id+'&reasonbox='+full.reasonbox+'" style="text-decoration: none"><b style="color: white">Edit Request</b></a></button>'+'   '+'  '+'  '+'<button  type="button" class="w3-button w3-border w3-round w3-green w3-hover-red " onclick= "return confirmDelete()"> <a href="deleteleave?id='+full.id+'" style="text-decoration: none" ><b style="color: white"> Delete Request</b></a></button>';
                        }


                    },
                },
            ]
        });

    });


</script>
<script>
    function  confirmDelete() {
        var x= confirm('Are you sure want to delete ?');
        if(x){
            return true;
        }
        else{
            return false;
        }
    }
</script>