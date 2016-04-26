<h2>Tableau de bord</h2>
<hr class="colorgraph">

<?php if($roles[$this->request->session()->read('Auth.User.role_id')] === 'Administrateur'): ?>
<?php if(count($unvalidated_users) > 0): ?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-danger">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-12">
                        <i class="fa fa-bullhorn fa-2x"></i>&nbsp;&nbsp;&nbsp;
                        <span class="lead" style="margin-bottom: 0px;">Des utilisateurs ont créé un compte et sont en attente de validation par l'administrateur.</span>
                    </div>
                </div>
            </div>
            <a href="<?= $this->Url->build(['controller' => 'utilisateurs', 'action' => 'valider']); ?>">
                <div class="panel-footer text-danger">
                    <span class="pull-left"></span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i> valider les utilisateurs en attente</span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
<?php endif; ?>
<?php endif; ?>
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-violet">
            <div class="panel-heading">
                <div class="row">
                    <div class="text-center col-xs-3">
                        <i class="fa fa-clock-o fa-5x"></i>
                    </div>
                    <div class="col-xs-9">
                        <div>La rubrique au quotidien permet d'effectuer la plupart des opérations courantes. Vous pouvez ainsi envoyer des emails aux utilisateurs inscrits et imprimer des feuilles d'émargement par parcours, module ou promotion.</div>
                    </div>
                </div>
            </div>
            <a href="<?= $this->Url->build(['controller' => 'quotidien']); ?>">
                <div class="panel-footer text-violet">
                    <span class="pull-left">accéder à la rubrique "Au quotidien"</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-orange">
            <div class="panel-heading">
                <div class="row">
                    <div class="text-center col-xs-3">
                        <i class="fa fa-list-alt fa-5x"></i>
                    </div>
                    <div class="col-xs-9">
                        <div>La synthèse vous permet d'afficher pour chaque parcours, les groupes associés et les étudiants inscrits dans ces groupes. Une synthèse étudiant est également disponible pour afficher les options d'un étudiant.</div>
                    </div>
                </div>
            </div>
            <a href="<?= $this->Url->build(['controller' => 'synthese']); ?>">
                <div class="panel-footer text-orange">
                    <span class="pull-left">voir la synthèse</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
<?php if($roles[$this->request->session()->read('Auth.User.role_id')] === 'Administrateur'): ?>
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-calendar fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?= $nb_periodes ?></div>
                        <div>période(s)</div>
                    </div>
                </div>
            </div>
            <a href="<?= $this->Url->build(['controller' => 'periodes']); ?>">
                <div class="panel-footer">
                    <span class="pull-left">voir l'ensemble des périodes</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-success">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-graduation-cap fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div><span class="big"><?= $nb_mentions ?></span> mention(s)</div>
                        <div><span class="big"><?= $nb_specialites ?></span> spécialité(s)</div>
                        <div><span class="big"><?= $nb_parcours ?></span> parcours</div>
                    </div>
                </div>
            </div>
            <a href="<?= $this->Url->build(['controller' => 'parcours']); ?>">
                <div class="panel-footer text-success">
                    <span class="pull-left">voir la hiérarchie universitaire</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-cubes fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?= $nb_modules ?></div>
                        <div>unité(s) d'enseignement</div>
                    </div>
                </div>
            </div>
            <a href="<?= $this->Url->build(['controller' => 'modules']); ?>">
                <div class="panel-footer text-warning">
                    <span class="pull-left">voir les unités d'enseignement</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-danger">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-users fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?= $nb_utilisateurs ?></div>
                        <div>utilisateur(s)</div>
                    </div>
                </div>
            </div>
            <a href="<?= $this->Url->build(['controller' => 'utilisateurs']); ?>">
                <div class="panel-footer text-danger">
                    <span class="pull-left">voir les utilisateurs</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
<?php endif; ?>