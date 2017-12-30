<?php
$tokenUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . SHARE_LINK . '?token=' . $this->params['userData']['share_token'];
?>


<div class="row">
    <div class="col-sm-10 offset-sm-1">
        <h1>Hello,</h1>
        <h3><?= $this->params['userData']['name'] ?> <?= $this->params['userData']['surname'] ?></h3>
        <h5><?= $this->params['userData']['email'] ?></h5>
        <p style="word-break: break-all;"><b>Share link: </b><a href="<?= $tokenUrl ?>"><?= $tokenUrl ?></a></p>

        <table class="table">
            <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">доступ</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($this->params['shares'] AS $item) : ?>
                <tr>
                    <td><?=$item['name']?> <?=$item['surname']?></td>
                    <td>
                        <?php if ($item['users_share_block'] == 1) : ?>
                            <button data-share-id="<?=$item['users_share_id']?>" type="button" class="btn btn-success un-block-user">дать</button>
                        <?php else: ?>
                            <button data-share-id="<?=$item['users_share_id']?>" type="button" class="btn btn-danger block-user">забрать</button>
                        <?php endif; ?>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>



