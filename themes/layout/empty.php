<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head>
        <meta charset="utf-8">
        <link rel="icon" type="image/x-icon" href="/favicon.ico" /><link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
        <link rel="stylesheet" href="https://rawgit.com/alsacreations/KNACSS/master/css/knacss-unminified.css" media="all">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans|Play" media="all">
        <script src="https://kit.fontawesome.com/5ed09ba53b.js" crossorigin="anonymous"></script>
        <?php Router::css(['editor.min', 'trumbowyg.colors.min','trumbowyg.emoji.min','generic']); ?>
        <title>Installation de SimpleCMS</title>
        <style type="text/css">
            .main {
                margin:auto;
                margin-top: 50vh;
                transform: translateY(-50%);
                width:700px;
            }
            .section {
                min-height:500px;
                border:1px solid black;
                background-color:#D8E3E3;
                padding:10px;
            }
            label {
                width:200px;
                margin-right:50px;
            }
        </style>
    </head>
    <body>
        <div class="main">
            <header>
                <img class="logo" src="themes/default/images/logo04.png" alt="">
            </header>
            <div class="section">
                <?= $output; ?>
            </div>
        </div>
    </body>
</html>
