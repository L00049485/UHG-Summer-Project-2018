

$(document).ready(function () {
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

    //Pagination for the review results (seen on the movie details page
    reviewsPagination();
});

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

function displayLoginErrorToast(error) {
    // show when the button is clicked
    $.toast({
        heading: 'Login Failed',
        text: error,
        showHideTransition: 'slide',
        position: 'bottom-right',
        icon: 'error',
        hideAfter: false
    });
}

//Driver tutorial - kicks off the first time someone logs in
function tutorial() {
    const driver = new Driver();
    // Define the steps for introduction
    driver.defineSteps([
        {
            element: '#txtSearch',
            popover: {
                title: 'Tutorial',
                description: 'Search for any text related to a movie. Eg. Title, Release year, actor.',
                position: 'top'
            }
        },
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
                description: 'For each card, you have various options depending on whether or not you are logged in. <span class="greenText">Green</span> colored buttons indicate that you have previously liked or rated that movie.',
                position: 'top', // can be `top`, `left`, `right`, `bottom`
            }
        },
    ]);
    // Start the introduction
    driver.start();
}

//Go to the movie details page if the user is logged in (Determined by the presence of a movie id)
function editMovie(movieId) {
    if (movieId == null) {
        $("#login-modal").modal();
    }
    else {
        window.location.href = "http://localhost:8080/moviereviewRepo/MovieReview/adminedit.php?movieid=" + movieId;
    }
}


//Pagination for the reviews if more than 10
//Courtasy of https://stackoverflow.com/questions/19605078/how-to-use-pagination-on-html-tables
function reviewsPagination() {
    $('#reviewsTable').after('<div id="nav"></div>');
    var rowsShown = 10;
    var rowsTotal = $('#reviewsTable tbody tr').length;
    var numPages = rowsTotal / rowsShown;
    $('#nav').append('Page ');
    for (i = 0; i < numPages; i++) {
        var pageNum = i + 1;
        $('#nav').append('<a href="#" rel="' + i + '">' + pageNum + '</a> ');
    }
    $('#reviewsTable tbody tr').hide();
    $('#reviewsTable tbody tr').slice(0, rowsShown).show();
    $('#nav a:first').addClass('active');
    $('#nav a').bind('click', function () {

        $('#nav a').removeClass('active');
        $(this).addClass('active');
        var currPage = $(this).attr('rel');
        var startItem = currPage * rowsShown;
        var endItem = startItem + rowsShown;
        $('#reviewsTable tbody tr').css('opacity', '0.0').hide().slice(startItem, endItem).
                css('display', 'table-row').animate({ opacity: 1 }, 300);
    });
}