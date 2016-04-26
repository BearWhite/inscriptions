<div class="col-md-4">
    <h2>Connexion</h2>
    <hr class="colorgraph">
    <?= $this->Form->create() ?>
        <?= $this->Form->input('identifiant') ?>
        <?= $this->Form->input('motdepasse', ['label'=>'Mot de passe', 'type' => 'password']) ?>
        <?= $this->Form->submit(__('Se connecter'),['class'=>'btn btn-primary']); ?>
    <?= $this->Form->end() ?>
</div>