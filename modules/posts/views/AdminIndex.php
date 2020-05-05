<?php foreach ($posts as $post): ?>
    <h2><?= $post->name; ?></h2>
    <p><?= $post->content; ?>...<?= $this->url(
        '[Lire la suite]',
        ["posts", "view"],
        [
            "id" => $post->id,
        ]
    ); ?></p>
<?php endforeach; ?>
