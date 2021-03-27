<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>SimpleCMS</title>
        <link rel="icon" type="image/x-icon" href="/favicon.ico" /><link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans|Play" media="all">
        <script src="https://kit.fontawesome.com/5ed09ba53b.js" crossorigin="anonymous"></script>
        <?php Router::css(['KNACSS-mini.css', 'editor.min', 'trumbowyg.colors.min','trumbowyg.emoji.min','generic']); ?>
    </head>
    <body class="gray-900">
        <section>
            <section class="grid-6 has-gutter light-color">
                <div></div>
                <div class="col-4">
                    <div class="header">
                        <p style="font-size:36pt;padding-left:170px;padding-top:50px;">SimpleCMS</p>
                        <p style="font-size:18pt;padding-left:200px;padding-top:-5px;color:#444545;"><i>Le Petit qui fait comme les Grands</i></p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="subheader sand-color">
                        <?= $this->Menus->submenu(); ?>
                    </div>
                </div>
                <div></div>
                <div></div>
                <div class="col-4">
                    <div class="main-page padding-10">
                        <?= $this->Sessions->flash(); ?>
                        <?= $output; ?>
                    </div>
                </div>
                <div></div>
                <div class="col-6 gray-900 footer">
                    <div class="grid-4 has-gutter">
                        <div class="footer-child"v>
                            <h5>Liens utiles</h5>
                            <ul class="unstyled">

                            </ul>
                        </div>
                        <div class="footer-child">
                            <h5>Le site web</h5>
                            <ul class="unstyled">

                            </ul>
                        </div>
                        <div class="footer-child">
                            <h5>HUB</h5>
                            <ul class="unstyled">

                            </ul>
                        </div>
                        <div class="footer-child">
                            <h5>Partenaires</h5>
                            <ul class="unstyled">

                            </ul>
                        </div>
                    </div>
                    <p style="font-size:8pt;">Copyright 2020 - Propulsé par <a href="http://universtoine.power-heberg.com" class="link-footer" target="_blank">SimpleCMS</a></p>
                </div>
            </section>
        </section>
    </body>
    <!-- Import jQuery -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="themes/default/js/vendor/jquery-3.3.1.min.js"><\/script>')</script>
    <?php Router::js(['editor/trumbowyg.min', 'editor/plugins/colors/trumbowyg.colors.min', 'editor/plugins/emoji/trumbowyg.emoji.min', 'editor/plugins/fontsize/trumbowyg.fontsize.min', 'editor/plugins/mention/trumbowyg.mention.min', 'editor/plugins/pasteimage/trumbowyg.pasteimage.min', 'editor/plugins/upload/trumbowyg.upload.min']); ?>
    <script>
        // Doing this in a loaded JS file is better, I put this here for simplicity
        $('.wysiwg').trumbowyg({
            btnsDef: {
                upload_p: {
                    fn: function() {
                         window.open("", "Upload", "menubar=no, status=no, scrollbars=no, menubar=no, width=500, height=500");
                    },
                    ico: 'upload'
                }
            },
            btns: [
                ['viewHTML'],
                ['emoji'],
                ['strong', 'em', 'del'],
                ['fontsize'],
                ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
                ['foreColor', 'backColor'],
                ['upload_p', 'insertImage'],
                //['upload'],
                //['mention'],
                ['link'],
                ['unorderedList', 'orderedList'],
                ['horizontalRule'],
                ['removeformat'],
            ],
            plugins: {
                upload: {
                    serverPath: '',
                    fileFieldName: 'image',
                }
            },
            changeActiveDropdownIcon: true
        });
    </script>
</html>
