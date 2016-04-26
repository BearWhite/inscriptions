<h2>
    Voir parcours
    <span class="pull-right">
        <?= $this->Html->link(__('Retour à la liste des parcours'), ['action' => 'index'],['class' => 'btn btn-info']) ?>
        <?= $this->Html->link(__('Modifier le parcours'), ['action' => 'edit', $parcour->id],['class' => 'btn btn-primary']) ?>
        <?= $this->Form->postLink(__('Supprimer le parcours'), ['action' => 'delete', $parcour->id], array('class' =>  'btn btn-danger','confirm' => __('Etes vous sur de vouloir supprimer le parcours "{0}"?', $parcour->title))) ?>
    </span>
</h2>
<hr class="colorgraph"/>

<h2><?= h($parcour->title) ?></h2>
<div class="row">
    <div class="col-lg-5">
        <p>
            <?= __('Titre') ?> : <?= h($parcour->title) ?>
        </p>
        <p>
            <?= __('Specialite') ?> :
            <?= $parcour->has('specialite') ? $this->Html->link($parcour->specialite->title, ['controller' => 'Specialites', 'action' => 'view', $parcour->specialite->id]) : '' ?>
        </p>
        <p>
            <?= __('Année') ?> :
            <?= $this->Number->format($parcour->année) ?>
        </p>
    </div>
</div>
