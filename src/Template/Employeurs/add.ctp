<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('List Employeurs'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Utilisateurs'), ['controller' => 'Utilisateurs', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Utilisateur'), ['controller' => 'Utilisateurs', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="employeurs form large-10 medium-9 columns">
    <?= $this->Form->create($employeur) ?>
    <fieldset>
        <legend><?= __('Add Employeur') ?></legend>
        <?php
            echo $this->Form->input('intitule');
            echo $this->Form->input('upjv');
            echo $this->Form->input('prive');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
