<h2>Liste des périodes
    <?= $this->Html->link('<i class="fa fa-plus"></i> '.__('Nouvelle période'), ['action' => 'add'], ['class' => 'btn btn-success pull-right', 'role' => 'button', 'escape' => false]); ?>
</h2>
<hr class="colorgraph">


    <table class="table table-striped" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th>Intitulé administrateur</th>
                <th>Nb. options</th>
                <th>Date de début</th>
                <th>Date de fin</th>
                <th>Ouverture des choix</th>
                <th>Fermeture des choix</th>
                <th class="actions"><?= __('Actions'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($periodes as $periode): ?>
            <tr>
                <td><?= h($periode->title) ?></td>
                <td><?= h($periode->nb_options) ?></td>
                <td><?= h($periode->date_debut) ?></td>
                <td><?= h($periode->date_fin) ?></td>
                <td><?= h($periode->date_debut_choix) ?></td>
                <td><?= h($periode->date_fin_choix) ?></td>
                <td class="actions">
                    <?= $this->Html->link('<i class="fa fa-eye"></i> '.__('Voir'), [ 'action' => 'view', $periode->id], ['class'=> 'btn btn-default btn-xs','escape' => false]) ?>
                    <?= $this->Html->link('<i class="fa fa-pencil"></i> '.__('Modifier'), ['action' => 'edit', $periode->id], ['class'=> 'btn btn-default btn-xs','escape' => false]) ?>
                    <?= $this->Form->postLink('<i class="fa fa-trash"></i> '.__('Supprimer'), ['action' => 'delete', $periode->id], ['confirm' => __('Êtes vous sûr(e) de vouloir supprimer la période # {0}?', $periode->id), 'class'=> 'btn btn-default btn-xs','escape' => false]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
