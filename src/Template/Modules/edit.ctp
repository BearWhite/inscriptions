<h2>Modifier un module
<span class="btn-group pull-right">
        <?= $this->Html->link(__('Retour à la liste des modules'), ['action' => 'index'], ['class' => 'btn btn-info']) ?>
</span>
</h2>
<hr class="colorgraph"/>

<?= $this->Form->create($module); ?>
<fieldset>
    <?php
        echo $this->Form->input('code');
        echo $this->Form->input('title');
    ?>
</fieldset>
<?= $this->Form->button(__('Modifier'),['class'=> 'btn btn-primary']) ?>
<?= $this->Form->end() ?>