<h1>Créer une page</h1>
<form class="" action="" method="post">
    <input type="hidden" name="id" value="<?= $id ?>">
    <p><?= $this->Form->input('name', 'Titre de la page') ?></p>
    <p><?= $this->Form->input('content', 'Contenu', array('class' => 'wysiwg', 'type' => 'textarea', 'cols' => 100, 'rows' => 15)); ?></p>
    <p><input type="submit" class="btn--info"></input></p>
    <p></p>
</form>
