//for photo

function validateImage() {
    var formData = new FormData();

    var file = document.getElementById("img").files[0];

    formData.append("Filedata", file);
    var t = file.type.split('/').pop().toLowerCase();
    if (t != "jpeg" && t != "jpg" && t != "png" && t != "bmp" && t != "gif") {
        alert('Please select a valid image file');
        document.getElementById("img").value = '';
        return false;
    }
    if (file.size > 1024000) {
        alert('Max Upload size is 1MB only');
        document.getElementById("img").value = '';
        return false;
    }
    if (file.size < 150000){
        alert('Min Upload size is 150KB');
        document.getElementById("img").value = '';
        return false;
    }
    return true;
}

//for signature

function validateSignature() {
    var formData = new FormData();

    var file = document.getElementById("signature").files[0];

    formData.append("Filedata", file);
    var t = file.type.split('/').pop().toLowerCase();
    if (t != "jpeg" && t != "jpg" && t != "png" ) {
        alert('Please select a valid image file');
        document.getElementById("signature").value = '';
        return false;
    }
    if (file.size > 1024000) {
        alert('Max Upload size is 1MB only');
        document.getElementById("signature").value = '';
        return false;
    }
    if (file.size < 150000){
        alert('Min Upload size is 150KB');
        document.getElementById("signature").value = '';
        return false;
    }
    return true;
}