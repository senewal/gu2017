$(function () {

    $('table input[type=checkbox]').on('click', function () {
        var $this = $(this);

        var $tr = $this.parents('tr');

        if (this.checked) {
            $tr.removeClass('row1');
            $tr.addClass('rowcheck');
        } else {
            $tr.removeClass('rowcheck');
            $tr.addClass('row1');
        }

    });

    $('table tr').click(function (event) {
        if (event.target.type !== 'checkbox') {
            $(':checkbox', this).click();
        }
    });

});