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
                    <th>Request Date :</th>
                    <th>Requested field </th>
                    <th>Requested phone number</th>
                    <th>Requested email id</th>
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

        var table = $('.data-table').DataTable({
            "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                if ( aData['count'] == 3 )
                {
                    $('td', nRow).css('background-color', 'blue');
                }
            },
            processing: true,
            serverSide: true,
            order: [ [0, 'desc'] ],

            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex' },
                {data: 'created_at',name:'updated_at'},
                {
                    "data" : 'item',
                    render : function (data,type,row) {
                        if(row.item == 1){
                            item = "Phone number";
                            return item;
                        }
                        else if (row.item == 2){
                            item = "Email Id";
                            return item;
                        }
                        else if (row.item == 3){
                            item = "Both Email and Phone number";
                            return item;
                        }
                    },

                },
                {data : 'phone', name: 'phone'},
                {data: 'mail', name : 'mail'},
                {
                    "data" : 'rstatus',
                    render : function (data,type,row) {
                        if (row.rstatus == 0 ) {
                            return "Pending";
                        }
                        else if (row.rstatus == 1){
                            return "Rejected";
                        }
                        else if (row.rstatus == 2){
                            return "Your requested fields are successfully updated";
                        }
                    },
                }
            ]
        });

    });

</script>


