<h1>Gestion des Pages</h1>
<?= Router::url(
    "Créer un billet",
    ["posts", "temple"],
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
    <?php foreach ($posts as $post): ?>
    <tr>
        <td><?= $post->id ?></td>
        <td><?= $post->name ?></td>
        <td></td>
        <td></td>
        <td><?= Router::url('<i class="far fa-eye"></i>', ["posts", "view"], ["id" => $post->id, "class" => "btn--primary"]) ?><?= Router::url('<i class="fas fa-edit"></i>', ["posts", "temple"], ["admin" => "edit", "id" => $post->id, "class" => "btn--warning"]) ?><?= Router::url('<i class="fas fa-trash-alt"></i>', ["posts", "temple"], ["admin" => "delete", "id" => $post->id, "class" => "btn--danger"]) ?></td>
    </tr>
    <?php endforeach; ?>
</table>
