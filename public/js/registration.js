$(document).ready(function() {
    var authForm = new AuthForm('errors');
    authForm.addInput('email', new RegExp('^([a-zA-Z0-9\\-_]+\\.)*[a-zA-Z0-9\\-_]+@[a-zA-Z0-9\\-_]+\\.[a-z]{2,6}$'), 'Введите email!');
    authForm.addInput('name', new RegExp('.+'), 'Введите имя!');
    authForm.addInput('surname', new RegExp('.+'), 'Введите фамилию!');
    authForm.addInput('login', new RegExp('.+'), 'Введите логин!');
    authForm.addInput('password', new RegExp('.+'), 'Введите пароль!');
    authForm.addInput('password2', new RegExp('.+'), 'Введите пароль еще раз!');
    authForm.eqInputs('password', 'password2', 'Пароль первый и пароль второй должны быть одинаковые!');
    authForm.autoCheck();

    $('#registerBtn').click(function () {
        if (authForm.check()) {
            authForm.send('/registration/ajaxSend', function (json) {
                if (json.result == 1) window.location.href = '/';
                else authForm.viewError(json.errorMessage);
            });
        }
        return false;
    });

    $("#loginBtn").click(function () {
        window.location.href = '/login';
        return false;
    });

});