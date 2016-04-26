<h2>Modifier la mention
    <span class="btn-group pull-right">
        <?= $this->Html->link(__('Retour à la liste des mentions'), ['action' => 'index'],['class' => 'btn btn-info']) ?>
        <?=$this->Form->postLink(
                    __('Supprimer'),
                    ['action' => 'delete', $mention->id],
                    array('class' => 'btn btn-danger',
                    'confirm' => __('Etes-vous sur de vouloir supprimer la mention "{0}"?', $mention->title))

                    )
        ?>
    </span>
</h2>
<hr class="colorgraph">
<?= $this->Form->create($mention); ?>
<fieldset>
    <?php
        echo $this->Form->input('title');
    ?>
</fieldset>
<?= $this->Form->button(__('Modifier'), ['class' => 'btn, btn-primary']) ?>
<?= $this->Form->end() ?>