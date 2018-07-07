$(document).ready(function () {
    //$('.simple-select').chosen({ width: "210px" });
    $(".simple-select").chosen({ no_results_text: "Oops, nothing found!", width: "210px" });

    //Search box in the header of the page
    $("#btnSubmitHeader").click(function () {
        var town = $("#txtTown").val();
        var county = $("#txtCounty").val();
        var maxPrice = sliderSmall.noUiSlider.get();
        maxPrice = maxPrice.replace(',', '');
        var url = "http://localhost/axeproperty/property.php?";

        if (town != '')
            url = url + "&town=" + town;
        if (county != '')
            url = url + "&county=" + county;
        if (maxPrice > 1)
            url = url + "&maxPrice=" + maxPrice;

        window.location.href = url;
    });

    //Search box in the body of the property page
    $("#btnSubmit").click(function () {
        var town = $("#town").chosen().val();
        var county = $("#county").chosen().val();
        var bedrooms = $("#bedrooms").chosen().val()
        var type = $("#type").chosen().val();
        var buyRent = $("#buyRent").chosen().val();
        var maxPrice = slider.noUiSlider.get();
        maxPrice = maxPrice.replace(',', '');
        var url = "http://localhost/axeproperty/property.php?searchType=1";

        if (town != '')
            url = url + "&town=" + town;
        if (county != '')
            url = url + "&county=" + county;
        if (bedrooms != '')
            url = url + "&bedrooms=" + bedrooms;
        if (type != '')
            url = url + "&type=" + type;
        if (buyRent != '')
            url = url + "&buyRent=" + buyRent;
        if (maxPrice > 1)
            url = url + "&maxPrice=" + maxPrice;

        window.location.href = url;
    });

    //Header section - sliders
    var stepSliderSmall = document.getElementById('sliderSmall');
    var stepSliderSmallValueElement = document.getElementById('sliderSmall-step-value');
    noUiSlider.create(stepSliderSmall, {
        start: [1000],
        step: 10000,
        format: wNumb({
            decimals: 0,
            thousand: ','
        }),
        range: {
            'min': [0],
            'max': [500000]
        }
    });
    stepSliderSmall.noUiSlider.on('update', function (values, handle) {
        stepSliderSmallValueElement.innerHTML = '  €' + values[handle];
    });

    //Text editor for the forms
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
});

//For changing the image on the main viewer
function swap(image) {
    document.getElementById("main").src = image.href;
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
