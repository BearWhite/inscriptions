<h2><?= $title ?>
    <?= $this->Html->link('<i class="fa fa-plus"></i> '.__('Nouvelle Spécialité'), ['action' => 'add'], ['class' => 'btn btn-success pull-right', 'role' => 'button', 'escape' => false]); ?>
</h2>
<hr class="colorgraph">

<table class="table table-striped" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
                        <th>Spécialité</th>
                        <th class="filter-select filter-exact">Mention</th>
                        <th data-sorter="false" data-filter="false" class="actions"><?= __('Actions'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($specialites as $specialite): ?>
            <tr>
                <td><?= h($specialite->title) ?></td>
                <td>
                    <?= $specialite->has('mention') ? $this->Html->link($specialite->mention->title, ['controller' => 'Mentions', 'action' => 'view', $specialite->mention->id]) : '' ?>
                </td>
                <td class="actions">
                    <?= $this->Html->link('<i class="fa fa-eye"></i> '.__('Voir'), ['action' => 'view', $specialite->id],['class' => 'btn btn-default btn-xs','escape' => false]) ?>
                    <?= $this->Html->link('<i class="fa fa-pencil"></i> '.__('Modifier'), ['action' => 'edit', $specialite->id],['class' => 'btn btn-default btn-xs','escape'=> false]) ?>
                    <?= $this->Form->postLink('<i class="fa fa-trash"></i> ', ['action' => 'delete', $specialite->id], ['confirm' => __('Etes-vous sur de vouloir supprimer la spécialité "{0}"?', $specialite->title), 'class' => 'btn btn-default btn-xs','escape'=>false]) ?>
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