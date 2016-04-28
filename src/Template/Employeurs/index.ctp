<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Employeur'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Utilisateurs'), ['controller' => 'Utilisateurs', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Utilisateur'), ['controller' => 'Utilisateurs', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="employeurs index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('intitule') ?></th>
            <th><?= $this->Paginator->sort('upjv') ?></th>
            <th><?= $this->Paginator->sort('prive') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($employeurs as $employeur): ?>
        <tr>
            <td><?= $this->Number->format($employeur->id) ?></td>
            <td><?= h($employeur->intitule) ?></td>
            <td><?= h($employeur->upjv) ?></td>
            <td><?= h($employeur->prive) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $employeur->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $employeur->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $employeur->id], ['confirm' => __('Are you sure you want to delete # {0}?', $employeur->id)]) ?>
            </td>
        </tr>

    <?php endforeach; ?>
    </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
