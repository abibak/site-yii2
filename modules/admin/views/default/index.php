<?php
$this->title = 'Админ панель';
?>

<div class="admin-default-index">
    <p class="h1"><?= $this->title ?></p>

    <div class="block-info">
        <div class="content">

            <?php foreach ($data as $data_count => $array): ?>

                <div class="block-content count-users">
                    <p class="count" style="font-size: 20px"><b><?= $array['value'] ?></b></p>
                    <p><?= $array['name'] ?></p>
                </div>

            <?php endforeach; ?>

        </div>
    </div>
</div>
