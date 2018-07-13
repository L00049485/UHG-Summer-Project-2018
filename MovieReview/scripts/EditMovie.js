$(document).ready(function () {
    $("#btnSubmitUpdProp").click(function () {
        var files = $('#images').fileinput('getFileStack');
        var imagesString = "";
        for (i = 0; i < files.length; ++i) {
            imagesString += 'images/houses/' + files[i].name + ',';
        }

        //remove the last comma
        imagesString = imagesString.substring(0, imagesString.length - 1);

        //send the text to a hidden text box to be picked up by the php
        $('#txtImages').val(imagesString);
    });


    //Check the query string for a property ID, if there, show the form, filled in and select that property from the drop down 
    populateFields();
});

function populateFields() {
    $('#txtMovieTitle').val($('#txtTitleHidden').val());
    $('#txtReleaseDate').val($('#txtReleaseDateHidden').val());
    $('#txtDesc').val($('#txtDescriptionHidden').val());
    $('#txtTrailer').val($('#txtTrailerHidden').val());

    //txtActorsHidden

    $('#genre').val($('#txtGenreIdHidden').val()).trigger('chosen:updated');

    $('#type').val($('#txtTypeHidden').val()).trigger('chosen:updated');
}

function getUrlVars() {
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for (var i = 0; i < hashes.length; i++) {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}