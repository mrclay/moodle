// you must put this in your theme...

$(function () {
    $('span.coe-show-activities').each(function () {
        var id = $(this).data('courseid'),
            src = $(this).data('src');
        $(this).text('show activities').one('click', function () {
            $(this).hide();
            $('#coe-activities-' + id).hide().load(src, function () {
                $(this).addClass('coe-activities-loaded').slideDown();
            });
        });
    });
});

