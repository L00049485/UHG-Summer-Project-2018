//*************************************************************************************
//********************************Password Reset***************************************
//*************************************************************************************
//Initial Page load actions and listeners
$(document).ready(function () {

    //Onload, determine if there is a validation code in the url
    var verificationCode = getParameterByName('code');

    if (verificationCode == null) {
        $('#submitEmail').show();
        $('#submitNewPwd').hide();
    }
    else {
        checkVerificationCode(verificationCode);
    }

    //Listener for when the user clicks the button to submit their email address
    $("#btnPwdReset").click(function (e) {
        //Pick up the user email address
        var emailAddress = $('#txtEmailAddress').val();
        
        CheckUserExists(emailAddress);
    });

    //Listener for when the user enters their new email address and hits submit
    $("#btnPwdResetReal").click(function (e) {
        //Validate that the password matches in the verify box
        //Pick up the user password
        var password = $('#txtPassword').val();
        var passwordVerify = $('#txtPasswordCheck').val();

        if (password != passwordVerify) {
            $.toast({
                heading: 'Failed',
                text: "Passwords don't match.",
                showHideTransition: 'slide',
                position: 'bottom-right',
                icon: 'error',
                hideAfter: false
            });
        }
        else {
            submitNewPassword(password, verificationCode);
        }
    });   
});

//
/*************************************************************************************************
**********Name:             UpdateMovie()
**********Author:           Kieran Quinn
**********Date Modified:    2018-08-18
**********Summary:          Verify that the email address submitted actually exists
*************************************************************************************************/
function CheckUserExists(emailAddress) {
    var data;

    $.ajax({
        async: false,
        type: 'GET',
        url: 'http://localhost:8080/moviereviewRepo/MovieReview/api/CheckUserExists.php?emailAddress=' + emailAddress,
        success: function (data) {
            data = data.replace(/\n/ig, '');
            if (data == 1) {
                sendResetUrl(emailAddress);
            }
            else {
                $.toast({
                    heading: 'Failed',
                    text: emailAddress + " isn't registered as a member.",
                    showHideTransition: 'slide',
                    position: 'bottom-right',
                    icon: 'info',
                    hideAfter: false
                });

            }
        },
        //Error handling
        error: function (xhr, ajaxOptions, thrownError) {
            $.toast({
                heading: 'Failed',
                text: xhr.responseText,
                showHideTransition: 'slide',
                position: 'bottom-right',
                icon: 'error',
                hideAfter: false
            });
        }
    });
}

//Send the command to PHP to generate a random 25 alphanumeric code for this email address and add it to the database
function sendResetUrl(emailAddress) {

    $.ajax({
        async: false,
        type: 'GET',
        url: 'http://localhost:8080/moviereviewRepo/MovieReview/api/sendPwdResetCode.php?emailAddress=' + emailAddress,
        success: function (data) {
            $.toast({
                heading: 'Success',
                text: data,
                showHideTransition: 'slide',
                position: 'bottom-right',
                icon: 'success',
                hideAfter: false
            });
        },
        //Error handling
        error: function (xhr, ajaxOptions, thrownError) {
            $.toast({
                heading: 'Failed',
                text: xhr.responseText,
                showHideTransition: 'slide',
                position: 'bottom-right',
                icon: 'error',
                hideAfter: false
            });
        }
    });
}

//If the page has a verification code as a query string, check that its a valid query string. If so, show the reset password page
function checkVerificationCode(verificationCode) {
    var data;

    $.ajax({
        async: false,
        type: 'GET',
        url: 'http://localhost:8080/moviereviewRepo/MovieReview/api/checkCodeExists.php?code=' + verificationCode,
        success: function (data) {
            data = data.replace(/\n/ig, '');
            if (data == 1) {
                $('#submitEmail').hide();
                $('#submitNewPwd').show();
                $.toast({
                    heading: 'Success',
                    text: verificationCode + " is a valid verification code.",
                    showHideTransition: 'slide',
                    position: 'bottom-right',
                    icon: 'info'
                });
            }
            else {
                $.toast({
                    heading: 'Failed',
                    text: verificationCode + " isn't a valid verification code.",
                    showHideTransition: 'slide',
                    position: 'bottom-right',
                    icon: 'info',
                    hideAfter: false
                });
                $('#submitEmail').show();
                $('#submitNewPwd').hide();
            }
        },
        //Error handling
        error: function (xhr, ajaxOptions, thrownError) {
            $.toast({
                heading: 'Failed',
                text: xhr.responseText,
                showHideTransition: 'slide',
                position: 'bottom-right',
                icon: 'error',
                hideAfter: false
            });
            $('#submitEmail').show();
            $('#submitNewPwd').hide();
        }
    });
}

//send the new password and verification code to the php script
function submitNewPassword(password, verificationCode) {
    var url = 'http://localhost:8080/moviereviewRepo/MovieReview/api/updateUserPassword.php?code=' + verificationCode + '&password=' + password;

    $.ajax({
        async: false,
        type: 'GET',
        url: url,
        success: function (data) {
            data = data.replace(/\n/ig, '');
            if (data == 1) {
                //Password updated successfully
                $.toast({
                    heading: 'Success',
                    text: "Password updated successfully. Return to the <a href='default.php'>home</a> page and logon.",
                    showHideTransition: 'slide',
                    position: 'bottom-right',
                    icon: 'success',
                    hideAfter: false
                });
            }
            else {
                $.toast({
                    heading: 'Failed',
                    text: data,
                    showHideTransition: 'slide',
                    position: 'bottom-right',
                    icon: 'error',
                    hideAfter: false
                });
            }
        },
        //Error handling
        error: function (xhr, ajaxOptions, thrownError) {
            $.toast({
                heading: 'Failed',
                text: xhr.responseText,
                showHideTransition: 'slide',
                position: 'bottom-right',
                icon: 'error',
                hideAfter: false
            });
        }
    });
}

//*************************************************************************************

//For picking up query string values - https://stackoverflow.com/questions/901115/how-can-i-get-query-string-values-in-javascript
function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, '\\$&');
    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
}