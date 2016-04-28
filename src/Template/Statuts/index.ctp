<h2>Liste des statuts
    <?= $this->Html->link('<i class="fa fa-plus"></i> '.__('Nouveau statut'), ['action' => 'add'], ['class' => 'btn btn-success pull-right', 'role' => 'button', 'escape' => false]); ?>
</h2>
<hr class="colorgraph">


    <table class="table table-striped" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th>Intitulé</th>
                <th>Heures Max</th>
                <th>Type d'enseignement</th>
                <th class="actions"><?= __('Actions'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($statuts as $statut): ?>
            <tr>
                <td><?= h($statut->intitule) ?></td>
                <td><?= h($statut->heuresmax) ?></td>
                <td><?= h($statut->typeenseignement) ?></td>
                <td class="actions">
                    <?= $this->Html->link('<i class="fa fa-eye"></i> '.__('Voir'), [ 'action' => 'view', $statut->id], ['class'=> 'btn btn-default btn-xs','escape' => false]) ?>
                    <?= $this->Html->link('<i class="fa fa-pencil"></i> '.__('Modifier'), ['action' => 'edit', $statut->id], ['class'=> 'btn btn-default btn-xs','escape' => false]) ?>
                    <?= $this->Form->postLink('<i class="fa fa-trash"></i> '.__('Supprimer'), ['action' => 'delete', $statut->id], ['confirm' => __('Êtes vous sûr(e) de vouloir supprimer le statut # {0}?', $statut->id), 'class'=> 'btn btn-default btn-xs','escape' => false]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
