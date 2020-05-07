<h1>Gestion des Styles</h1>
<form action="" method="post">
    <label for="choice">Choix du fichier à éditer</label>
    <select id="choice" name="style">
        <option value=""></option>
        <?php foreach ($styles as $style): ?>
            <optgroup label="<?= $style ?>">
                <?php foreach ($files as $file): ?>
                    <option value="<?= $style ?>_<?= $file ?>"><?= $file ?></option>
                <?php endforeach; ?>
            </optgroup>
        <?php endforeach; ?>
    </select>
    <input type="submit" class="btn--success">
</form>
<?php if ($_POST): ?>
    <form action="" method="post">
        <textarea name="valuefile" rows="50" cols="100"><?= $valuefile ?></textarea>
        <p><input type="submit" class="btn--success"></p>
    </form>
<?php endif; ?>
