<h2> Ajouter un statut
    <span class="pull-right">
        <?= $this->Html->link(__('Retour à la liste des statuts'), ['action' => 'index'],['class' => 'btn btn-info'] ) ?>
    </span>
</h2>

<hr class="colorgraph"/>
<?= $this->Form->create($statut); ?>
<fieldset>
    <legend><?= __('Ajouter un statut') ?></legend>
    <div class="row">
        <div class="col-md-3">
        <?php
            echo $this->Form->input('intitule', ['label' => __('Intitulé du statut')]);
            echo $this->Form->input('heuresmax', ['label' => __('Heures Max')]);
            echo $this->Form->input('typeenseignement', ['label' => __('Type d\'enseignement')]);
        ?>
        </div>
    </div>
</fieldset>
<?= $this->Form->button(__('Ajouter le statut'), ['class' => 'btn, btn-success']) ?>
<?= $this->Form->end() ?>