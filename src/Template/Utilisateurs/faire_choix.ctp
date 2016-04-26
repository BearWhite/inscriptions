<h2>Faire mon choix <small class="pull-right"><sub>Parcours <?= $parcours ?></sub></small></h2>
<hr class="colorgraph">

<?php use Cake\I18n\Time;

foreach($periodes as $periode): ?>
    <?= $this->Form->create(null, ['url'=>'/utilisateurs/faireChoix']); ?>
    <div class="panel panel-default">

        <!-- Default panel contents -->
        <div class="panel-heading"><?= $periode['periode']->public_title; ?></div>
        <div class="panel-body">
            <p><?= 'Choix ouverts du <strong><em>' . $this->Time->format(
                    $periode['periode']->date_debut_choix,
                    \IntlDateFormatter::FULL) . '</em></strong> au <strong><em>' . $this->Time->format(
                    $periode['periode']->date_fin_choix,
                    \IntlDateFormatter::FULL) . '</em></strong>'; ?></p>
            <p>Vous devez sélectionner <span class="badge"><?= $periode['periode']->nb_options ?></span> options.</p>
            <?php if(count($periode['choix']['ids']) > 0): ?>
            <hr />
            Vous avez choisi les options
                <?php foreach($periode['choix']['entities'] as $index => $groupe): ?>
                    <strong><em><?= $groupe->module->title; ?></em></strong><!--
                    --><?php if($index !== count($periode['choix']['entities'])-1) echo ', ' ?>
                <?php endforeach; ?>
                . <p>Pour refaire tous vos choix, sélectionnez de nouveau les options et validez le formulaire.</p>
            <?php endif; ?>
        </div>
        <!-- List group -->
        <?php if(Time::now() >= $periode['periode']->date_debut_choix && Time::now() <= $periode['periode']->date_fin_choix): ?>
        <ul class="list-group">
        <?php foreach($periode['groupes'] as $groupe): ?>
            <?php if(in_array($groupe->id, $periode['choix']['ids'])) $groupe->placeDispo++; ?>
            <?php if($groupe->placeDispo > 0): ?>
            <li class="list-group-item"><?= $this->Form->checkbox('groupes[]', ['id' => $groupe->id, 'value' => $groupe->id, 'hiddenField' => false]); ?>&nbsp;&nbsp;&nbsp;<?= $this->Form->label($groupe->id, $groupe->module->title); ?>
                <?php if(in_array($groupe->id, $periode['choix']['ids'])) echo '<span class="label label-success">Choix actuel</span>' ?>
                <span class="badge"><?= $groupe->placeDispo ?> place(s) disponible(s)</span>
            </li>
            <?php endif; ?>
        <?php endforeach; ?>
        </ul>
        <div style="text-align: center; margin:20px;">
            <?= $this->Form->hidden('period_id', ['value' => $periode['periode']->id]); ?>
            <?= $this->Form->button('Valider mes choix',['class' => 'btn btn-primary btn-lg']); ?>
        </div>
        <?= $this->Form->end(); ?>
        <?php endif; ?>
    </div>
<?php endforeach; ?>
