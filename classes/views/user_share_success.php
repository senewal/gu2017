<div class="row">
    <div class="col-sm-10 offset-sm-1 mt-2">
        <div class="alert alert-success" role="alert">
            Вы успешно добавили список <?=$this->params['userShare']['name']?> <?=$this->params['userShare']['surname']?>
        </div>

        <ul>
            <li><a href="/share/list/<?=$this->params['token']?>">посмотреть список покупок, <?=$this->params['userShare']['name']?> <?=$this->params['userShare']['surname']?></a></li>
            <li><a href="/share/all">все доступны списки для меня</a></li>
            <li><a href="/">вернуть к своему списку</a></li>
        </ul>
    </div>
</div>
