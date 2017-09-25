<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Data $data
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Data'), ['action' => 'edit', $data->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Data'), ['action' => 'delete', $data->id], ['confirm' => __('Are you sure you want to delete # {0}?', $data->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Data'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Data'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="data view large-9 medium-8 columns content">
    <h3><?= h($data->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($data->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Code') ?></th>
            <td><?= h($data->item_code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($data->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($data->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($data->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Body') ?></h4>
        <?= $this->Text->autoParagraph(h($data->body)); ?>
    </div>
</div>
