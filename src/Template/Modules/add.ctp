<h2>
    Ajouter un Module
</h2>
<hr class="colorgraph"/>

<?= $this->Form->create($module); ?>
<fieldset>
    <div class="row">
        <div class="col-md-5">
            <?php
                echo $this->Form->input('code');
                echo $this->Form->input('title', ['label' => 'Intitulé du module']);
            ?>
        </div>
    </div>
</fieldset>
<?= $this->Form->button(__('Ajouter le module'), ['class' => 'btn, btn-success']) ?>
<?= $this->Form->end() ?>