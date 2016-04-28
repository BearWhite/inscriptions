<div class="col-xs-12 col-sm-8 col-md-4">
    <?php  
     use App\Controller\UtilisateursController;
            $Utilisateurs = new UtilisateursController;
          
          $role_id = $Utilisateurs->Auth->user('role_id');
    echo $this->Form->create($user); 
        if ( !$role_id ) {
    ?>
    
        
    <h2>Inscription</h2>
    <?php
        } else {
    ?>
    <h2> Nouveau utilisateur</h2>
    
    <?php } ?>
    <hr class="colorgraph">

        <?php
            echo $this->Form->input('prenom', array('label' => 'Prénom'));
            echo $this->Form->input('nom', array('label' => 'Nom'));
            echo $this->Form->input('identifiant', array('label' => 'Identifiant'));
            echo $this->Form->input('email', array('label' => 'Email'));
            echo $this->Form->input('telephone', array('label' => 'Téléphone'));
            echo $this->Form->input('motdepasse', array('label' => 'Mot de passe', 'type' => 'password'));
            echo $this->Form->input('parcour_id', ['label' => 'Parcours']);
        ?>
         <?php 
           
        if ( !$role_id )           
            {
             ?>
            
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            En cliquant sur <strong class="label label-primary">Inscription</strong>, vous acceptez les <a href="#">Conditions Générales d'Utilisation</a> fixées par ce site, ceci inclu notre politique concernant l'utilisation des cookies.
        </div>
    </div>
    <hr class="colorgraph">
     <?= $this->Form->submit(__('Inscription'),['class'=>'btn btn-success btn-lg']); ?>
        <?php  
        } else {
            ?>
            <hr class="colorgraph">
             <?= $this->Form->submit(__('Inscrire'),['class'=>'btn btn-success btn-lg']); ?>
       <?php  }   ?>
                
        
    
     
        
</div>