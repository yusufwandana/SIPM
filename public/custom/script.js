var nik = document.getElementById("nik");
nik.maxLength = 16;

var nama = document.getElementById("nama");
nama.maxLength = 25;

var noTelp = document.getElementById("no_telp");
noTelp.maxLength = 15;

var email = document.getElementById("email");
email.maxLength = 35;

function validationNumberOnly(evt) {
    var charCode = evt.which ? evt.which : event.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) return false;
    return true;
}

function validationAlpha(evt) {
    var charCode = evt.which ? evt.which : event.keyCode;
    if (
        (charCode < 65 || charCode > 90) &&
        (charCode < 97 || charCode > 122) &&
        charCode > 32
    )
        return false;
    return true;
}

function validationEmail(evt) {
    var charCode = evt.which ? evt.which : event.keyCode;
    if (
        (charCode < 65 || charCode > 90) &&
        (charCode < 97 || charCode > 122) &&
        (charCode < 48 || charCode > 57) &&
        (charCode < 64 || charCode > 64) &&
        (charCode < 46 || charCode > 46) &&
        charCode > 32
    )
        return false;
    return true;
}

// Changing name when input a photo
// var fileInput = document.getElementById("customFile");
// fileInput.addEventListener("change", changeNameInput);
// function changeNameInput() {
//     console.log(fileInput.value);
//     alert(fileInput.value);
// }
