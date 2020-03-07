
$(document).ready(function() {
    $.validator.addMethod("valueNotEquals", function(value, element, arg){
        return arg != value;
    }, "Value must not equal arg.");

    jQuery.validator.addMethod("lettersonly", function(value, element) {
        return this.optional(element) || /^[a-z\s]+$/i.test(value);
    }, "Please type letters only");

    jQuery.validator.addMethod('filesize', function (value, element, arg) {
        var minsize = 0;
        if ((element.files[0].size > minsize) && (element.files[0].size <= arg)) {
            return true;
        } else {
            return false;
        }
    }, "File size must be less than 500KB.");

    $("#form1").validate({
        rules: {
            fname: { required:true ,lettersonly:true,maxlength: 50},
            lname: { required: true,lettersonly:true,maxlength: 50 },
            gender: { required: true },
            dob: {required:true},
            nationality: { required: true, lettersonly:true ,maxlength:10 },
            father: { required:true ,lettersonly:true,maxlength: 50},
            mother:{required:true,lettersonly:true,maxlength:50},
            mstatus:{required:true},
            paddress:{required:true,maxlength:200},
            caddress:{required:true,maxlength:200},
            ph:{required:true},
            email:{required:true,maxlength:50},
            department:{required:true},
            designation:{required:true},
            desgid:{required:true},
            joindate:{required:true},
            photo:{required:true},
            signature:{required:true}
        },
        messages: {
            fname: { required:"Enter first name" ,lettersonly:"Enter only letters",maxlength: "Name should not be grater than 50 letters"},
            lname: { required:"Enter last name" ,lettersonly:"Enter only letters",maxlength: "Name should not be grater than 50 letters" },
            gender: { required: "Enter gender" },
            dob: {required:"Enter Date of Birth",extensions:'jpg'},
            nationality: { required: "Enter Nationality", lettersonly:"Enter letters only" ,maxlength:"Error" },
            father: { required:"Enter father's name" ,lettersonly:"Enter letters only",maxlength: "Error"},
            mother:{required:"Enter mother's name" ,lettersonly:"Enter letters only",maxlength: "Error"},
            mstatus:{required:"Select marital status" },
            paddress:{required:"Enter permanent address" ,maxlength:"Error"},
            caddress:{required:"Enter current address" ,maxlength:"Error"},
            ph:{required:"Enter phone number"},
            email:{required:"Enter email" ,maxlength:"Error"},
            department:{required:"Select department" },
            designation:{required:"Designation not declared" },
            desgid:{required:"Salary not declared" },
            joindate:{required:"Enter joining date" },
            photo:{required:"Select an image"},
            signature:{required:"Select an image"}
        }
    });
});

    function restrictAlphabets(e){
        var x=e.which||e.keycode;
        if((x>=48 && x<=57) || x==8 ||
            (x>=35 && x<=40)|| x==46)
            return true;
        else
            return false;
    }
