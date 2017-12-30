var viewLogTimeout = null;
var VIEW_LOG_HIDE_TIME = 6 * 1000; // 6s

function viewLog (status, message) {
    clearTimeout(viewLogTimeout);
    $(document).scrollTop(0);
    var div = $('<div />', {
        'class': 'alert alert-' + status,
        'role': 'alert'
    });
    div.html(message);
    $('#logs').html(div);
    viewLogTimeout = setTimeout(function () {
        $('#logs').empty();
    }, VIEW_LOG_HIDE_TIME);
}

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
                viewLog('success', 'Продукт добавлен к списку!')
            }
        });

    });

    $(document).on('click', '#good-list-add', function () {
        var name = $('#good-list-find').val();
        if (name.length < 2) return false;
        $.post({
            url: '/main/ajaxAddNewProduct',
            data: {
                name: name
            },
            dataType: 'json',
            success: function (result) {
                if (result.result == 0) {
                    /* todo create view error */
                    return false;
                }
                var id = result.id;
                var goods = new Goods(id, name);
                goods.render($("#goods-list-wrapper"));
                goodsList.appendToList({id: id, name: name}, 'buy-list');
                viewLog('success', 'Продукт добавлен к списку!')
            }
        });
    });
});