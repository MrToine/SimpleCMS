<?php
session_start();
class Install {

    public function set_title($title) {
        $this->title = $title;
        return $this->title;
    }

    public function default() {
        $html = "<p>Bienvenue dans l'assistant d'installation de SimpleCMS. Pour débuter, veuillez renseigner les quelques informations ci-dessous : </p>";
        $html .= '<form action="install.php?step=2" method="post">';
        $html .= '<p><label for="1">Indiquez le dossier contenant les modules</label><input id="1" name="dir_modules" type="text" placeholder="" value="modules"></p>';
        $html .= '<p><label for="2">Indiquez le dossier contenant les themes</label><input id="2" name="dir_themes" type="text" placeholder="" value="themes"></p>';
        $html .= '<input type="submit"></form>';
        echo $html;
    }

    public function step2() {
        $html = "<p>Il est temps de préciser la page d'accueil par defaut, et les informations Administrateur.</p>";
        $html .= '<form action="install.php?step=3" method="post">';
        $html .= '<p><label for="1">Indiquez le module d\'accueil utiliser par defaut</label><input id="1" name="default_module" type="text" placeholder="" value="home"></p><p style="color:brown">Modules actuelles : (Home, Posts, Pages)</p>';
        $html .= '<p><label for="1">Indiquez le nom donner a l\'espace admin</label><input id="1" name="admin_name" type="text" placeholder="" value="admin"></p><br /><br />';
        $html .= '<p><label for="2">Indiquez le nom d\'utilisateur Admin</label><input id="2" name="username" type="text" placeholder="" value=""></p>';
        $html .= '<p><label for="3">Indiquez le mot de passe Admin</label><input id="3" name="password" type="password" placeholder="" value=""></p>';
        $html .= '<input type="submit"></form>';
        echo $html;
    }

    public function step3() {
        $html = '<p>L\'installation du CMS est terminé. Vous pouvez dès à présent vous rendre à <a href="index.php?m=posts&a=temple">l\'administration.</a></p>';
        echo $html;
    }
}

$step = "default";
if(!empty($_GET['step'])) {
    $step = $_GET['step'];
}
$install = new Install();
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head>
        <meta charset="utf-8">
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
                <?php
                $_SESSION['config_file'] = '
<?php
/**
 * @license     https://www.gnu.org/licenses/gpl-3.0.html GNU/GPL-3.0
 * @author      Anthony VIOLET
 * @version     SimpleFM 1.0 - 02/05/2020
 * @since       SimpleFM 1.1 - 02/05/2020
* @contributor
* @page        Contient la configuration générale du framework.
*/

class ConfigApp {

    static $debug = true; // Mettez a false pour passer en production';

                //$file = fopen('config/app.php', 'w+');
                //fwrite($file, $_SESSION['config_file']);
                switch($step) {
                    case 1:
                        echo '<h2>Mise en place de l\'installation</h2>';
                        $install->default();
                        break;
                    case 2:
                        echo '<h2>Mise en place de la configuration</h2>';
                        if($_POST){
                            $_SESSION['config_file'] .= '
    static $config_dir = [
        /*
            La première partie du tableau correspond au nom des dossiers utilisés.
            Ne modifier pas le nom à gauche qui correspond lui au nom de la variable du tableau.
            Il est aussi nécéssaire que les dossiers se trouve à la racine du siteweb.
        */
        "modules" => "'.$_POST['dir_modules'].'",
        "themes" => "'.$_POST['dir_themes'].'",
    ];';
                            //rename('modules', $_POST['dir_modules']);
                            //rename('themes', $_POST['dir_themes']);
                            $_SESSION['dir_modules'] = $_POST['dir_modules'];
                            $install->step2();
                        }else{
                            header('Location:?step=1');
                        }
                        break;
                    case 3:
                        if($_POST){
                            $_SESSION['config_file'] .= '
    static $admin_module_name = "'.$_POST['admin_name'].'";
    /*
        Permet de choisir les helpers à inclure (contenu du dossier utils)
    */
    static $helpers = ["Form", "Menus"];

    static $author = "'.$_POST['username'].'";

}';

                            $file = fopen($_SESSION['dir_modules'], 'w+');
                            $encrypt = sha1($_POST['username'].$_POST['password']);
                            $json_file = '{"1":{"id": "1","username": "'.$_POST['username'].'","password": "'.$encrypt.'","created": "'.date('d/m/Y').'","role": "admin","token": "'.$encrypt.'"}}';
                            fwrite($file, $json_file);
                            fclose($file);
                            $file = fopen('config/app.php', 'w+');
                            fwrite($file, $_SESSION['config_file']);
                            fclose($file);
                            session_destroy();
                            $install->step3();
                        }else{
                            header('Location:?step=1');
                        }
                        break;
                    default;
                    echo '<h2>Mise en place de l\'installation</h2>';
                    $install->default();
                }
                ?>
            </div>
        </div>
    </body>
</html>
