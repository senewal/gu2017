function Container(id, myClass) {
    this.id = id;
    this.class = myClass;
    this.htmlCode = '';
}

Container.prototype.render = function () {
    return this.htmlCode;
};