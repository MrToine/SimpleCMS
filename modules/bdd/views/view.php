<h1>Table '<?= $name; ?>'</h1>
<p>Il y a <?= $nb_entry; ?> entrée(s) présente(s).</p>
<table class="table">
    <thead>
        <th class="head-box-container" style="width:10%">#</th>
        <th class="head-box-container">Nom du champ</th>
        <th class="head-box-container">Actions</th>
    </thead>
    <?php foreach ($data[0] as $k => $v): ?>
        <tr>
            <td><?= $i; ?></td>
            <td><?= $k; ?></td>
            <td><?= $this->url("Modifier",
            ["bdd", "edit"],
            ["field" => $k]) ?>
            <?= $this->url("Supprimer",
            ["bdd", "delete"],
            ["field" => $k]) ?>
        </tr>
        <?php $i++; ?>
    <?php endforeach; ?>
</table>
