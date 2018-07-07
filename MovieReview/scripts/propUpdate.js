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
    var vars = getUrlVars();
    if (vars.propID === undefined)
        $(".hide").hide();
    else {
        $('#propertyid').val(vars.propID).trigger('chosen:updated');
        populateFields();
    }

    $("#propertyid").chosen().change(function () {
        $(".hide").show();
        var idSelected = $("#propertyid").chosen().val();
        var url = "http://localhost/axeproperty/adminUpdate.php?propID=" + idSelected;

        window.location.href = url;
    });
});

function populateFields() {
    $('#txtTownForm').val($('#txtTownHidden').val());
    $('#txtCountyForm').val($('#txtCountyHidden').val());
    $('#txtpropAddress').val($('#txtAddressHidden').val());
    $('#txtMapLink').val($('#txtMapLinkHidden').val());
    $('#txtPrice').val($('#txtPriceHidden').val());
    $('#txtSize').val($('#txtSizeHidden').val());

    $('#txtShortDesc').val($('#txtShortDescHidden').val());
    $('#txtLongDesc').val($('#txtLongDescHidden').val());

    $('#featured').val($('#txtFeaturedHidden').val()).trigger('chosen:updated');
    $('#status').val($('#txtStatusHidden').val()).trigger('chosen:updated');
    $('#vendor').val($('#txtVendorHidden').val()).trigger('chosen:updated');
    $('#bedrooms').val($('#txtBedroomsHidden').val()).trigger('chosen:updated');
    $('#bathrooms').val($('#txtBathroomsHidden').val()).trigger('chosen:updated');
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