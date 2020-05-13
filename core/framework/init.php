<?php
/**
 * @license     https://www.gnu.org/licenses/gpl-3.0.html GNU/GPL-3.0
 * @author      Anthony VIOLET
 * @version     SimpleFM 1.0 - 02/05/2020
 * @since       SimpleFM 1.1 - 13/05/2020
 * @contributor
 * @page        Première Classe appelée par root/index.php elle permet d'initialiser
 *              le site et d'appelée les classes et fonctions indispensable.
*/

class Init {

    public $request;

    public function __construct(){
        require ROOT.'/core/framework/Sessions.php';
        require ROOT.'/core/framework/Errors.php';
        require ROOT.'/core/utils/functions.php';
        (file_exists(ROOT.'/config/app.php'))?require ROOT.'/config/app.php':require ROOT.'/config/app-default.php';
        require ROOT.'/config/routes.php';
        require ROOT.'/core/framework/Request.php';
        require ROOT.'/core/framework/Router.php';
        require ROOT.'/core/framework/Helpers.php';
        require ROOT.'/core/framework/Controller.php';
        require ROOT.'/core/framework/AdminController.php';
        require ROOT.'/core/framework/Model.php';
        require ROOT.'/core/framework/Secure.php';
    }

    public function load_core(){
        /*
            On vérifie d'abord que le fichier config/app.php existes. si c'est pas le cas on lance l'installation

            Dans cette fonction, on va chercher à récupérer le module passer en echo url
            sous la forme : monsite.com/controller/action où controller est la classe et action est la fonction
            si aucun controller est précisé alors on affiche un par defaut. Si aucune action n'est préciser alors
            on affiche une par défaut.
        */
        $this->request = new Request();
        $this->request = Router::parse($this->request);

        if(!file_exists('config/app.php')){
            $this->request->module = "install";
            $this->request->action = "index";
        }

        $module = ROOT.'/'.ConfigApp::$config_dir['modules'].'/'.$this->request->module.'/';
        $action = $this->request->action;
        /*
            On parcours le dossier "module" afin de voir si il existe. Si c'est pas le cas, alors on renvoie
            une erreur.
        */
        if(empty($this->request->module)){
            $this->request->module = ConfigApp::$module_default;
        }
        if(!file_exists($module)){
            Errors::module($this->request->module);
        }
        $this->request->module = $this->load_module();
    }

    public function load_module() {
        /*
            On vérifie si le mot clé 'Admin' débute le nom du fichier. Si c'est le cas alors on charge le controller.

            On vérifie que le fichier existe bien (NomController.php) dans le dossier "controller" du module.
            Si il existe, alors on l'inclus et on créer une nouvelle instance de classe.
            Et enfin, on charge l'action défini par $this->request->action. Si celle-ci n'existe pas, on en
            charge une par défaut.
        */

        $name = ucfirst($this->request->module).'Controller';

        if($this->request->action == ConfigApp::$admin_module_name) {
            $name = "Admin".$name;
        }

        $module_file = ROOT.'/'.ConfigApp::$config_dir['modules'].'/'.$this->request->module.'/controllers/'.$name.'.php';


        if(!file_exists($module_file)){
            Errors::controller($module_file);
        }else{
            require_once $module_file;
            $controller = new $name($this->request);
            if(!in_array($this->request->action, array_diff(get_class_methods($controller), get_class_methods("Controller")))) {
                $this->request->action = 'index';
            }
            call_user_func_array(array($controller, $this->request->action), array($this->request->params));
        }
    }
}
