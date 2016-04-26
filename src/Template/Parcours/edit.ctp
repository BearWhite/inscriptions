<h2>
    Modifier un parcours
    <span class="btn-group pull-right">
        <?= $this->Html->link(__('Retour à la liste des parcours'), ['action' => 'index'],['class' => 'btn btn-info']) ?>
        <?=$this->Form->postLink(
            __('Supprimer le parcours'),
            ['action' => 'delete', $parcour->id],
            array('class' => 'btn btn-danger','confirm' => __('Etes-vous sur de vouloir modifier le parcours {0}?', $parcour->title))
            )
        ?>
    </span>
</h2>
<hr class="colorgraph"/>
<?= $this->Form->create($parcour); ?>
<fieldset>
    <?php
        echo $this->Form->input('title',['label'=>'Titre']);
                echo $this->Form->input('année');
                echo $this->Form->input('specialite_id', ['options' => $specialites]);
                ?>
</fieldset>
<?= $this->Form->button(__('Modifier')) ?>
<?= $this->Form->end() ?>