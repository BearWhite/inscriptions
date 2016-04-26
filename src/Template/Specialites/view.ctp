<h2>Voir <?= h($specialite->title) ?>
<span class='btn-group pull-right'>
    <?= $this->Html->link(__('Retour à la liste des spécialites'), ['action' => 'index'], ['class' => 'btn btn-info']) ?>
    <?= $this->Html->link(__('Modifier la specialité'), ['action' => 'edit', $specialite->id], ['class' => 'btn btn-primary']) ?>
    <?= $this->Form->postLink(__('Supprimer la specialite'), ['action' => 'delete', $specialite->id], array('class' => 'btn btn-danger','confirm' => __('Etes-vous sur de vouloir supprimer la spécialité "{0}"?', $specialite->title))) ?>
</span>
</h2>

<hr class="colorgraph">

<div class="row">
    <div class="col-lg-6">
        <h4><?= __('Titre') ?></h4>
        <p><?= h($specialite->title) ?></p>
        </div>
        <div class="col-lg-6">
        <h4><?= __('Mention') ?></h4>
        <p><?= $specialite->has('mention') ? $this->Html->link($specialite->mention->title, ['controller' => 'Mentions', 'action' => 'view', $specialite->mention->id]) : '' ?></p>
    </div>

</div>
<div class="related row">
    <div class = "col-lg-12">
        <h4><?= __('Parcours Associés') ?></h4>
        <?php if (!empty($specialite->parcours)): ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th><?= __('Titre') ?></th>
                        <th><?= __('Année') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($specialite->parcours as $parcours): ?>
                    <tr>
                        <td><?= h($parcours->title) ?></td>
                        <td><?= h($parcours->année) ?></td>
                        <td class="actions">
                            <?= $this->Html->link('<i class="fa fa-eye"></i> '.__('Voir'), ['controller' => 'Parcours','action' => 'view', $parcours->id],['class' =>'btn btn-default btn-xs', 'escape' => false]) ?>
                            <?= $this->Html->link('<i class="fa fa-pencil"></i> '.__('Modifier'), ['controller' => 'Parcours','action' => 'edit', $parcours->id], ['class' =>'btn btn-default btn-xs', 'escape' => false]) ?>
                            <?= $this->Form->postLink('<i class="fa fa-trash"></i>', ['controller' => 'Parcours','action' => 'delete', $parcours->id],['confirm' => __('Etes vous sur de vouloir supprimer # {0}?',$parcours->title), 'class' =>'btn btn-default btn-xs', 'escape'=> false]) ?>

                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>

