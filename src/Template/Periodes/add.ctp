<h2> Ajouter une periode
    <span class="pull-right">
        <?= $this->Html->link(__('Retour à la liste des périodes'), ['action' => 'index'],['class' => 'btn btn-info'] ) ?>
    </span>
</h2>

<hr class="colorgraph"/>
<?= $this->Form->create($periode); ?>
<fieldset>
    <legend><?= __('Ajouter une période') ?></legend>
    <div class="row">
        <div class="col-md-3">
        <?php
            echo $this->Form->input('title', ['label' => __('Intitulé de la période (administrateur)')]);
            echo $this->Form->input('public_title', ['label' => __('Intitulé public de la période (utilisateur)')]);
            echo $this->Form->input('nb_options', ['label' => __('Nombre d\'options à choisir pour cette période')]);
            echo $this->Form->input('date_debut', [
                'type'=>'text',
                'class'=>'datepicker',
                'readonly' => 'readonly',
                'append' => '<i class="fa fa-calendar"></i>',
                'label' => __('Date de début')
            ]);
            echo $this->Form->input('date_fin', [
                'type'=>'text',
                'class'=>'datepicker',
                'readonly' => 'readonly',
                'append' => '<i class="fa fa-calendar"></i>',
                'label' => __('Date de fin')
            ]);
            echo $this->Form->input('date_debut_choix', [
                'type'=>'text',
                'class'=>'datepicker',
                'readonly' => 'readonly',
                'append' => '<i class="fa fa-calendar"></i>',
                'label' => __('Ouverture des choix')
            ]);
            echo $this->Form->input('date_fin_choix', [
                'type'=>'text',
                'class'=>'datepicker',
                'readonly' => 'readonly',
                'append' => '<i class="fa fa-calendar"></i>',
                'label' => __('Fermeture des choix')
            ]);
        ?>
        </div>
    </div>
</fieldset>
<?= $this->Form->button(__('Ajouter la période'), ['class' => 'btn, btn-success']) ?>
<?= $this->Form->end() ?>