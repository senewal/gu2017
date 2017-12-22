function GoodsList() {
    Container.call(this, "goods-list");

}

GoodsList.prototype = Object.create(Container.prototype);
GoodsList.prototype.constructor = GoodsList;


GoodsList.prototype.render = function () {
    $.get({
        url: "json/goods.json",
        dataType: 'json',
        success: function (data) {
            for (var i = 0; i < data.goods.length; i++) {
                var goods = new Goods(data.goods[i].id, data.goods[i].name);
                goods.render($("#goods-list-wrapper"))
            }
        },
        context: this
    })


};
