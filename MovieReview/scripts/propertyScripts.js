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

$(document).ready(function () {
    //Price slider
    var stepSlider = document.getElementById('slider');
    var stepSliderValueElement = document.getElementById('slider-step-value');
    noUiSlider.create(stepSlider, {
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
    stepSlider.noUiSlider.on('update', function (values, handle) {
        stepSliderValueElement.innerHTML = '  €' + values[handle];
    });
    
    var searchCriteria = getUrlVars();

    $("#results").show();
    $('#town').val(searchCriteria.town).trigger('chosen:updated');
    $('#county').val(searchCriteria.county).trigger('chosen:updated');
    $('#bedrooms').val(searchCriteria.bedrooms).trigger('chosen:updated');
    $('#type').val(searchCriteria.type).trigger('chosen:updated');
    searchCriteria.buyRent = searchCriteria.buyRent.replace("%20", " ");
    $('#buyRent').val(searchCriteria.buyRent).trigger('chosen:updated');
    slider.noUiSlider.set(searchCriteria.maxPrice);
});