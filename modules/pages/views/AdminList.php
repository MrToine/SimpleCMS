<h1>Gestion des Pages</h1>
<?= Router::url(
    "Créer une page",
    ["pages", "temple"],
    [
        "admin" => "create",
        "class" => "btn--primary"
    ]
) ?>
<table class="table">
    <thead>
        <th class="head-box-container" style="width:5%">Id</th>
        <th class="head-box-container" style="width:50%">Titre</th>
        <th class="head-box-container">Auteur</th>
        <th class="head-box-container">Date decréation</th>
        <th class="head-box-container">Actions</th>
    </thead>
    <?php foreach ($pages as $page): ?>
    <tr>
        <td><?= $page->id ?></td>
        <td><?= $page->name ?></td>
        <td></td>
        <td></td>
        <td><?= Router::url('<i class="far fa-eye"></i>', ["pages", "view"], ["id" => $page->id, "class" => "btn--primary"]) ?><?= Router::url('<i class="fas fa-edit"></i>', ["pages", "temple"], ["admin" => "edit", "id" => $page->id, "class" => "btn--warning"]) ?><?= Router::url('<i class="fas fa-trash-alt"></i>', ["pages", "temple"], ["admin" => "delete", "id" => $page->id, "class" => "btn--danger"]) ?></td>
    </tr>
    <?php endforeach; ?>
</table>
