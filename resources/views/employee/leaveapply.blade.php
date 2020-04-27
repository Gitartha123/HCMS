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
<script language="javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script language="javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.22/jquery-ui.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
@include('employee.employeeSidebar')
<style>
    @media screen and (min-width: 992px) {
        .topnav {
            right:0;left:15%;position:absolute;
        }
    }
    input {
        text-transform: uppercase;
    }
    ::-webkit-input-placeholder { /* WebKit browsers */
        text-transform: none;
    }
    :-moz-placeholder { /* Mozilla Firefox 4 to 18 */
        text-transform: none;
    }
    ::-moz-placeholder { /* Mozilla Firefox 19+ */
        text-transform: none;
    }
    :-ms-input-placeholder { /* Internet Explorer 10+ */
        text-transform: none;
    }
    ::placeholder { /* Recent browsers */
        text-transform: none;
    }

    a{
        text-decoration: none;
    }

    td.red span.ui-state-default {
        background: none #FFEBAF;
        border: 1px solid #BF5A0C;
        color: red;
    }
</style>

<script src="public/js/photovalidation.js"></script>
<div class="w3-card-4 w3-padding  w3-animate-zoom  item topnav">
    <div class="w3-card-4  w3-padding w3-border-aqua w3-round-medium w3-light-gray">
        <div class="w3-panel w3-border  w3-padding w3-border-gray w3-round-xlarge w3-center">
            <strong style="color:black;font-size: 20px;">APPLY LEAVE</strong>
        </div>
        <form  method="post" action="{{ route('employeeregistration') }}" id="form1" enctype="multipart/form-data" onsubmit="return Validate(this);" onmouseover="if( document.getElementById('leavetype').value == 2){getDays()} else if(document.getElementById('leavetype').value == 1){Paid()}">
            @csrf

                <input type="hidden" id="holiday" name="holiday[]" value = "{{ $holiday }}">

            <div class="w3-row" >
                <div class="w3-half">
                    <div class="w3-container w3-padding" >
                        <div class="w3-card w3-border w3-round w3-green w3-margin" >
                            <div class="w3-panel w3-padding w3-center">
                                <strong style="color:black;font-size: 18px;">MY LEAVE AVAILABILITY</strong>
                            </div>

                            <div class="table-responsive">
                                <table class="table w3-table-all w3-border w3-hoverable">
                                    <tr class="w3-green">
                                        <td>Leave Type</td>
                                        <td class="w3-border" style="width: 50%">Casual</td>
                                        <td class="w3-border" style="width: 50%">Paid</td>
                                    </tr>
                                    <tr class="w3-green">
                                        <td>Total no. of leave</td>
                                        <td class="w3-border">{{ $getclamount }} Days</td>
                                        <td class="w3-border">{{ $getplamount }} Days</td>
                                    </tr>
                                    <tr class="w3-green">
                                        <td>Applied no. of leave</td>
                                        <td class="w3-border" style="max-width: 50%">{{ $clcount  }} Days</td>
                                        <td class="w3-border" style="max-width: 50%">{{ $plcount  }} Days</td>
                                    </tr>
                                    <tr class="w3-green">
                                        <td>Available leave</td>
                                        <td class="w3-border" style="max-width: 50%">{{ $getclamount - $clcount }} Days</td>
                                        <td class="w3-border" style="max-width: 50%">{{ $getplamount - $plcount }} Days</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w3-half">
                    <div class="w3-card w3-padding">
                        <select name="leavetype" id="leavetype" class="w3-input w3-border w3-round-xlarge"  >
                            <option disabled selected id="leavetype">Select Leave Type</option>
                            <option value="1">Paid Leave</option>
                            <option value="2">Casual Leave</option>
                        </select>

                        <p></p>
                        <input type='text' class="w3-input w3-border" id="txtDate1" name="fromdate" placeholder="Leave from*" autocomplete="off">
                        <p></p>
                        <input type='text' class="w3-input w3-border" id="txtDate2" name="todate" placeholder="Leave to*" autocomplete="off">

                        <p></p>
                        <input type="text" class="w3-input w3-border w3-round" placeholder="Duration" id="duration"readonly >

                        <p></p>

                        <select name="reason" id="reason" class="w3-input w3-border w3-round-xlarge" onclick="getReason()">
                            <option disabled selected id="reason">Select Reason for leave</option>
                            <option >Medical Purpose</option>
                            <option>Ocassion</option>
                            <option value="3">Others</option>
                        </select>

                        <p></p>

                        <textarea class="w3-input w3-border w3-round w3-animate-top" style="height: 200px; display: none" placeholder="Reason for leave*" id="r"></textarea>

                        <p></p>
                        <label class="w3-margin">Supporting Document</label>
                        <input type="file"  name="signature" class="w3-input w3-border w3-round-xlarge btn btn-secondary"  data-toggle="tooltip" data-placement="top" title="Image size should be greater than 150KB and not more than 1MB and choose only JPEG,JPG and PNG image" onchange="validateSignature()" id="signature">
                        <p></p>
                        <div class="w3-center">
                            <button type="submit" class="w3-button w3-hover w3-hover-red w3-border w3-border-grey w3-round-xlarge zoom" >Submit</button>
                        </div>
                    </div>
                </div>
            </div>


        </form>
    </div>
