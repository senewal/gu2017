function changeButton (div) {
    var $div = $(div);
    if ($div.hasClass('block-user')) {
        $div.removeClass('block-user')
            .addClass('un-block-user')
            .removeClass('btn-danger')
            .addClass('btn-success')
            .html('дать');
    } else {
        $div.removeClass('un-block-user')
            .addClass('block-user')
            .removeClass('btn-success')
            .addClass('btn-danger')
            .html('забрать');
    }
}

$(document).ready(function () {
    $(document).on('click', '.block-user', function () {
        var id = $(this).attr('data-share-id');
        $.post({
            url: '/share/ajaxBlockUser',
            data: { id: id },
            dataType: 'json',
            context: this,
            success: function (result) {
                if (result.result == 0) {
                    /* todo error result */
                    return false;
                }
                changeButton(this);
            }
        });
    });

    $(document).on('click', '.un-block-user', function () {
        var id = $(this).attr('data-share-id');
        $.post({
            url: '/share/ajaxUnBlockUser',
            data: { id: id },
            dataType: 'json',
            context: this,
            success: function (result) {
                if (result.result == 0) {
                    /* todo error result */
                    return false;
                }
                changeButton(this);
            }
        });
    });
});