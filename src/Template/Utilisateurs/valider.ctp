<h2>Utilisateurs en attente de validation
    <?= $this->Html->link('<i class="fa fa-list"></i> '.__('liste des utilisateurs'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'role' => 'button', 'escape' => false]); ?>
</h2>
<hr class="colorgraph">

<?php if(count($utilisateurs)): ?>
    <?= $this->Form->create(null, ['url'=>'/utilisateurs/validationMutliple']); ?>
    <table class="table">
        <thead>
        <tr>
            <th data-sorter="false" data-filter="false"><?= $this->Form->checkbox('checkall', array('hiddenField' => false, 'id' => 'checkall')); ?></th>
            <th>Prénom</th>
            <th>Nom</th>
            <th class="filter-select filter-exact">Promotion</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($utilisateurs as $row): ?>
            <tr>
                <td>
                    <?= $this->Form->checkbox($row->id, array('hiddenField' => false, 'class' => 'usercheck')); ?>
                </td>
                <td><?= $row->prenom ?></td>
                <td><?= $row->nom ?></td>
                <td><?= $row->parcour->specialite->mention->title . ' ▸ ' . $row->parcour->specialite->title . ' ' . $row->parcour->année ?></td></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <div class="col-md-6">
        <?= $this->Form->submit(__('Valider coché(s)'), ['name' => 'validate', 'class' => 'btn btn-success btn-block', 'escape' => false]); ?>
    </div>
    <div class="col-md-6">
        <?= $this->Form->submit(__('Supprimer coché(s)'), ['name' => 'delete', 'class' => 'btn btn-danger btn-block', 'escape' => false]); ?>
    </div>
    <?= $this->Form->end(); ?>
<?php else: ?>
    <p><?= __('Aucun compte en attente de validation'); ?></p>
<?php endif; ?>

<?php $this->start('script'); ?>
<script>
    $("table").tablesorter({
        theme : "bootstrap",
        widthFixed: true,
        headerTemplate : '{content} {icon}',
        widgets : [ "uitheme", "filter", "zebra" ],
        widgetOptions : {
            zebra : ["even", "odd"],
            filter_reset : ".reset",
            filter_cssFilter: "form-control"
        }
    });

    //On attache un gestionnaire à l'évènement filterEnd
    //de cette façon, on décoche tous les étudiants qui
    //auraient précédemment été cochés et qui ne font
    //plus partie du tri.
    $( "table" ).bind( "filterEnd", function() {
        $('.filtered').children(':first-child').children(':first-child').prop('checked', false);
    });
</script>
<?php $this->end(); ?>
