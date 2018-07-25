//*************************************************************************************
//********************************Member Registration**********************************
//*************************************************************************************

$("#btnSubmitRegister").click(function (e) {
    e.preventDefault();
    registerMember();
});

function registerMember() {

    //TODO: Add code to check password validation
    var datastring = $("#registrationForm").serialize();
    $.ajax({
        type: "POST",
        url: "http://localhost:8080/moviereviewRepo/MovieReview/api/processRegistration.php",
        data: datastring,
        dataType: "json",
        success: function (data) {
            // show when the button is clicked
            $.toast({
                heading: 'Registration',
                text: data,
                showHideTransition: 'slide',
                position: 'bottom-right',
                icon: 'success'
            });

            var delay = 3000;
            $('#registrationForm').hide(1000);
            setTimeout(function () { window.location = "./default.php"; }, delay);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            $.toast({
                heading: 'Registration Failed',
                text: xhr.responseText,
                showHideTransition: 'slide',
                position: 'bottom-right',
                icon: 'error',
                hideAfter: false
            });
        }
    });
}