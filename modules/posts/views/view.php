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
<?php endif; ?>
