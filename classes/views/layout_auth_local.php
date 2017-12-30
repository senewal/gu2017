<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?=$this->params['title']?></title>
<!--    <link href="css/style.css" rel="stylesheet" type="text/css" />-->
    <?php foreach ($this->params['styles'] as $key => $href) : ?>
        <link rel="stylesheet" href="<?=$href?>">
    <?php endforeach; ?>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script>
    <link rel="icon" href="http://vladmaxi.net/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="http://vladmaxi.net/favicon.ico" type="image/x-icon">
    <?php foreach ($this->params['scripts'] as $key => $src) : ?>
        <script src="<?=$src?>"></script>
    <?php endforeach; ?>
</head>
<body>
    <div class="content-main"></div>
</body>
</html>