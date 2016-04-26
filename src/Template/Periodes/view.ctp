<h2><?= h($periode->title) ?>
    <span class="pull-right">
        <?= $this->Html->link(__('Retour à la liste des périodes'), ['action' => 'index'],['class' => 'btn btn-info'] ) ?>
    </span>
</h2>

<hr class="colorgraph"/>
<div class="row">
    <div class="col-lg-5">
        <h6><?= __('Titre') ?></h6>
                <p><?= h($periode->title) ?></p>
    </div>
    <div class="col-md-3">
            <h6><?= __('Date Debut') ?></h6>
        <p><?= h($periode->date_debut) ?></p>
            <h6><?= __('Date Fin') ?></h6>
        <p><?= h($periode->date_fin) ?></p>
    </div>
    <div class="col-md-3">
            <h6><?= __('Date Debut Choix') ?></h6>
        <p><?= h($periode->date_debut_choix) ?></p>
            <h6><?= __('Date Fin Choix') ?></h6>
        <p><?= h($periode->date_fin_choix) ?></p>
    </div>
</div>
