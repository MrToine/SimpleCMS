<h1>Gestion des Styles</h1>
<div class="grid-2">
    <div>
        <form action="" method="post">
            <?= $this->Form->input('create', 'Créer un nouveau style') ?>
            <select id="choice" name="dirstyle">
                <option value=""></option>
                <?php foreach ($styles as $style): ?>
                    <option value="<?= $style ?>"><?= $style ?></option>
                <?php endforeach; ?>
            </select>
            <?= $this->Form->input('create_dir', 'Ou créer un dossier :') ?>
            <p><input type="submit" name="" value="Créer le fichier"></p>
        </form>
    </div>
    <div>
        <?php foreach ($styles as $style): ?>
            <div class="fl padding-10" style="border-right:1px solid grey">
            <h4><?= $style ?></h4>
            <?php foreach ($files[$style] as $file): ?>
                <p><?= Router::url('<i class="fas fa-trash-alt"></i>', ['styles', ConfigApp::$admin_module_name], ["admin" => "delete", "file" => "$style/css/$file", "onclick" => "confirm('Voulez-vous vraiment supprimer ce fichier ?.')", "style" => "color:red"]) ?> <?= $file ?></p>
            <?php endforeach; ?>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<hr />
<form action="" method="post">
    <label for="choice">Choix du fichier à éditer</label>
    <select id="choice" name="style">
        <option value=""></option>
        <?php foreach ($styles as $style): ?>
            <optgroup label="<?= $style ?>">
                <?php foreach ($files[$style] as $file): ?>
                    <option value="<?= $style ?>_<?= $file ?>"><?= $file ?></option>
                <?php endforeach; ?>
            </optgroup>
        <?php endforeach; ?>
    </select>
    <input type="submit" class="btn--success">
</form>
<?php if ($_POST): ?>
    <form action="" method="post">
        <input type="hidden" name="file_link" value="<?= $valuefile_link ?>">
        <textarea name="valuefile" rows="50" cols="100"><?= $valuefile ?></textarea>
        <p><input type="submit" class="btn--success"></p>
    </form>
<?php endif; ?>
