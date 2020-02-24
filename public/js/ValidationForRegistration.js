
$(document).ready(function() {
    $.validator.addMethod("valueNotEquals", function(value, element, arg){
        return arg != value;
    }, "Value must not equal arg.");

    jQuery.validator.addMethod("lettersonly", function(value, element) {
        return this.optional(element) || /^[a-z\s]+$/i.test(value);
    }, "Please type letters only");

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
            ph:{required:true,digits:true,maxlength:10},
            altph:{digits:true,maxlength:10},
            email:{required:true,maxlength:50},
            department:{required:true},
            designation:{required:true},
            desgid:{required:true},
            joindate:{required:true}
        },
        messages: {
            fname: { required:"Enter first name" ,lettersonly:"Enter only letters",maxlength: "Name should not be grater than 50 letters"},
            lname: { required:"Enter last name" ,lettersonly:"Enter only letters",maxlength: "Name should not be grater than 50 letters" },
            gender: { required: "Enter gender" },
            dob: {required:"Enter Date of Birth"},
            nationality: { required: "Enter Nationality", lettersonly:"Enter letters only" ,maxlength:"Error" },
            father: { required:"Enter father's name" ,lettersonly:"Enter letters only",maxlength: "Error"},
            mother:{required:"Enter mother's name" ,lettersonly:"Enter letters only",maxlength: "Error"},
            mstatus:{required:"Select marital status" },
            paddress:{required:"Enter permanent address" ,maxlength:"Error"},
            caddress:{required:"Enter current address" ,maxlength:"Error"},
            ph:{required:"Enter phone number" ,digits:"Enter digits only",maxlength:"Phone number should not be greater than 10 "},
            altph:{digits:"Enter digits only",maxlength:"Phone number should not be greater than 10 "},
            email:{required:"Enter email" ,maxlength:"Error"},
            department:{required:"Select department" },
            designation:{required:"Designation not declared" },
            desgid:{required:"Salary not declared" },
            joindate:{required:"Enter joining date" }
        }
    });
});