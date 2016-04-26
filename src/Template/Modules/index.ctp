<h2><?= $title ?>
    <?= $this->Html->link('<i class="fa fa-plus"></i> '.__('Nouveau module'), ['action' => 'add'], ['class' => 'btn btn-success pull-right', 'role' => 'button', 'escape' => false]); ?>
</h2>
<hr class="colorgraph">

<table id="modules" class="table tablesorter table-striped" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th data-placeholder="filtrer...">Code</th>
            <th data-placeholder="tapez pour filtrer...">Titre du module</th>
            <th data-placeholder="">Nb. groupes</th>
            <th data-sorter="false" class="actions filter-false"><?= __('Actions'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($modules as $module): ?>
        <tr>
            <td><?= h($module->code) ?></td>
            <td><?= h($module->title) ?></td>
            <td><?= h(count($module->groupes)) ?></td>
            <td class="actions">
                <?= $this->Html->link('<i class="fa fa-cubes"></i> '.__('Gérer les groupes'), ['action' => 'view', $module->id], ['class' => 'btn btn-default btn-xs', 'escape' => false]) ?>
                <?= $this->Html->link('<i class="fa fa-pencil"></i> '.__('Modifier'), ['action' => 'edit', $module->id], ['class' => 'btn btn-default btn-xs', 'escape' => false]) ?>
                <?= $this->Form->postLink('<i class="fa fa-trash"></i>', ['action' => 'delete', $module->id], ['confirm' => __('Are you sure you want to delete # {0}?', $module->id), 'class' => 'btn btn-default btn-xs', 'escape' => false]) ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php $this->start('script'); ?>
<script>
    $("table.tablesorter").tablesorter({
        // this will apply the bootstrap theme if "uitheme" widget is included
        // the widgetOptions.uitheme is no longer required to be set
        theme : "bootstrap",

        widthFixed: true,

        headerTemplate : '{content} {icon}', // new in v2.7. Needed to add the bootstrap icon!

        // widget code contained in the jquery.tablesorter.widgets.js file
        // use the zebra stripe widget if you plan on hiding any rows (filter widget)
        widgets : [ "uitheme", "filter", "zebra" ],

        widgetOptions : {
            // using the default zebra striping class name, so it actually isn't included in the theme variable above
            // this is ONLY needed for bootstrap theming if you are using the filter widget, because rows are hidden
            zebra : ["even", "odd"],

            // reset filters button
            filter_reset : ".reset",

            // extra css class name (string or array) added to the filter element (input or select)
            filter_cssFilter: "form-control",

            // set the uitheme widget to use the bootstrap theme class names
            // this is no longer required, if theme is set
            // ,uitheme : "bootstrap"

        }
    });
</script>
<?php $this->end(); ?>