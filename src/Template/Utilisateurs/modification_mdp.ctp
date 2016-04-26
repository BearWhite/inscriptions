<h2>Modification du mot de passe de <?= $user->prenom; ?> <?= $user->nom; ?>
    <?= $this->Html->link('<i class="fa fa-user"></i> '.__('retour à mon profil'), ['action' => 'details', $user->id], ['class' => 'btn btn-default pull-right', 'role' => 'button', 'escape' => false]); ?>
</h2>
<hr class="colorgraph">

<div class="row">
    <div class="col-md-3">
    <?php
        echo $this->Form->create($user);
        echo $this->Form->input('motdepasse',['value'=>'', 'type'=>'password', 'label'=>'Nouveau mot de passe']);
        echo $this->Form->input('password',['value'=>'', 'type'=>'password', 'label'=>'Confirmez le nouveau mot de passe']);
        echo $this->Form->submit('Modifier le mot de passe', ['class'=>'btn btn-primary']);
        echo $this->Form->end();
    ?>
    </div>
</div>
