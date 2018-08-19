//*************************************************************************************
//********************************Member Registration**********************************
//*************************************************************************************

$("#registrationForm").submit(function (e) {
    e.preventDefault();
    if ($('#registrationForm')[0].checkValidity())
        RegisterMember();
});



/*************************************************************************************************
**********Name:             RegisterMember()
**********Author:           Kieran Quinn
**********Date Modified:    2018-08-18
**********Summary:          Serializes the registration form and POST it to the PHP 
                            script handler for registering a new member
*************************************************************************************************/
function RegisterMember() {
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

            //Display the user notification for 3 seconds, then redirects the page back to home
            var delay = 3000;
            $('#registrationForm').hide(1000);
            setTimeout(function () { window.location = "./default.php"; }, delay);
        },
        //Error handling
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