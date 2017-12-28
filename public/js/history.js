$(document).ready(function () {
    $('#add-list-item').on('click', function () {
        $('#search-list-item').modal('show')
    });

    var goodsList = new GoodsList();
    goodsList.render();

    $.get({
        url: '/main/ajaxGetInactiveUserProducts',
        dataType: 'json',
        success: function (result) {
            if (result.result == 0) {
                /* todo error */
                return false;
            }
            result.goods.forEach(function (good) {
                goodsList.appendToListHistory(good, 'buy-list');
            });
        }
    });

});