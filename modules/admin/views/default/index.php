<?php
$this->title = 'Админ панель';
?>

<div class="admin-default-index">
    <p class="h1"><?= $this->title ?></p>

    <div class="block-info">
        <div class="content">

            <?php foreach ($data as $name_count => $array): ?>

                <div class="block-content">
                    <p class="count" style="font-size: 20px"><b><?= $array['value'] ?></b></p>
                    <p><?= $name_count ?></p>
                </div>

            <?php endforeach; ?>

        </div>
    </div>
</div>
