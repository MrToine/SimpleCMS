<?php if(empty($post->name)): ?>
    <h1>Page introuvable :(</h1>
    <div class="alert--danger">
        <p>La page demandé n'a pas pu être afficher. L'url est peut être bonne ou la page spécifié n'existe pas/plus.</p>
        <p>Je vous propose de retourné à l'accueil. en suivant le lien suivant : <?= $this->url(ROOT, ["", ""]) ?></p>
    </div>
<?php else: ?>
<h1><?= $post->name; ?></h1>
<p><small>le <?= $post->created; ?> par <?= $post->author; ?></small></p>
<p><?= $post->content; ?></p>
<h4>Commentaires</h4>
<form class="" action="?m=posts&a=addcomment&id=<?= $post->id ?>" method="post">
    <?= $this->Form->input('author', 'Auteur') ?>
    <?= $this->Form->input('content', 'Contenu', ['type' => 'textarea', 'class' => 'wysiwg']) ?>
    <?= $this->Form->input('antispam', 'hidden', ["type" => 'hidden']) ?>
    <p>
        <input type="submit" class="btn--info"></input>
        <?php if ($this->Sessions->isLogged() && $this->Sessions->read('User')->role === "admin"): ?>
            <?= Router::url(
                "Modérer les commentaires",
                ["posts", "temple"],
                [
                    "admin" => "comments",
                    "class" => "btn--warning"
                ]
                ) ?>
        <?php endif; ?>
    </p>
</form>
<?php foreach ($comments as $comment): ?>
    <div class="box bordered-dark" style="background-color:#fff">
        <div class="head-box-container">Par <?= $comment->author ?> <small style="font-size:9pt;">le <?= $comment->created ?></small></div>
        <div class="padding-10">
            <?= $comment->content; ?>
        </div>
    </div><br />
<?php endforeach; ?>
<?php endif; ?>
