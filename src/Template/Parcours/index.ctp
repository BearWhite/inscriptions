<h2><?= $title ?>
    <?= $this->Html->link('<i class="fa fa-plus"></i> '.__('Nouveau parcours'), ['action' => 'add'], ['class' => 'btn btn-success pull-right', 'role' => 'button', 'escape' => false]); ?>
</h2>
<hr class="colorgraph">

<table class="table table-striped" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th>Parcours</th>
            <th class="filter-select filter-exact">Mention</th>
            <th class="filter-select filter-exact">Spécialité</th>
            <th>Rang année</th>
            <th data-sorter="false" data-filter="false" class="actions">
                <?= __('Actions'); ?>
            </th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($parcours as $parcour): ?>
        <tr>
            <td><?= h($parcour->title) ?></td>
            <td>
                <?= $this->Html->link($parcour->specialite->mention->title, ['controller' => 'Mentions', 'action' => 'view', $parcour->specialite->mention->id]) ?>
            </td>
            <td>
                <?= $parcour->has('specialite') ? $this->Html->link($parcour->specialite->title, ['controller' => 'Specialites', 'action' => 'view', $parcour->specialite->id]) : '' ?>
            </td>
            <td><?= $this->Number->format($parcour->année) ?></td>
            <td class="actions">
                    <?= $this->Html->link('<i class="fa fa-eye"></i> '.__('Voir'), ['action' => 'view', $parcour->id],['class' => 'btn btn-default btn-xs', 'escape' => false]) ?>
                    <?= $this->Html->link('<i class="fa fa-pencil"></i> '.__('Modifier'), ['action' => 'edit', $parcour->id],['class' => 'btn btn-default btn-xs', 'escape' => false  ]) ?>
                    <?= $this->Form->postLink('<i class="fa fa-trash"></i>', ['action' => 'delete', $parcour->id], [ 'confirm' => __('Etes-vous sur de vouloir supprimer le parcours "{0}"?',$parcour->titre), 'class' => 'btn btn-default btn-xs','escape' => false]) ?>
            </td>
        </tr>

        <?php endforeach; ?>
    </tbody>
</table>

<?php $this->start('script'); ?>
<script>
    $("table").tablesorter({
        theme: "bootstrap",
        widthFixed: true,
        headerTemplate: '{content} {icon}',
        widgets: ["uitheme", "filter", "zebra"],
        widgetOptions: {
            zebra: ["even", "odd"],
            filter_reset: ".reset",
            filter_cssFilter: "form-control"
        }
    });
</script>
<?php $this->end(); ?>