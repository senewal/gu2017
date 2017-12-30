$(document).ready(function () {
    var goodsList = new GoodsList();
    goodsList.render();

    $.get({
        url: '/share/ajaxGetActiveUserProducts',
        dataType: 'json',
        data: {
            share_token: window.location.pathname.split('/').slice(-1)[0]
        },
        success: function (result) {
            if (result.result == 0) {
                /* todo error */
                return false;
            }
            result.goods.forEach(function (good) {
                goodsList.appendToList(good, 'buy-list');
            });
        }
    });

    $('.buy-list').on('change', '.custom-control-input', function () {
        var $div = $(this).parent().parent();
        var id = $div.attr('id');
        $.post({
            url: '/share/ajaxChangeUserProductStatus',
            data: {
                id: id,
                statusId: 0
            },
            dataType: 'json',
            success: function (result) {
                if (result.result == 0) {
                    /* todo error */
                    return false;
                }
                $div.remove();
            }
        })
    });
});