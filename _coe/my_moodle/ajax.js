// you must put this in your theme...

$(function() {
    function text(visible) {
        return (visible ? 'hide' : 'show') + ' activities';
    }
    $('span.coe-show-activities').each(function () {
        var $button = $(this),
            id = $button.data('courseid'),
            src = $button.data('src'),
            $content = $('#coe-activities-' + id),
            shown = 0;
        $button.text(text(shown)).one('click', function () { // only first click
            $content.hide().load(src, function () {
                $content.addClass('coe-activities-loaded').slideDown();
                shown = 1;
                $button.text(text(shown));
                $button.click(function () { // all clicks
                    $content[shown ? 'hide' : 'show']();
                    shown = !shown;
                    $button.text(text(shown));
                });
            });
        });
    });
});
