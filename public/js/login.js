/*
$.fn.myFocus = function (className) {
    $(this).focus(function () {
        $('.' + className).css("left","-48px");
    }).blur(function () {
        $('.' + className).css("left","0px");
    });
};

$(document).ready(function() {
    $('.username').myFocus('user-icon');
    $('.password').myFocus('pass-icon');

    var form = new AuthForm();
    form.addInput('login', new RegExp('.+'), 'login!');
    form.addInput('password', new RegExp('.+'), 'password!');
    form.autoCheck();

    $('.button').click(function () {
        if (form.check()) {
            form.send('/login/ajaxSend', function (json) {
                if (json.result == 1) window.location.href = '/';
                else form.printError(json.errorMessage);
            });
        }
        return false;
    });

    $(".register").click(function () {
        window.location.href = '/registration';
        return false;
    });

});*/

$(document).ready(function () {
    var authForm = new AuthForm('errors');
    authForm.addInput('login', new RegExp('.+'), 'Введите логин!');
    authForm.addInput('password', new RegExp('.+'), 'Введите пароль!');
    authForm.autoCheck();

    $('#loginBtn').click(function () {
        if (authForm.check()) {
            authForm.send('/login/ajaxSend', function (json) {
                if (json.result == 1) window.location.href = '/';
                else authForm.viewError(json.errorMessage);
            });
        }
        return false;
    });

    $("#registerBtn").click(function () {
        window.location.href = '/registration';
        return false;
    });
});