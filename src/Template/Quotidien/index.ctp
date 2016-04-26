<h2>Au quotidien</h2>
<hr class="colorgraph">

    <div class="row">
        <div class="col-md-6">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title text-center"><i class='fa fa-graduation-cap'></i> Parcours
                        <br/><br/><a href="<?php echo $this->Url->build(['controller' => 'Quotidien', 'action' => 'feuilleparcours'],['escape' => false]); ?>" class="btn btn-default btn-xs"><i class="fa fa-download"></i> Télécharger l'ensemble des feuilles</a>
                    </h3>
                </div>

                <ul class="list-group">
                    <?php foreach($parcours as $parcour): ?>
                    <li class="list-group-item">
                        <div class="row toggle" id="dropdown-detail-<?php echo $parcour->id; ?>" data-toggle="detail-<?php echo $parcour->id; ?>">
                            <div class="col-xs-10">
                                <?php echo $parcour->getFullTitle(); ?>
                            </div>
                            <div class="col-xs-2"><i class="fa fa-chevron-down pull-right"></i></div>
                        </div>
                        <div id="detail-<?php echo $parcour->id; ?>" class="js-toggler">
                            <hr/>
                            <div class="container">
                                <p>
                                    <a href="<?php echo $this->Url->build(['controller' => 'Quotidien', 'action' => 'feuilleparcour'],['escape' => false]); ?>?parcour_id=<?php echo $parcour->id; ?>" class="btn btn-primary"><i class="fa fa-download"></i> Téléchager la feuille d'émargement</a>
                                    <br/>
                                    <br/>
                                    <a href="<?php echo $parcour->implodeUtilisateursMails($parcour->id); ?>" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Liste de Emailling</a>
                                    <a href="<?php echo $parcour->implodeUtilisateursMails($parcour->id, 'bcc'); ?>" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Liste de Emailling (bcc)</a>
                                </p>
                            </div>
                        </div>
                    </li>
                    <?php endforeach; ?>
                </ul>

            </div>

        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">
                        <i class='fa fa-cubes'></i> Modules (<?php echo $modules_count; ?>)
                        <br/><br/><a href="<?php echo $this->Url->build(['controller' => 'Quotidien', 'action' => 'feuillemodules'],['escape' => false]); ?>? promotion=<?php echo $promotion_get; ?>" class="btn btn-default btn-xs"><i class="fa fa-download"></i>  Télécharger l'ensemble des feuilles</a>
                        <hr/>
                        <?php echo $this->Form->create(null, ['url'=>'', 'type' => 'get']); ?>
                        <?php echo $this->Form->select('promotion_select', $liste_promotions, array('hiddenField' => false, 'class' => 'form-control form-select', 'default' => $promotion_get)); ?>
                        <?php echo $this->Form->end(); ?>
                    </h3>
                </div>

                <ul class="list-group">
                    <?php foreach($modules as $module): ?>
                    <li class="list-group-item">
                        <div class="row toggle" id="dropdown-detail-grp-<?php echo $module->id; ?>" data-toggle="detail-grp-<?php echo $module->id; ?>">
                            <div class="col-xs-10">
                                <?php echo $module->code; ?> - <?php echo $module->title; ?>
                            </div>
                            <div class="col-xs-2"><i class="fa fa-chevron-down pull-right"></i></div>
                        </div>
                        <div id="detail-grp-<?php echo $module->id; ?>" class="js-toggler">
                            <hr/>
                            <div class="container">
                                <p>
                                    <a href="<?php echo $this->Url->build(['controller' => 'Quotidien', 'action' => 'feuillemodule'],['escape' => false]); ?>?module_id=<?php echo $module->id; ?>" class="btn btn-primary"><i class="fa fa-download"></i> Téléchager la feuille d'émargement</a>
                                    <br/>
                                    <br/>
                                    <a href="<?php echo $module->implodeUtilisateursMails($module->id); ?>" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Liste de Emailling</a>
                                    <a href="<?php echo $module->implodeUtilisateursMails($module->id, 'bcc'); ?>" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Liste de Emailling (bcc)</a>
                                </p>
                            </div>
                        </div>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>

<?php $this->start('script'); ?>

<script type="text/javascript">
    $(document).ready(function () {
        $('[id^=detail-]').hide();
        $('.toggle').click(function () {
            $('[id^=detail-]').hide();
            $input = $(this);
            $target = $('#' + $input.attr('data-toggle'));
            $target.slideToggle();
        });
        $(".form-select").change(function () {
            $(this).closest('form').trigger('submit');
        });
    });
</script>

<?php $this->end(); ?>