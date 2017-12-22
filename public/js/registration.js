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
    form.addInput('email', new RegExp('test@test.ru'), 'email!');
    form.addInput('name', new RegExp('.+'), 'name!');
    form.addInput('surname', new RegExp('.+'), 'surname!');
    form.addInput('login', new RegExp('.+'), 'login!');
    form.addInput('password', new RegExp('.+'), 'password!');
    form.addInput('password2', new RegExp('.+'), 'password2!');
    form.eqInputs('password', 'password2', 'Error pass != pass2');
    form.autoCheck();

    $('.button').click(function () {
        if (form.check()) {
            form.send('/registration/ajaxSend', function (json) {
                if (json.result == 1) window.location.href = '/';
                else form.printError(json.errorMessage);
            });
        }
        return false;
    });

    $(".register").click(function () {
        window.location.href = '/login';
        return false;
    });

});