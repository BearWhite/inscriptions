<h2>
    Modifier une spécialité
<div class='btn-group pull-right'>
    <?= $this->Html->link(__('Retour à la liste des spécialites'), ['action' => 'index'], ['class' => 'btn btn-info']) ?></li>
    <?=$this->Form->postLink(
            __('Supprimer la spécialité'),
            ['action' => 'delete', $specialite->id],
            array('class' => 'btn btn-danger',
            'confirm' => __('Etes vous sur de vouloir supprimer la specialité {0}?', $specialite->title)
            )
            )
            ?>
</div>
</h2>
<hr class="colorgraph"/>

<?= $this->Form->create($specialite); ?>
    <fieldset>
        <?php
            echo $this->Form->input('title', ['label' => 'Titre ']);
            echo $this->Form->input('mention_id', ['options' => $mentions]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Modifier'), ['class' => 'btn, btn-primary']) ?>
<?= $this->Form->end() ?>