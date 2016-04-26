<h2>Synthèse globale</h2>
<hr class="colorgraph" />

<div class="navigation-header">
    <?php echo $this->Form->create(null, ['url' => '', 'type' => 'get']); ?>
    <div class="row">
        <div class="col-md-2">
            <?php echo $this->Form->select('mention_id', $mentions, array('hiddenField' => false, 'class' => 'form-control form-select', 'default' => $mention_id)); ?>
        </div>
        <div class="col-md-2">
            <?php echo $this->Form->select('specialite_id', $specialites, array('hiddenField' => false, 'class' => 'form-control form-select', 'default' => $specialite_id)); ?>
        </div>
        <div class="col-md-2">
            <?php echo $this->Form->select('annee', $annees, array('hiddenField' => false, 'class' => 'form-control form-select', 'default' => $annee)); ?>
        </div>
        <div class="col-md-2">
            <?php echo $this->Form->select('parcour_id', $parcours, array('hiddenField' => false, 'class' => 'form-control form-select', 'default' => $parcour_id)); ?>
        </div>
        <div class="col-md-2">
            <?php
                $options = array('groupes' => 'Groupes', 'etudiants' => 'Etudiants');
                $attributes = array('legend' => false, 'value'=>$typevue, 'class'=>'form-select');
                echo $this->Form->radio('typevue', $options, $attributes);
            ?>
        </div>
        <div class="col-md-2">
            <button type="submit" name="filter" class="btn btn-success"><i class="fa fa-filter"></i> Filtrer</button>
        </div>
    </div>
    <?php echo $this->Form->end(); ?>
</div>

<?php if (isset($this->request->query['filter'])): ?>
    <article>
        <hr/>
        <h2><?php echo $parcour_title; ?></h2>
        <hr/>
        <div id="accordion" class="panel-group">
            <?php if (isset($groupes)): ?>
                <?php foreach ($groupes as $groupe): ?>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle" href="#collapse-<?php echo $groupe->id; ?>" data-parent="#accordion" data-toggle="collapse">
                                    <i class="fa fa-users"></i>
                                    Groupe &laquo;<?php echo $groupe->module->code.' '.$groupe->module->title; ?>&raquo;


                                </a>
                                <?php if (!$groupe->obligatoire) : ?>
                                    <span class="pull-right">
                                        <span class="badge"><?php echo sizeof($groupe->utilisateurs); ?> / <?php echo $groupe->capacite; ?></span>
                                    </span>
                                <?php else: ?>
                                    <span class="pull-right">
                                        <span class="badge">Obligatoire</span>
                                    </span>
                                <?php endif; ?>
                            </h4>
                        </div>

                        <div id="collapse-<?php echo $groupe->id; ?>" class="panel-collapse collapse">
                            <div class="panel-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nom</th>
                                            <th>Prénom</th>
                                            <th>Téléphone</th>
                                            <th>Email</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $utilisateurs = $groupe->utilisateurs;
                                        if ($groupe->obligatoire) {
                                            $utilisateurs = $groupe->getAllUtilisateursFromParcours();
                                        }
                                        ?>
                                        <?php foreach ($utilisateurs as $utilisateur) : ?>
                                            <tr>
                                                <td><?php echo $utilisateur->nom; ?></td>
                                                <td><?php echo $utilisateur->prenom; ?></td>
                                                <td><?php echo $utilisateur->telephone; ?></td>
                                                <td><?php echo $utilisateur->email; ?></td>
                                                <td>
                                                  <?php  echo $this->Html->link(
                                                    '<i class="fa fa-eye"></i>'.__(" Voir le profil de l'étudiant"),
                                                    [
                                                    'controller' => 'utilisateurs',
                                                    'action' => 'details',
                                                    $utilisateur->id,
                                                    ],
                                                    ['class' => 'btn btn-default btn-xs','escape' => false]

                                                    )
                                                    ;?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>


                    <h3></h3>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="row">
                    <div class="col-md-6">

                        <?php foreach ($utilisateurs as $utilisateur): ?>
                            <div class="panel panel-default ">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle" href="#collapse-<?php echo $utilisateur->id; ?>" data-parent="#accordion<?php echo $utilisateur->id; ?>" data-toggle="collapse">
                                            <i class="fa fa-user"></i>
                                            <?php echo $utilisateur->nom.' '.$utilisateur->prenom; ?>
                                        </a>
                                        <span class="pull-right">
                                            <?php
                                            echo $this->Html->link(
                                                '<i class="fa fa-eye"></i>'.__(" Voir le profil de l'étudiant"),
                                                    [
                                                        'controller' => 'utilisateurs',
                                                        'action' => 'details',
                                                        $utilisateur->id,
                                                    ],
                                                ['class' => 'btn btn-default btn-xs','escape' => false]

                                                )
                                            ;?>
                                        </span>


                                    </h4>
                                </div>

                                <div id="collapse-<?php echo $utilisateur->id; ?>" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                        <?php if(!empty($utilisateur->groupes)):?>
                                        <ul>
                                            <?php foreach ($utilisateur->groupes as $groupe): ?>
                                                <li>
                                                       <?php echo $groupe->module->code.' '.$groupe->module->title;?>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                        <?php else: ?>
                                            <p>
                                                Cet étudiant n'a pas encore choisi ses options.
                                            </p>

                                        <?php endif;?>
                                    </div>
                                </div>
                            </div>
                            <h3></h3>
                        <?php endforeach; ?>
                    </div>
                    <div class="col-md-6">
                        <h4>Modules Obligatoires</h4>
                            <ul>
                                <?php foreach ($groupes_obligatoires as $parcour): ?>
                                    <?php if(!empty($parcour->groupes)):?>
                                        <?php foreach ($parcour->groupes as $groupe): ?>
                                            <li><?php echo $groupe->module->code.' '.$groupe->module->title;?></li>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <li class="fa fa-exclamation-triangle"></i> Aucune option obligatoire pour ce parcours </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </article>

<?php else: ?>
    <hr/>
    <p class="alert alert-info">
        <strong>Information</strong>, sélectionnez un parcours via les listes déroulantes et n'oubliez pas de cliquez sur le bouton filtrer.
    </p>
<?php endif; ?>

<?php $this->start('script'); ?>
<script type="text/javascript">
    $(".form-select").change(
            function () {
                $(this).closest('form').trigger('submit');
            });
</script>
<?php $this->end(); ?>