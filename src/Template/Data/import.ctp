<?php
/**
 * @var \App\View\AppView $this
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Data'), ['action' => 'index']) ?></li>
    </ul>
        <li><?= $this->Html->link(__('New Data'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<?= $this->Flash->render() ?>
<div class="data form large-9 medium-8 columns content">
    <?= $this->Form->create($uploadData, ['type' => 'file']) ?>
    <fieldset>
        <legend><?= __('Import Data') ?></legend>
        <?php
            echo $this->Form->input('file' , ['type' => 'file', 'class' => 'form control']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
