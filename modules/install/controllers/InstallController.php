<?php
class InstallController extends Controller {
    public $layout = "empty";

    public function index($type) {
        $this->request->uri['a'] = "";

        if($_POST){
            if ($_POST['type'] === "home") {
                $this->Sessions->write('dirs', [
                    'modules' => $_POST['dir_modules'],
                    'themes' => $_POST['dir_themes']
                ]);
                $this->set(['type' => 'step2']);
            }

            if ($_POST['type'] === "step2") {
                $this->Sessions->write('default_vars', [
                    'default_module' => $_POST['default_module'],
                    'admin_name' => $_POST['admin_name'],
                    'username' => $_POST['username'],
                    'password' => $_POST['password']
                ]);
                $configfile = '<?php
                /**
                 * @license     https://www.gnu.org/licenses/gpl-3.0.html GNU/GPL-3.0
                 * @author      Anthony VIOLET
                 * @version     SimpleFM 1.0 - 02/05/2020
                 * @since       SimpleFM 1.1 - 13/05/2020
                 * @contributor
                 * @page        Contient la configuration générale du framework.
                */

                class ConfigApp {

                    static $debug = false; // Mettez a false pour passer en production


                    static $config_dir = [
                        /*
                            La première partie du tableau correspond au nom des dossiers utilisés.
                            Ne modifier pas le nom à gauche qui correspond lui au nom de la variable du tableau.
                            Il est aussi nécéssaire que les dossiers se trouve à la racine du siteweb.
                        */
                        "modules" => "modules",
                        "assets" => "modules",
                    ];

                    static $module_default = "'.$_SESSION['default_vars']['default_module'].'";

                    static $admin_module_name = "'.$_SESSION['default_vars']['admin_name'].'";

                    /*
                        Permet de choisir les helpers à inclure (contenu du dossier utils)
                    */
                    static $helpers = ["Form", "Menus"];

                    static $author = "'.$_SESSION['default_vars']['username'].'";
                }';
                $encrypt = sha1($_SESSION['default_vars']['username']).sha1($_SESSION['default_vars']['password']);
                $jsonfile = '{"1":{"id": "1","username": "'.$_SESSION['default_vars']['username'].'","password": "'.$encrypt.'","created": "'.date('d/m/Y').'","role": "admin","token": "'.$encrypt.'"}}';
                $jsonmenu = '{"2":{"id":"2","name":"Billets","module":"posts","action":"home","access":"visitor"},"4":{"id":"4","name":"Connexion;Déconnexion","module":"users","action":"login;logout","access":"visitor"},"5":{"id":"5","name":"Gestion menus","module":"menus","action":"'.$_SESSION['default_vars']['admin_name'].'","access":"admin"},"6":{"id":"6","name":"Gestion des pages","module":"pages","action":"'.$_SESSION['default_vars']['admin_name'].'","access":"admin"},"7":{"id":"7","name":"Gestion de l\'édito","module":"home","action":"'.$_SESSION['default_vars']['admin_name'].'&admin=edit","access":"admin"},"8":{"id":"8","name":"Gestion billets","module":"posts","action":"'.$_SESSION['default_vars']['admin_name'].'","access":"visitor"},"9":{"id":"9","name":"Administration","module":"home;posts","action":"index;'.$_SESSION['default_vars']['admin_name'].'","access":"visitor"}}';

                $file = fopen(ROOT.'/config/app.php', 'w+');
                fwrite($file, $configfile);
                fclose($file);


                $file = fopen(ROOT.'/modules/users/data/users.json', 'w+');
                fwrite($file, $jsonfile);
                fclose($file);

                $file = fopen(ROOT.'/core/data/submenu.json', 'w+');
                fwrite($file, $jsonmenu);
                fclose($file);

                session_destroy();
                $this->set(['type' => 'step3']);
            }
        }
        $this->set(['type' => 'step2']);
        $this->render();
    }
}
