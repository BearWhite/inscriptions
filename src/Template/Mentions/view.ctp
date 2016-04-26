<h2> Voir <?php echo $mention->title?>

<span class="btn-group pull-right">

    <?= $this->Html->link(__('Retour à la liste des mentions'), ['action' => 'index'],['class' => 'btn btn-info']) ?>
    <?= $this->Html->link(__('Modifier la mention'), ['action' => 'edit', $mention->id],['class' => 'btn btn-primary']) ?>
    <?= $this->Form->postLink(__('Supprimer la mention'), ['action' => 'delete', $mention->id], array('class' =>'btn btn-danger','confirm' => __('Etes-vous sur de vouloir supprimer la mention "{0}"?', $mention->title))) ?>
</span>
</h2>
<hr class="colorgraph">

<div class="related row">
    <div class = "col-lg-12">
        <h4><?= __('Specialités Associés') ?></h4>
        <?php if (!empty($mention->specialites)): ?>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th><?= __('Titre') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($mention->specialites as $specialite): ?>
                    <tr>
                        <td><?= h($specialite->title) ?></td>
                        <td class="actions">
                            <?= $this->Html->link('<i class="fa fa-eye"></i> '.__('Voir'), ['controller' => 'Specialites','action' => 'view', $specialite->id],['class' =>'btn btn-default btn-xs', 'escape' => false]) ?>
                            <?= $this->Html->link('<i class="fa fa-pencil"></i> '.__('Modifier'), ['controller' => 'Specialites','action' => 'edit', $specialite->id], ['class' =>'btn btn-default btn-xs', 'escape' => false]) ?>
                            <?= $this->Form->postLink('<i class="fa fa-trash"></i>', ['controller' => 'Specialites','action' => 'delete', $specialite->id],['confirm' => __('Etes vous sur de vouloir supprimer # {0}?',$mention->title), 'class' =>'btn btn-default btn-xs', 'escape'=> false]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>