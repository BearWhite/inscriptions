<h2>Modification d'un utilisateur
    <?= $this->Html->link('<i class="fa fa-user"></i> '.__('retour à mon profil'), ['action' => 'details', $user->id], ['class' => 'btn btn-default pull-right', 'role' => 'button', 'escape' => false]); ?>
</h2>
<hr class="colorgraph">

<div class="row">
    <div class="col-md-5">
     
        <?php
        echo $this->Form->create($user);

        echo $this->Form->input('prenom', array('label' => 'Prénom'));
        echo $this->Form->input('nom', array('label' => 'Nom'));
        echo $this->Form->input('identifiant', array('label' => 'Identifiant'));
        echo $this->Form->input('email', array('label' => 'Email'));
        echo $this->Form->input('telephone', array('label' => 'Téléphone'));
        
        if($roles[$this->request->session()->read('Auth.User.role_id')] === 'Administrateur'){
            echo $this->Form->input('role_id',['label'=>'Rôle']);
            
        
            foreach($periodes as $periode): ?>
                <strong> <?= $periode['periode']->title ?> </strong>
                <?php  foreach($periode['groupes'] as $groupe):
                    if(in_array($groupe->id, $periode['choix']['ids'])) $groupe->placeDispo++; ?>
        
                    <li class="list-group-item">
                        <?php if(in_array($groupe->id, $periode['choix']['ids'])) { ?>
                        <?=    $this->Form->checkbox('groupes[]', ['id' => $groupe->id, 'value' => $groupe->id, 'hiddenField' => false, 'checked']); ?>
                        <?php } else { ?>
                        <?=   $this->Form->checkbox('groupes[]', ['id' => $groupe->id, 'value' => $groupe->id, 'hiddenField' => false]); ?>
                        <?php } ?>
                        &nbsp;&nbsp;&nbsp;
                        <?= $this->Form->label($groupe->id, $groupe->module->title); ?>
                        <?php if(in_array($groupe->id, $periode['choix']['ids'])) echo '<span class="label label-success">Choix actuel</span>' ?>
                        <span class="badge"><?= $groupe->placeDispo ?> place(s) disponible(s)</span>
                    </li>
                <?php endforeach;?>
                <br/>
            <?php endforeach;
        }?>
        
        <div class="form-group">
            <?php echo $this->Form->label(null,'Mot de passe'); ?><br />
            <a href="<?= $this->Url->build(['controller' => 'utilisateurs', 'action' => 'modification_mdp', $user->id]); ?>">
                Modifier mot de passe <span aria-hidden="true">&rarr;</span>
            </a>
        </div>

        <?= $this->Form->submit('Modifier l\'utilisateur', ['class' => 'btn btn-primary']); ?>
        <?= $this->Form->end(); ?>
    </div>
</div>

