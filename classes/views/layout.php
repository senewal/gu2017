<?php

$nowPage = $_SERVER['REQUEST_URI'];
$navigation = array(
    '/' => 'Мои покупки',
    '/main/history' => 'История покупок',
    '/about' => 'О проекте'
);

if ($this->params['isLogin']) {
    $navigation['/share/all'] = 'Share lists';
    $navigation['/user'] = $this->params['userData']['name'] . ' ' . $this->params['userData']['surname'];
    $navigation['/login/out'] = 'Logout';
} else {
    $navigation['/login'] = 'Авторизация';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?=$this->params['title']?></title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css"
          integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <?php foreach ($this->params['styles'] as $key => $href) : ?>
        <link rel="stylesheet" href="<?=$href?>">
    <?php endforeach; ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"
            integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh"
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"
            integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ"
            crossorigin="anonymous"></script>
    <?php foreach ($this->params['scripts'] as $key => $src) : ?>
        <script src="<?=$src?>"></script>
    <?php endforeach; ?>
</head>
<body>
<div class="container-fluid">
    <header>
        <nav class="navbar navbar-expand-xl navbar-dark bg-primary">
            <a class="navbar-brand" href="#">BuyList</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                    aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <?php foreach ($navigation as $href => $label) : ?>
                        <?php if ($href == $nowPage) : ?>
                            <a class="nav-item nav-link active" href="<?=$href?>"><?=$label?> <span class="sr-only">(current)</span></a>
                        <?php else : ?>
                            <a class="nav-item nav-link" href="<?=$href?>"><?=$label?></a>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </nav>
    </header>
    <main><div class="content-main"></div></main>
    <footer></footer>
</div>

</body>
</html>