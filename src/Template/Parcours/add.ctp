<h2>
    Ajouter un parcours
    <span class="pull-right">
        <?= $this->Html->link(__('Retour à la liste des parcours'), ['action' => 'index'],[ 'class' =>'btn btn-info']  ) ?>
    </span>
</h2>
<hr class="colorgraph"/>
<?= $this->Form->create($parcour); ?>
<fieldset>
    <?php
        echo $this->Form->input('title',['label' => "Titre"]);
        echo $this->Form->input('année');
        echo $this->Form->input('specialite_id', ['options' => $specialites]);?>
</fieldset>
<?= $this->Form->button(__('Ajouter'), ['class' => 'btn, btn-success']) ?>
<?= $this->Form->end() ?>