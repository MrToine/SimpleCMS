<h1>Gestion des Menus</h1>
<h3>Submenu</h3>
    <table class="table">
        <thead>
            <th class="head-box-container" style="width:5%">Pos</th>
            <th class="head-box-container">Affichage</th>
            <th class="head-box-container">Module pointer</th>
            <th class="head-box-container">Action Pointer</th>
            <th class="head-box-container"></th>
        </thead>
        <?php foreach ($menu as $item): ?>
            <tr>
                <form class="" action="" method="post">
                <input type="hidden" name="id" value="<?= $item->id ?>">
                <td><?= $item->id ?></td>
                <td><input type="text" name="name" value="<?= $item->name ?>"></td>
                <td><input type="text" name="module" value="<?= $item->module ?>"></td>
                <td><input type="text" name="action" value="<?= $item->action ?>"></td>
                <td><input type="submit" class="btn--info"></input> <?= Router::url("Tester le lien", [$item->module, $item->action], ["class" => "btn--success"]) ?> <?= Router::url('<i class="fas fa-trash-alt"></i>', ['menus', 'delete'], ["id" => $item->id, "class" => "btn--danger"]) ?></td>
                </form>
            </tr>
        <?php endforeach; ?>
            <th class="head-box-container" colspan="5">Nouvelle entrée</th>
        <tr>
            <form class="" action="" method="post">
            <input type="hidden" name="id" value="<?= $new_id ?>">
            <td><?= $new_id ?></td>
            <td><input type="text" name="name"></td>
            <td><input type="text" name="module"></td>
            <td><input type="text" name="action"></td>
            <td><input type="submit" class="btn--info"></td>
            </form>
        </tr>
    </table>
