<h1>Gestion de la Base de données</h1>
<h3>Liste des Tables</h3>
<table class="table">
    <thead>
        <th class="head-box-container">Nom de la table</th>
        <th class="head-box-container">Actions</th>
    </thead>
    <?php foreach ($tables as $table): ?>
        <tr>
            <td><?= $table; ?></td>
            <td><?= $this->url("Voir",
            ["bdd", "view"],
            ["table" => $table]) ?>
            <?= $this->url("Supprimer",
            ["bdd", "delete"],
            ["table" => $table]) ?>
            <?= $this->url("Vider",
            ["bdd", "drop"],
            ["table" => $table]) ?>
            <?= $this->url("Optimiser",
            ["bdd", "optimize"],
            ["table" => $table]) ?></td>
        </tr>
    <?php endforeach; ?>
</table>
