<h1>Editer le post</h1>
<form class="" action="" method="post">
    <?= $this->Form->input('id', 'hidden'); ?>
    <p><?= $this->Form->input('name', 'Titre'); ?></p>
    <p><?= $this->Form->input('content', 'Contenu', array('class' => 'wysiwg', 'type' => 'textarea', 'cols' => 100, 'rows' => 15)); ?></p>
    <p><input type="submit" class="btn--info"></input></p>
</form>
