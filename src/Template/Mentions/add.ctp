<h2>
    Ajouter une mention
    <span class="pull-right">
        <?= $this->Html->link(__('Retour à la liste des mentions'), ['action' => 'index'],['class' => 'btn btn-info'] ) ?>
    </span>
</h2>
<hr class="colorgraph"/>
<?= $this->Form->create($mention); ?>
<fieldset>
    <?php
        echo $this->Form->input('title',["label"=>"Titre"]);
        ?>
</fieldset>
<?= $this->Form->button(__('Ajouter'), ['class' => 'btn, btn-success']) ?>
<?= $this->Form->end() ?>