</div>
</body>

<script>
    function copyAddress(){
        var x = document.getElementById('paddress').value;
        document.getElementById('caddress').value = x;
        document.getElementById('undo').style.display ='block';
        document.getElementById('do').style.display ='none';
    }
    function copyAdd(){
        document.getElementById('caddress').value = " ";
        document.getElementById('do').style.display ='block';
        document.getElementById('undo').style.display ='none';
    }
</script>


<script type="text/javascript">
    $(function(){
        $('[data-toggle = "tooltip"]').tooltip()
    })

    var holiday = [];
    var arrayable = [];
    jQuery.ajax(
        {
            url : 'http://localhost/HCMS/api/getholiday',
            type : "GET",
            dataType : "json",

            success : function (response) {

                for(var i=0;i< response.data.length;i++){
                    var d = new Date(response.data[i].date);
                    holiday.push(response.data[i].date);
                    var date = d.getDate();
                    var year = d.getFullYear();
                    var month= d.getMonth();
                    var title = response.data[i].title;
                    arrayable.push([year,month,date,title]);
                }
                console.log(holiday);
                console.log(arrayable);
            }
        }
    )

   $('#leavetype').change(function(){
        switch(parseInt(jQuery(this).val())){
            case 2 :
                document.getElementById('txtDate1').value = null
                document.getElementById('txtDate2').value = null
                document.getElementById('duration').value = null
                $("#txtDate1,#txtDate2").datepicker("destroy");
            $('#txtDate1, #txtDate2').datepicker({
                minDate :0,
                dateFormat: 'yy-mm-dd',
                beforeShowDay:  disableSpecificDates
            })
                $( "#txtDate1,#txtDate2" ).datepicker("refresh");
            break;
            case 1:
                document.getElementById('txtDate1').value = null
                document.getElementById('txtDate2').value = null
                document.getElementById('duration').value = null
                $("#txtDate1,#txtDate2").datepicker("destroy");
                $('#txtDate1,#txtDate2').datepicker({
                    minDate : 0,
                    dateFormat: "yy-mm-dd",
                })
                $( "#txtDate1,#txtDate2" ).datepicker("refresh");
            break;
            default :
                alert('select leave type');
                break;
        }
   });


    var p = document.getElementById('leavetype').value
    function disableSpecificDates(date){
        for (i = 0; i < arrayable.length; i++) {
            if (date.getFullYear() == arrayable[i][0]
                && date.getMonth() == arrayable[i][1]
                && date.getDate() == arrayable[i][2]) {
                return [false, 'holiday red', arrayable[i][3]];
            }
        }

        var day = date.getDay();
        return [day != 0,''];
    }


    function getDays(){
        var start   = $('#txtDate1').datepicker('getDate');
        var end = $('#txtDate2').datepicker('getDate');
        var totalBusinessDays = 0;
        // normalize both start and end to beginning of the day
        start.setHours(0, 0, 0, 0);
        end.setHours(0, 0, 0, 0);
        var current = new Date(start);
        current.setDate(current.getDate() + 1);
        var day;
        while (current <= end) {
            day = current.getDay();
            var mystring = jQuery.datepicker.formatDate('yy-mm-dd', current);

            if ( day < 1 || day > 6 || $.inArray(mystring,holiday)!=-1) {
                ++totalBusinessDays;
            }
            current.setDate(current.getDate() + 1);
        }
        var x = " "+"Days"
        var days   = (((end - start)/1000/60/60/24)-totalBusinessDays+1)
        var y = days + x
        if(days <= 0){
          document.getElementById('txtDate1').value = null
          document.getElementById('txtDate2').value = null
          document.getElementById('duration').value = null
        }
        else {
            document.getElementById('duration').value = y
        }
    }


    function Paid(){
        var date1 = new Date(document.getElementById('txtDate1').value)
        var date2 = new Date(document.getElementById('txtDate2').value)

        if(! isNaN(date1) && ! isNaN(date2)){

            // To calculate the time difference of two dates
            var Difference_In_Time = date2.getTime() - date1.getTime();

            // To calculate the no. of days between two dates
            var x = " "+"Days"
            var days = (Difference_In_Time / (1000 * 3600 * 24))+1
            var y = days+x;
            if(days <= 0){
                document.getElementById('txtDate1').value = null
                document.getElementById('txtDate2').value = null
                document.getElementById('duration').value = null
            }
            else {
                document.getElementById('duration').value = y
            }
        }
    }

</script>
<script>
    function getReason(){
        var x = document.getElementById('reason').value
        if(x == 3){
            document.getElementById('r').style.display = "block"
        }
        else{
            document.getElementById('r').style.display = "none"
        }
    }
</script>








