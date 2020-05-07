<h1>Gestion des Commentaires</h1>
<table class="table">
    <thead>
        <th class="head-box-container" width="5%">Id</th>
        <th class="head-box-container" width="40%">Post concerné</th>
        <th class="head-box-container">Auteur</th>
        <th class="head-box-container">Date</th>
        <th class="head-box-container">Actions</th>
    </thead>
    <tbody>
        <?php foreach ($comments as $comment): ?>
            <tr>
                <td><?= $comment->id ?></td>
                <td><?= Router::url('/?m=posts&a=view&id='.$comment->id_post, ['posts', 'view'], ['id' => $comment->id_post]) ?></td>
                <td><?= $comment->author ?></td>
                <td><?= $comment->created ?></td>
                <td>
                    <?= Router::url('<i class="fas fa-trash-alt"></i>', ["posts", "temple"], ["admin" => "commentdelete", "id" => $comment->id, "class" => "btn--danger"]) ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
