<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="Application de Gestion des Inscriptions aux Cours Optionnels">
        <meta name="author" content="Gicoteurs">

    <?php
        if (isset($title)) {
            $this->assign('title', $title);
        }
    ?>
        <title><?= $this->fetch('title') ?></title>

    <?= $this->Html->charset() ?>
    <?= $this->Html->meta('icon') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>

        <!-- Bootstrap core CSS -->
        <?= $this->Html->css('bootstrap.min'); ?>
        <?= $this->Html->css('font-awesome.min'); ?>
        <?= $this->Html->css('../components/chosen/chosen.min'); ?>
        <?= $this->Html->css('chosen.bootstrap'); ?>
        <?= $this->Html->css('../components/bootstrap-datetimepicker-2.3.4/css/bootstrap-datetimepicker.min'); ?>
        <?= $this->Html->css('../components/bootstrap-datetimepicker-2.3.4/css/bootstrap-datetimepicker.min'); ?>
            <?= $this->Html->css('../components/tablesorter/css/theme.bootstrap.min'); ?>
        <?= $this->Html->css('gico'); ?>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>

        <!-- Fixed navbar -->
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                            aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Afficher/Masquer le menu</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo $this->Url->build(['controller' => 'dashboard']); ?>">
                        <?= $this->Html->image('gico.logo.png', [
                        'alt' => 'Logo GICO',
                        'class' => 'application-logo'
                    ]); ?>GICO</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                <?php if($this->request->session()->read('Auth.User')): ?>
                    <li class="dropdown">
                    <?php if($roles[$this->request->session()->read('Auth.User.role_id')] === 'Administrateur'): ?>
                    <li>
                        <?= $this->Html->link(
                            '<i class="fa fa-dashboard"></i> ' . __('Tableau de bord'),
                            ['controller' => 'dashboard'],
                            ['escape' => false]
                        ); ?>
                    </li>
                    <?php endif; ?>
                    <?php if($roles[$this->request->session()->read('Auth.User.role_id')] === 'Etudiant'): ?>
                    <li>
                        <?= $this->Html->link(
                            '<i class="fa fa-check-square-o"></i> ' . __('Faire mon choix'),
                            ['controller' => 'utilisateurs', 'action' => 'faireChoix'],
                            ['escape' => false]
                        ); ?>
                    </li>
                    <?php endif; ?>
                    <?php if(in_array($roles[$this->request->session()->read('Auth.User.role_id')],['Administrateur','Professeur'])): ?>
                    <li>
                    <?= $this->Html->link(
                        '<i class="fa fa-clock-o"></i> ' . __('Au quotidien'),
                        ['controller' => 'quotidien'],
                        ['escape' => false]
                    ); ?>
                    </li>
                    <li>
                    <?= $this->Html->link(
                        '<i class="fa fa-list-alt"></i> ' . __('Synthèse'),
                        ['controller' => 'synthese'],
                        ['escape' => false]
                    ); ?>
                    </li>
                    <?php endif; ?>
                    <?php if($roles[$this->request->session()->read('Auth.User.role_id')] === 'Administrateur'): ?>
                    <li class="dropdown">
                    <?= $this->Html->link(
                        '<i class="fa fa-cogs"></i> ' . __('Paramètres') . ' <span class="caret"></span>',
                        '#',
                        ['escape' => false, 'class' => 'dropdown-toggle', 'data-toggle' => 'dropdown', 'role' => 'button', 'aria-expanded' => 'false']
                    ); ?>
                        <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                            <li>
                            <?= $this->Html->link(
                                '<i class="fa fa-calendar fa-fw"></i> ' . __('Périodes'),
                                ['controller' => 'periodes'],
                                ['escape' => false]
                            ); ?>
                            </li>

                            <li class="dropdown-submenu">
                                <a tabindex="-1" href="#"><i class="fa fa-graduation-cap fa-fw"></i> Hiérarchie universitaire</a>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <?= $this->Html->link(
                                            __('Mentions'),
                                            ['controller' => 'mentions'],
                                            ['escape' => false]
                                        ); ?>
                                    </li>
                                    <li>
                                        <?= $this->Html->link(
                                            __('Spécialités'),
                                            ['controller' => 'specialites'],
                                            ['escape' => false]
                                        ); ?>
                                    </li>
                                    <li>
                                        <?= $this->Html->link(
                                            __('Parcours'),
                                            ['controller' => 'parcours'],
                                            ['escape' => false]
                                        ); ?>
                                    </li>
                                </ul>
                            </li>

                            <li>
                    <?= $this->Html->link(
                        '<i class="fa fa-cubes fa-fw"></i> ' . __('Modules'),
                        ['controller' => 'modules'],
                        ['escape' => false]
                    ); ?>
                            </li>
                            <li>
                    <?= $this->Html->link(
                        '<i class="fa fa-users fa-fw"></i> ' . __('Utilisateurs'),
                        ['controller' => 'utilisateurs'],
                        ['escape' => false]
                    ); ?>
                            </li>

                        </ul>
                    </li>
                    <?php endif; ?>
                <?php endif; ?>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                <?php if($this->request->session()->read('Auth.User')): ?>
                        <li>
                        <?= $this->Html->link(
                            '<i class="fa fa-user"></i> '.$this->request->session()->read('Auth.User.prenom').' '.$this->request->session()->read('Auth.User.nom'),
                            ['controller' => 'utilisateurs', 'action' => 'details', $this->request->session()->read('Auth.User.id')],
                            ['escape' => false]
                        ); ?>
                        </li>
                        <li>
                        <?= $this->Html->link(
                            '<i class="fa fa-sign-out"></i> Déconnexion',
                            ['controller' => 'utilisateurs', 'action' => 'deconnexion'],
                            ['escape' => false]
                        ); ?>
                        </li>
                <?php else: ?>
                        <li>
                        <?= $this->Html->link(
                            '<i class="fa fa-user-plus"></i> Inscription',
                            ['controller' => 'utilisateurs', 'action' => 'inscription'],
                            ['escape' => false]
                        ); ?>
                        </li>
                        <li>
                        <?= $this->Html->link(
                            '<i class="fa fa-sign-in"></i> Connexion',
                            ['controller' => 'utilisateurs', 'action' => 'connexion'],
                            ['escape' => false]
                        ); ?>
                        </li>
                <?php endif; ?>
                    </ul>
                </div>
                <!--/.nav-collapse -->
            </div>
        </nav>

        <div class="container">

    <?= $this->Flash->render() ?>
    <?= $this->fetch('content') ?>
        </div>
        <!-- /container -->


        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <?= $this->Html->script('jquery-1.11.3.min'); ?>
        <?= $this->Html->script('bootstrap.min'); ?>
        <?= $this->Html->script('../components/bootstrap-datetimepicker-2.3.4/js/bootstrap-datetimepicker'); ?>
        <?= $this->Html->script('../components/bootstrap-datetimepicker-2.3.4/js/locales/bootstrap-datetimepicker.fr'); ?>
        <?= $this->Html->script('../components/tablesorter/js/jquery.tablesorter.min'); ?>
        <?= $this->Html->script('../components/tablesorter/js/jquery.tablesorter.widgets.min'); ?>
        <?= $this->Html->script('../components/chosen/chosen.jquery.min'); ?>
        <?= $this->Html->script('gico'); ?>
        <?= $this->fetch('script') ?>

    </body>
</html>
