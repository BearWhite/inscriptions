<h2> Creer un groupe</h2>

<hr class="colorgraph"/>

<div class="groupes form large-10 medium-9 columns">
    <?= $this->Form->create($groupe); ?>
    <fieldset>
        <?php
            echo $this->Form->input('capacite', ['label' => 'Capacité maximale du groupe']);
            echo $this->Form->input('obligatoire', [
                'label' => 'Les étudiants associés aux parcours de ce groupe doivent-être obligatoirement présents (UE obligatoire)',
                'help' => 'L\'utilisation de cette option permet de générer des feuilles de présence complètes pour des unités d\'enseignements combinant cours optionnels et cours obligatoires selon les différents parcours ...'
            ]);
            echo $this->Form->input('periode_id', [
                'label' => 'Période associée au groupe',
                'class' => 'chzn-select form-control'
            ]);
            echo $this->Form->input('parcours._ids', [
                'class'=>'chzn-select form-control',
                'data-placeholder' => 'Sélectionnez un ou plusieurs parcours',
                'options' => $parcours,
                'label' => 'Les étudiants du/des parcours ci-dessous font parti du groupe'
            ]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Ajouter le groupe'), ['class' => 'btn, btn-success']) ?>
    <?= $this->Form->end() ?>
</div>
