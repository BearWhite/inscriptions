<h2><?= $title ?>
    <?= $this->Html->link('<i class="fa fa-plus"></i> '.__('Nouvelle mention'), ['action' => 'add'], ['class' => 'btn btn-success pull-right', 'role' => 'button', 'escape' => false]); ?>
</h2>
<hr class="colorgraph">

<table class="table table-striped " cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th>Mention</th>
            <th data-sorter="false" data-filter="false" class="actions"><?= __('Actions'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($mentions as $mention): ?>
            <tr>
                <td><?= h($mention->title) ?></td>
                <td class="actions">
                    <?= $this->Html->link('<i class="fa fa-eye"></i> '.__('Voir'), ['action' => 'view', $mention->id],['class' =>'btn btn-default btn-xs', 'escape' => false]) ?>
                    <?= $this->Html->link('<i class="fa fa-pencil"></i> '.__('Modifier'), ['action' => 'edit', $mention->id], ['class' =>'btn btn-default btn-xs', 'escape' => false]) ?>
                    <?= $this->Form->postLink('<i class="fa fa-trash"></i>', ['action' => 'delete', $mention->id],['confirm' => __('Etes vous sur de vouloir supprimer # {0}?',$mention->title), 'class' =>'btn btn-default btn-xs', 'escape'=> false]) ?>
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