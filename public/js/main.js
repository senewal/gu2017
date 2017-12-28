$(document).ready(function () {
    $('#add-list-item').on('click', function () {
        $('#search-list-item').modal('show')
    });

    var goodsList = new GoodsList();
    goodsList.render();

    $.get({
        url: '/main/ajaxGetActiveUserProducts',
        dataType: 'json',
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
            url: '/main/ajaxChangeUserProductStatus',
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

    $(document).on("click", ".goods", function () {
        var id = $(this).attr('id');
        var name = $(this).text();
        $.post({
            url: '/main/ajaxAddUserProduct',
            data: {
                productId: id
            },
            dataType: 'json',
            success: function (result) {
                if (result.result == 0) {
                    /* todo create view error */
                    return false;
                }
                id = result.id;
                goodsList.appendToList({id: id, name: name}, 'buy-list');
            }
        });

    });
});