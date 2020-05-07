<?php foreach ($posts as $post): ?>
    <h2><?= $post->name; ?></h2>
    <p><?= cut_txt($post->content, 50); ?><?= $this->url(
        '[Lire la suite]',
        ["posts", "view"],
        [
            "id" => $post->id,
        ]
    ); ?></p>
    <p class="fr"><small>Par <?= $post->author ?> le <?= $post->created ?> &times; <?= $post->comments ?> commentaire(s)</small></p>
<?php endforeach; ?>
