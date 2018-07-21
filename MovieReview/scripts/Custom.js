﻿$(document).ready(function () {

    var tinymceExists = document.getElementById("txtDesc");
    //Text editor for the forms
    if (tinymceExists) {
        tinymce.init({
            selector: 'textarea',
            height: 250,
            theme: 'modern',
            plugins: 'print preview fullpage searchreplace autolink directionality visualblocks visualchars fullscreen link template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools contextmenu colorpicker textpattern help',
            toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
            image_advtab: true,
            templates: [
              { title: 'Test template 1', content: 'Test 1' },
              { title: 'Test template 2', content: 'Test 2' }
            ],
            content_css: [
              '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
              '//www.tinymce.com/css/codepen.min.css'
            ]
        });
    }

    //Use a different background image each time the page is loaded
    $(function () {
        var images = ['Background1.jpg', 'Background2.jpg', 'Background3.png', 'Background4.jpg', 'Background5.jpg', 'Background7.jpg', 'Background8.jpg', 'Background9.jpg', 'Background10.jpg', 'Background11.jpg', 'Background12.jpg', 'Background13.png', 'Background14.jpg', 'Background15.jpeg', 'Background16.jpg', 'Background17.jpg', 'Background18.jpg', 'Background19.jpg', 'Background20.png'];
        $('.jumbotron').css({ 'background-image': 'url(./images/' + images[Math.floor(Math.random() * images.length)] + ')' });
    });

    //Actions for adding a new movie
    $("#btnSubmitAddMovie").click(function () {
        var files = $('#images').fileinput('getFileStack');
        var actors = $('#Actors').val();
        var imagesString = "";
        for (i = 0; i < files.length; ++i) {
            imagesString += 'images/posters/' + files[i].name + ',';
        }

        //remove the last comma
        imagesString = imagesString.substring(0, imagesString.length - 1);

        //send the text to a hidden text box to be picked up by the php
        $('#txtImages').val(imagesString);

        //Send the list of actors to a hidden text box to be picked up by the php
        $('#txtActors').val(actors);
    });
});


function trackLike(movieId) {
    if (movieId == null) {
        alert("You must login to Like a movie");
    }
    else {
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var buttonId = "#" + movieId;
                $(buttonId).addClass('btn-outline-success').removeClass('btn-outline-secondary');
                document.getElementById(movieId).setAttribute("onclick", "javascript: trackUnLike(this.value);");
                document.getElementById(movieId).setAttribute("Title", "You already like this movie");
                
                $(buttonId).fadeIn(1000).fadeOut(1000).fadeIn(1000);
            }
        };
        xmlhttp.open("GET", "processLike.php?movieId=" + movieId, true);
        xmlhttp.send();
    }
}
function trackUnLike(movieId) {
    if (movieId == null) {
        alert("You must login to Un-Like a movie");
    }
    else {
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {                
                var buttonId = "#" + movieId;
                $(buttonId).addClass('btn-outline-secondary').removeClass('btn-outline-success');
                document.getElementById(movieId).setAttribute("onclick", "javascript: trackLike(this.value);");
                document.getElementById(movieId).setAttribute("Title", "Click here to like this movie");

                $(buttonId).fadeIn(1000).fadeOut(1000).fadeIn(1000);
            }
        };
        xmlhttp.open("GET", "processUnLike.php?movieId=" + movieId, true);
        xmlhttp.send();
    }
}
function displayLoginToast() {
    tutorial();

    // show when the button is clicked
    $.toast({
        heading: 'Success',
        text: 'You have been logged in.',
        showHideTransition: 'slide',
        position: 'bottom-right',
        icon: 'success'
    });
}

//Driver tutorial - kicks off the first time someone logs in
function tutorial() {
    const driver = new Driver();
    // Define the steps for introduction
    driver.defineSteps([
      {
          element: '#movieCard1',
          popover: {
              title: 'Tutorial',
              description: 'Each movie has its own card',
              position: 'top'
          }
      },
      {
          element: '#movieBtnGroup1',
          popover: {
              title: 'Tutorial',
              description: 'For each card, you have various options depending on whether or not you are logged in',
              position: 'top', // can be `top`, `left`, `right`, `bottom`
          }
      },
    ]);
    // Start the introduction
    driver.start();
}