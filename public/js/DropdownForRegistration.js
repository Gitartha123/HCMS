function copyValue() {
    var dropboxvalue = document.getElementById('desg').value;
    document.getElementById('desgid').value = dropboxvalue;
}


jQuery(document).ready(function ()
{
    jQuery('select[name="department"]').on('change',function(){
        var departmentID = jQuery(this).val();
        if(departmentID)
        {
            jQuery.ajax({
                url : 'dropdownlist/getdesignation/' +departmentID,
                type : "GET",
                dataType : "json",
                success:function(data)
                {
                    console.log(data);
                    jQuery('select[name="designation"]').empty();
                    $('select[name="designation"]').append('<option disabled selected>'+ "Select Designation" +'</option>');
                    jQuery.each(data, function(key,value){
                        $('select[name="designation"]').append('<option value="'+ key +'">'+ value +'</option>');
                    });
                }
            });
        }
        else
        {
            $('select[name="designation"]').empty();
        }
    });
});