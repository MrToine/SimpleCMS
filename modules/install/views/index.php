<?php if ($type === "home"): ?>
    <p>Bienvenue dans l'assistant d'installation de SimpleCMS. Pour débuter, veuillez renseigner les quelques informations ci-dessous : </p>
    <div class="alert--primary">
        <p>Les dossiers modules et themes correspondent au noms des dossiers présent sur votre espace d'hebergement. Si vous modifiez les noms des dossiers, assurez vous qu'ils soient correct.</p>
    </div>
    <form action="" method="post">
        <input type="hidden" name="type" value="home">
        <p><label for="1">Indiquez le dossier contenant les modules</label><input id="1" name="dir_modules" type="text" placeholder="" value="modules"></p>
        <p><label for="2">Indiquez le dossier contenant les themes</label><input id="2" name="dir_themes" type="text" placeholder="" value="themes"></p>
        <input type="submit">
    </form>
<?php elseif($type === "step2"): ?>
    <p>Bienvenue dans l'assistant d'installation de SimpleCMS. Pour débuter, veuillez renseigner les quelques informations ci-dessous : </p>
    <form action="" method="post">
        <input type="hidden" name="type" value="step2">
        <p><label for="1">Indiquez le module d'accueil utiliser par defaut</label><input id="1" name="default_module" type="text" placeholder="" value="home"></p><p style="color:brown">Modules actuelles : (Home, Posts, Pages)</p>
        <p><label for="1">Indiquez le nom donner a l'espace admin</label><input id="1" name="admin_name" type="text" placeholder="" value="admin"></p><br /><br />
        <p><label for="2">Indiquez le nom d'utilisateur Admin</label><input id="2" name="username" type="text" placeholder="" value=""></p>
        <p><label for="3">Indiquez le mot de passe Admin</label><input id="3" name="password" type="password" placeholder="" value=""></p>
        <input type="submit">
    </form>
<?php elseif($type === "step3"): ?>
    <div class="alert--success">
        <p>L'installation du CMS est terminé.</p>
    </div>
    <p>Vous pouvez dès à présent vous rendre à <a href="index.php?m=posts&a=temple">l'administration.</a> Avant de continuer il est fortement recommandé de de <strong>Supprimer le dossier install dans <underline><?= ROOT.'/modules/install/' ?></underline></strong></p>
<?php endif; ?>
<div class="alert--success">
    <span class="fl" style="font-size:22pt;color:darkgreen;"><i class="fas fa-info-circle"></i></span>
    <p style="padding-left:50px">Le CMS est en phase d'alpha. Il est important de savoir qu'il n'est pas <strong>conseillé</strong> en production. L'installation est destinée à des fins de développement ou de bug tracking. Vous pouvez rapporter des bus ou des failles de sécurité sur le forum : <a href="http://universtoine.power-heberg.com/site/forums/" target="_blank">lien</a></p>
    <p><a href="http://universtoine.power-heberg.com/" target="_blank">http://universtoine.power-heberg.com/</a></p>
</div>
