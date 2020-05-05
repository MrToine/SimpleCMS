<?php if(empty($page->name)): ?>
    <h1>Page introuvable :(</h1>
    <div class="alert--danger">
        <p>La page demandé n'a pas pu être afficher. L'url est peut être bonne ou la page spécifié n'existe pas/plus.</p>
        <p>Je vous propose de retourné à l'accueil. ensuivant le lien suivant : <?= $this->url(ROOT, ["", ""]) ?></p>
    </div>
<?php else: ?>
    <h1><?= $page->name; ?></h1>
    <p><?= $page->content; ?></p>
<?php endif; ?>
