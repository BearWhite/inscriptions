<h2>Liste des utilisateurs
    <?= $this->Html->link('<i class="fa fa-check"></i> '.__('Valider les utilisateurs'), ['action' => 'valider'], ['class' => 'btn btn-success pull-right', 'role' => 'button', 'escape' => false]); ?>

    <?= $this->Html->link('<i class="fa fa-plus"></i> '.__('Nouvelle utilisateur'), ['action' => 'inscription'], ['class' => 'btn btn-success pull-right', 'role' => 'button', 'escape' => false]); ?>
</h2>
<hr class="colorgraph">

<?php
    $table_content=array();
    foreach($users as $u){
        $boutonProfil = $this->Html->link(
            '<i class="fa fa-eye"></i>'.__(' Voir'),
                [
                    'controller' => 'utilisateurs',
                    'action' => 'details',
                    $u->id,
                ],
            ['class' => 'btn btn-default btn-xs','escape' => false]

        );

        $boutonModifier = $this->Html->link(
            '<i class="fa fa-pencil"></i>'.__(' Modifier'),
                [
                    'controller' => 'utilisateurs',
                    'action' => 'modification',
                    $u->id
                ],
            ['class' => 'btn btn-default btn-xs','escape' => false]
        );

        $boutonSupprimer = $this->Html->link(
            '<i class="fa fa-trash"></i>',
                [
                     'controller' => 'utilisateurs',
                     'action' => 'suppression',
                     $u->id
                 ],
            ['confirm'=>'Vous êtes sur le point de supprimer un utilisateur.           Êtes-vous sûr ?','class' => 'btn btn-default btn-xs','escape' => false]

        );

        $boutons = $boutonProfil.'&nbsp'.$boutonModifier.'&nbsp'.$boutonSupprimer;

        if($u->actif){
            $check='<input type="checkbox" disabled="disabled" checked>';
        }else{
            $check='<input type="checkbox" disabled="disabled">';
        }

        $table_content[] = [
            $u->nom,
            $u->prenom,
            $u->role->title,
            $u->has('parcour') ? $u->parcour->specialite->mention->title : '',
            $u->has('parcour') ? $u->parcour->specialite->title : '',
            $u->has('parcour') ? $u->parcour->title : '',
            $check,
            $boutons
        ];
    }
?>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <table class="table table-striped">
            <thead>
                <?php echo $this->Html->tableHeaders([
                    'Nom',
                    'Prénom',
                    ['Rôle'=>[
                        'class' => 'filter-select filter-exact'
                    ]],
                    ['Mention'=>[
                        'class' => 'filter-select filter-exact'
                    ]],
                    ['Spécialité'=>[
                        'class' => 'filter-select filter-exact'
                    ]],
                    ['Parcours'=>[
                        'class' => 'filter-select filter-exact'
                    ]],
                    ['Actif'=>[
                        'data-sorter' => 'false',
                        'data-filter' => 'false'
                    ]],
                    ['Actions'=>[
                        'data-sorter' => 'false',
                        'data-filter' => 'false'
                    ]]
                ]); ?>
            </thead>
            <tbody>
                <?php echo $this->Html->tableCells($table_content); ?>
            </tbody>
        </table>
    </div>
</div>

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