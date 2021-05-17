<?php
$this->title = 'Админ панель';
?>

<style>
    #main {
        background: none #333;
    }
</style>

<div class="admin-default-index">
    <p class="title"><?= $this->title ?></p>
    <p>
        This is the view content for action "<?= $this->context->action->id ?>".
        The action belongs to the controller "<?= get_class($this->context) ?>"
        in the "<?= $this->context->module->id ?>" module.
    </p>
    <p>
        You may customize this page by editing the following file:<br>
        <code><?= __FILE__ ?></code>
    </p>
</div>
