<h2><?= h($statut->intitule) ?>
    <span class="pull-right">
        <?= $this->Html->link(__('Retour à la liste des statuts'), ['action' => 'index'],['class' => 'btn btn-info'] ) ?>
    </span>
</h2>

<hr class="colorgraph"/>
<div class="row">
    <div class="col-lg-5">
        <h6><?= __('Intitule') ?></h6>
                <p><?= h($statut->intitule) ?></p>
    </div>
    <div class="col-md-3">
            <h6><?= __('Heures Max') ?></h6>
        <p><?= h($statut->heuresmax) ?></p>
    </div>
    <div class="col-md-3">
            <h6><?= __('Types d\'enseignement') ?></h6>
        <p><?= h($statut->typeenseignement) ?></p>
    </div>
</div>
