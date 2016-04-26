<h2>
    Ajouter une spécialité

    <span class="pull-right">
        <?= $this->Html->link(__('Retour à la liste des specialites'), ['action' => 'index'],['class' => 'btn btn-info'] ) ?></li>
    </span>
</h2>
<hr class="colorgraph"/>

<?= $this->Form->create($specialite); ?>
<fieldset>
    <?php
        echo $this->Form->input('title',['label' => 'Titre']);
                echo $this->Form->input('mention_id', ['options' => $mentions]);

                ?>
</fieldset>
<?= $this->Form->button(__('Ajouter'), ['class' => 'btn, btn-success']) ?>
<?= $this->Form->end() ?>