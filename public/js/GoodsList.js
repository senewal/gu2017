function GoodsList() {
    Container.call(this, "goods-list");
    this.find();
}

GoodsList.prototype = Object.create(Container.prototype);
GoodsList.prototype.constructor = GoodsList;

GoodsList.prototype.appendToList = function (good, className) {
    $("." + className).append(function () {
        var item = $("<div />", {
            id: good.id,
            class: "buy-list-item"
        });

        var label = $("<label />", {
            class: "custom-control custom-checkbox"
        });

        label.append("<input type=\"checkbox\" class=\"custom-control-input\">");
        label.append("<span class=\"custom-control-indicator\"></span>");
        label.append("<span class=\"custom-control-description\">" + good.name +"</span>");
        label.appendTo(item);
        return item
    });
};

GoodsList.prototype.appendToListHistory = function (good, className) {
    $("." + className).append(function () {
        var item = $("<div />", {
            id: good.id,
            class: "buy-list-item"
        });

        var label = $("<label />", {
            class: "custom-control custom-checkbox"
        });

        label.append("<input type=\"checkbox\" class=\"custom-control-input\" checked disabled>");
        label.append("<span class=\"custom-control-indicator\"></span>");
        label.append("<span class=\"custom-control-description\">" + good.name +"</span>");
        label.appendTo(item);
        return item
    });
};

GoodsList.prototype.find = function () {
    var self = this;
    $('#good-list-find').val('').on('keyup', function () {
        self.render($(this).val());
    });
    $('#good-list-find-reset').on('click', function (e) {
        $(this).val('');
        self.render($(this).val());
    });
};

GoodsList.prototype.render = function (search) {
    $("#goods-list-wrapper").empty();
    search = search || '';
    $.get({
        url: "/main/ajaxGetFindProductsList",
        data: { search: search },
        dataType: 'json',
        success: function (data) {
            for (var i = 0; i < data.goods.length; i++) {
                var goods = new Goods(data.goods[i].id, data.goods[i].name);
                goods.render($("#goods-list-wrapper"))
            }
        },
        context: this
    });
};
