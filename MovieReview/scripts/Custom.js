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
        var images = ['Background1.jpg', 'Background2.jpg', 'Background3.png', 'Background4.jpg', 'Background5.jpg', 'Background7.jpg', 'Background8.jpg', 'Background9.jpg', 'Background10.jpg', 'Background11.jpg', 'Background12.jpg', 'Background13.png', 'Background14.jpg', 'Background15.jpeg'];
        $('.jumbotron').css({ 'background-image': 'url(./images/' + images[Math.floor(Math.random() * images.length)] + ')' });
    });
});