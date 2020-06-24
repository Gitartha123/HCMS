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
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
@include('HR.sidebar');
<div  class=" w3-padding w3-animate-zoom item topnav" id="viewemployee" >
    <div class="w3-card-4  w3-padding w3-border-aqua w3-round-medium  w3-margin" style="background-color: rgba(0,0,0,0.5);">
        <div class="table-responsive">
            <div class="w3-panel w3-border  w3-padding w3-border-white w3-round-xlarge w3-center">
                <strong style="color:white;font-size: 20px;">EMPLOYEE DETAILS</strong>
            </div>
            <table class="table w3-table-all w3-border w3-round w3-hoverable  data-table" width="100%">
                <thead>
                <tr class="w3-green">
                    <th>Sl No.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Ph No.</th>
                    <th>Department</th>
                    <th>Designation</th>
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

        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('users.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {
                    "data" : 'fname',
                    render: function(data, type, row) {
                        if (row.mname != null) {
                            var name = row.fname + " " + row.mname + " " + row.lname;
                            return name;
                        }
                        else{
                            return row.fname + " " + row.lname;
                        }
                    },

                },

                {data: 'email', name: 'email'},
                {data:'ph',name:'ph'},
                {data:'name',name:'name'},
                {data:'dname',name:'dname'},
                {
                    "data" : 'status',
                    render : function (data,type,row) {
                        if(row.status == 1){
                            status = "Active";
                            return status;
                        }
                        else if (row.status == 2){
                            status = "Deactive";
                            return status;
                        }
                        else if (row.status == 3){
                            status = "Resigned";
                            return status;
                        }
                        else if (row.status == 4){
                            status = "Suspended";
                            return status;
                        }
                    },

                },
                {
                    "data": null,
                    "render": function ( data, type, full, meta ) {
                        return '<a href="action?email='+full.email+'&name='+full.name+'&dname='+full.dname+'" style="text-decoration: none" class="zoom w3-button w3-border w3-round w3-green w3-hover-red" ;">View</a>';
                    },
                }

            ]
        });

    });

</script>


