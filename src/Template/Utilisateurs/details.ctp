<h2>Détail d'un utilisateur
    <?php  if($user->role->title !== 'Etudiant'): ?>
    <?= $this->Html->link('<i class="fa fa-list"></i> '.__('liste des utilisateurs'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'role' => 'button', 'escape' => false]); ?>
    <?php elseif($user->role->title !== 'Administrateur'): ?>
    <?= $this->Html->link('<i class="fa fa-pencil"></i> '.__('modifier mon profil'), ['action' => 'modification', $user->id], ['class' => 'btn btn-default pull-right', 'role' => 'button', 'escape' => false]); ?>
    <?php endif; ?>
</h2>
<hr class="colorgraph">

<div class="row">
    <div class="col-md-6">
        <?php
        if($user->actif){
            echo '<div class="panel panel-success"><div class="panel-heading">Actif</div>';
        }else{
            echo '<div class="panel panel-danger"><div class="panel-heading">Non actif</div>';
        }
        ?>
        <table class="table">
            <tr>
                <td>
                    Nom :
                </td>
                <td>
                    <?php echo $user->nom; ?>
                </td>
            </tr>
            <tr>
                <td>
                    Prénom :
                </td>
                <td>
                    <?php echo $user->prenom; ?>
                </td>
            </tr>
            <tr>
                <td>
                    E-mail :
                </td>
                <td>
                    <?php echo $user->email; ?>
                </td>
            </tr>
            <tr>
                <td>
                    Téléphone :
                </td>
                <td>
                    <?php echo $user->telephone; ?>
                </td>
            </tr>
            <tr>
                <td>
                    Identifiant :
                </td>
                <td>
                    <?php echo $user->identifiant; ?>
                </td>
            </tr>
            <?php if($user->has('parcour')): ?>
            <tr>
                <td>
                    Parcours :
                </td>
                <td>
                    <?= $user->parcour->title ?>
                </td>
            </tr>
            <?php endif; ?>
            <?php  if($user->role->title !== 'Etudiant'): ?>
                <tr>
                    <td>
                        Role :
                    </td>
                    <td>
                        <?= $user->role->title ?>
                    </td>
                </tr>
            <?php  endif; ?>
        </table>
    </div></div>

    <?php if($user->has('parcour')): ?>
    <div class="col-md-6">
        <div class="panel panel-default"><div class="panel-heading">Choix d'options de cet utilisateur</div>
        <?php if(count($user->groupes) > 0): ?>
        <table class="table">
            <thead>
                <tr>
                    <td>Option</td>
                    <td>Période</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach($user->groupes as $groupe): ?>
                <tr>
                    <td><?= $groupe->module->code . ' - ' . $groupe->module->title ?></td>
                    <td><?= $groupe->periode->public_title ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php else: ?>
            <div class="panel-body">
                <p>Cet utilisateur n'a pas encore fait ses choix.</p>
            </div>
        <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>
</div>
