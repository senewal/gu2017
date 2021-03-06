function AuthForm (errorsId) {
    this.errorsId = errorsId;
    this.form = [];
    this.eqInputsNames = [];
    this.nameToFormId = {};
    this.data = {};
}

AuthForm.prototype.viewError = function (message) {
    $(document).scrollTop(0);
    var div = $('<div />', {
        'class': 'alert alert-danger',
        'role': 'alert'
    });
    div.html(message);
    $('#' + this.errorsId).html(div);
};

AuthForm.prototype.hideError = function () {
    $('#' + this.errorsId).empty();
};

AuthForm.prototype.addInput = function (name, regExp, errorMessage) {
    this.form.push({
        name: name,
        $input: $('[name=' + name + ']'),
        regExp: regExp,
        errorMessage: errorMessage
    });
    this.nameToFormId[name] = this.form.length - 1;
};

AuthForm.prototype.eqInputs = function (name1, name2, errorMessage) {
    this.eqInputsNames.push([name1, name2, errorMessage]);
};

AuthForm.prototype.autoCheck = function (name) {
    /* feature to do */
};

AuthForm.prototype.check = function () {
    var self = this;
    var success = true;
    this.form.forEach(function (array) {
        if (!success) return false;
        var value = array.$input.val();
        if (!array.regExp.test(value)) {
            success = false;
            self.viewError(array.errorMessage);
        }
        self.data[array.name] = value;
    });
    if (success) {
        this.eqInputsNames.forEach(function (array) {
            if (!success) return false;
            var value1 = self.form[self.nameToFormId[array[0]]].$input.val();
            var value2 = self.form[self.nameToFormId[array[1]]].$input.val();
            if (value1 != value2) {
                success = false;
                self.viewError(array[2]);
            }
        });
    }
    return success;
};

AuthForm.prototype.send = function (url, callback) {
    $.ajax({
        type: 'POST',
        url: url,
        data: this.data,
        dataType: 'json',
        success: function (json) {
            callback(json);
        },
        error: function (a, b) {
            console.log(a, b);
        }
    });
};

