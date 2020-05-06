<h1>Gestion des Menus</h1>
<div class="alert--info">
<p class="fl padding-10"><i class="fas fa-info" style="font-size:16pt;color:blue;"></i></p>
<p>Pour définir des liens différents si l'utilisateur est connecté ou déconnecté, vous pouvez utiliser un point virgule pour séparer les actions. Le lien dois être accessible <strong>à tout le monde</strong> pour que cela fonctionne.</p>
<p>Exemple: </p>
<table class="table">
    <thead>
        <th>Affichage</th>
        <th>Module pointer</th>
        <th>Action pointer</th>
        <th>Autorisation</th>
    </thead>
    <tr>
        <td>Connexion;Déconnexion</td>
        <td>users;users</td>
        <td>login;logout</td>
        <td><strong>Toue le monde</strong></td>
    </tr>
</table>
<p>Lorsque le nom du module, de l'action, ou d'affichage est le même, il n'est pas nécéssaire de mettre deux fois la même chose.</p>
</div>
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
                    <td>
                        <button value="" type="submit" class="btn--info"><i class="fas fa-check"></i></button><?= Router::url('<i class="fas fa-eye"></i>', [$item->module, $item->action], ["class" => "btn--success"]) ?><?= Router::url('<i class="fas fa-trash-alt"></i>', ['menus', 'temple'], ["admin" => "delete", "id" => $item->id, "class" => "btn--danger"]) ?>
                        <select name="access">
                            <option selected="selected" value="<?= $item->access ?>"><?= $item->access ?></option>
                            <option value="visitor">Tout le monde</option>
                            <option value="user">Membre</option>
                            <option value="admin">Admin</option>
                        </select>
                    </td>
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
            <td>
                <input type="submit" class="btn--info">
                <select name="access">
                    <option selected="selected" value="visitor">Tout le monde</option>
                    <option value="user">Membre</option>
                    <option value="admin">Admin</option>
                </select>
            </td>
            </form>
        </tr>
    </table>
