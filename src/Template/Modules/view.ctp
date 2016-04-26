<h2><?= h($module->title) ?>
<div class="btn-group pull-right">
    <?= $this->Html->link('<i class="fa fa-plus"></i> '.__('Nouveau groupe'), ['controller' => 'groupes', 'action' => 'add', 'module_id' => $module->id], ['class' => 'btn btn-success ', 'role' => 'button', 'escape' => false]); ?>
    <?= $this->Html->link(__('Retour à la liste des modules'), ['action' => 'index'], ['class' => 'btn btn-info']) ?>
</div>
</h2>
<hr class="colorgraph"/>

<div class="related row">
        <div class = "col-lg-12">
            <h4><?= __('Groupes associés à ce module') ?>
            </h4>
            <?php if (!empty($module->groupes)): ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th><?= __('Capacité') ?></th>
                        <th><?= __('Période') ?></th>
                        <th><?= __('Parcours') ?></th>
                        <th><?= __('UE optionnelle') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($module->groupes as $groupes): ?>
                    <tr>
                        <td><?= h($groupes->capacite) ?></td>
                        <td><?= h($groupes->periode->full_title) ?></td>
                        <td>
                            <?php foreach($groupes->parcours as $parcours): ?>
                                <?=
                                    h($parcours->specialite->mention->title) . ' ▸ ' .
                                    h($parcours->specialite->title) . ' ' .
                                    h($parcours->année) . ' ▸ ' .
                                    h($parcours->title) . '<br />'
                                ?>
                            <?php endforeach; ?>
                        </td>
                        <td><?= ($groupes->obligatoire == 1) ? "Non" : "Oui" ?></td>
                        <td class="actions">
                            <?= $this->Html->link('<i class="fa fa-pencil"></i> '.__('Modifier'), ['controller' => 'groupes', 'action' => 'edit', $groupes->id], ['class' => 'btn btn-default btn-xs', 'escape' => false]) ?>
                            <?= $this->Form->postLink('<i class="fa fa-trash"></i>', ['controller' => 'groupes', 'action' => 'delete', $groupes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $groupes->id), 'class' => 'btn btn-default btn-xs', 'escape' => false]) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
        </table>
        <?php else: ?>
            <div class="alert alert-info">
                <i class="fa fa-info-circle fa fa-3x pull-left"></i>
                Aucun groupe n'a pour le moment été défini pour ce module. Pour commencer, <?= $this->Html->link(__('ajoutez un groupe au module'), ['controller' => 'groupes', 'action' => 'add', 'module_id' => $module->id]) ?>.<br />
                Les groupes vous permettent de "réserver" un certain nombre de places pour des étudiants provenant de parcours différents et déterminent ainsi quels modules sont accessibles à quels étudiants..<br />
            </div>
        <?php endif; ?>
    </div>
</div>

