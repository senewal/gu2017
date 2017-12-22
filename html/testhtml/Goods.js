function Goods(id, name) {
    Container.call(this, id, "badge badge-primary goods");

    this.id = id;
    this.name = name

}

Goods.prototype = Object.create(Container.prototype);
Goods.prototype.constructor = Goods;

Goods.prototype.render = function (root) {
    var goods = $("<a />", {
       href: "#",
       id: this.id,
       class: this.class
    });
    goods.append(this.name);
    root.append(goods);
};