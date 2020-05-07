<h1>Editer l'edito</h1>
<form class="" action="" method="post">
    <input type="hidden" name="name" value="edito">
    <p><?php echo $this->Form->input('content', 'Contenu', array('class' => 'wysiwg', 'type' => 'textarea', 'cols' => 100, 'rows' => 15)); ?></p>
    <p><input type="submit" class="btn--info"></input></p>
</form>
