<?php
if(!empty($post->id)){
    $id = $post->id;
}
?>
<h1>Créer un billet</h1>
<form class="" action="" method="post">
    <input type="hidden" name="id" value="<?= $id ?>">
    <p><?= $this->Form->input('name', 'Titre du billet') ?></p>
    <p><?= $this->Form->input('content', 'Contenu', array('class' => 'wysiwg', 'type' => 'textarea', 'cols' => 100, 'rows' => 15)); ?></p>
    <p><input type="submit" class="btn--info"></input></p>
    <p></p>
</form>
