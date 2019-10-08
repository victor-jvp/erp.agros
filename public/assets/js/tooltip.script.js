$(document).ready(function () {
    $(function () {
        // $('[data-toggle="tooltip"]').tooltip();
        $('body').tooltip({selector: '[data-toggle="tooltip"]'});
    });
    $('#manual').on('click', function () {
        $(this).tooltip('toggle')
    });
});