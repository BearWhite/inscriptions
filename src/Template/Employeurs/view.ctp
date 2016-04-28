<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Employeur'), ['action' => 'edit', $employeur->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Employeur'), ['action' => 'delete', $employeur->id], ['confirm' => __('Are you sure you want to delete # {0}?', $employeur->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Employeurs'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Employeur'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Utilisateurs'), ['controller' => 'Utilisateurs', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Utilisateur'), ['controller' => 'Utilisateurs', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="employeurs view large-10 medium-9 columns">
    <h2><?= h($employeur->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Intitule') ?></h6>
            <p><?= h($employeur->intitule) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($employeur->id) ?></p>
        </div>
        <div class="large-2 columns booleans end">
            <h6 class="subheader"><?= __('Upjv') ?></h6>
            <p><?= $employeur->upjv ? __('Yes') : __('No'); ?></p>
            <h6 class="subheader"><?= __('Prive') ?></h6>
            <p><?= $employeur->prive ? __('Yes') : __('No'); ?></p>
        </div>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Utilisateurs') ?></h4>
    <?php if (!empty($employeur->utilisateurs)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Prenom') ?></th>
            <th><?= __('Nom') ?></th>
            <th><?= __('Identifiant') ?></th>
            <th><?= __('Motdepasse') ?></th>
            <th><?= __('Actif') ?></th>
            <th><?= __('Email') ?></th>
            <th><?= __('Telephone') ?></th>
            <th><?= __('Role Id') ?></th>
            <th><?= __('Parcour Id') ?></th>
            <th><?= __('Statut Id') ?></th>
            <th><?= __('Employeur Id') ?></th>
            <th><?= __('Nouveau') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($employeur->utilisateurs as $utilisateurs): ?>
        <tr>
            <td><?= h($utilisateurs->id) ?></td>
            <td><?= h($utilisateurs->prenom) ?></td>
            <td><?= h($utilisateurs->nom) ?></td>
            <td><?= h($utilisateurs->identifiant) ?></td>
            <td><?= h($utilisateurs->motdepasse) ?></td>
            <td><?= h($utilisateurs->actif) ?></td>
            <td><?= h($utilisateurs->email) ?></td>
            <td><?= h($utilisateurs->telephone) ?></td>
            <td><?= h($utilisateurs->role_id) ?></td>
            <td><?= h($utilisateurs->parcour_id) ?></td>
            <td><?= h($utilisateurs->statut_id) ?></td>
            <td><?= h($utilisateurs->employeur_id) ?></td>
            <td><?= h($utilisateurs->nouveau) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Utilisateurs', 'action' => 'view', $utilisateurs->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Utilisateurs', 'action' => 'edit', $utilisateurs->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Utilisateurs', 'action' => 'delete', $utilisateurs->id], ['confirm' => __('Are you sure you want to delete # {0}?', $utilisateurs->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
