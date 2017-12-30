<div class="row">
    <div class="col-sm-10 offset-sm-1 mt-2">
        <?php if (count($this->params['shares']) == 0) : ?>
            <div class="alert alert-warning" role="alert">
                У вас нету доступных списков друзей
            </div>
        <?php else : ?>
            <table class="table">
                <tbody>
                <?php foreach ($this->params['shares'] AS $item) : ?>
                    <tr>
                        <td><?= $item['name'] ?> <?= $item['surname'] ?></td>
                        <td><a class="btn btn-primary" href="/share/list/<?= $item['share_token'] ?>"
                               role="button">перейти к списку</a></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>