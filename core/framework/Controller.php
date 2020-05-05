<?php
/**
 * @license     https://www.gnu.org/licenses/gpl-3.0.html GNU/GPL-3.0
 * @author      Anthony VIOLET
 * @version     SimpleFM 1.0 - 02/05/2020
 * @since       SimpleFM 1.1 - 05/05/2020
 * @contributor
 * @page        Description file
*/

class Controller {

    public $request;
    public $vars = [];
    public $layout = 'default';
    private $rendered = false;

    public function __construct($request) {
        /* Chargement des helpers */
        foreach (ConfigApp::$helpers as $value) {
            $value = ucfirst($value);
            require ROOT.'/core/utils/'.$value.'.php';
            $this->$value = new $value($this);
        }
        $this->Sessions = new Sessions();
        $this->request = $request;
    }

    public function render($view = null, $data = []) {
        /*
            On vérifie que le dossier view existe, pui le fichier (par defaut => nom_action.php). Si c'est le cas, on
            s'occupe d'afficher la vue.
        */
        if(!file_exists(ROOT.'/modules/'.Router::request()->module.'/views/')) {
            Errors::folder(ROOT.'/modules/'.Router::request()->module.'/views/');
        }
        if($view) {
            if(!file_exists(ROOT.'/modules/'.Router::request()->module.'/views/'.$view.'.php')){
                Errors::file(ROOT.'/modules/'.Router::request()->module.'/views/'.$view.'.php');
            }
            $this->request->view = $view;
        }else{
            if(!file_exists(ROOT.'/modules/'.Router::request()->module.'/views/'.Router::request()->action.'.php')){
                Errors::file(ROOT.'/modules/'.Router::request()->module.'/views/'.Router::request()->action.'.php');
            }else{
                $this->request->view = Router::request()->action;
            }
        }
        $view = ROOT.'/modules/'.Router::request()->module.'/views/'.Router::request()->action.'.php';
        if($this->rendered){
            return false;
        }
        extract($this->vars);
        $this->set($data);
        ob_start();
        require(ROOT.'/modules/'.Router::request()->module.'/views/'.$this->request->view.'.php');
        $output = ob_get_clean();
        require ROOT.'/themes/layout/'.$this->layout.'.php';
        $this->rendered = true;
    }

    public function set($key, $value = null) {
        /*
            On s'occupe de récupérer les variables pour les envoyer à une vue.
        */
        if(is_array($key)) {
            $this->vars += $key;
        }else{
            $this->vars[$key] = $value;
        }
    }

    public function loadModel($model, $path=null) {
        if(!file_exists(ROOT.'/modules/'.Router::request()->module.'/models/')){
            Errors::file(ROOT.'/modules/'.Router::request()->module.'/models/');
        }
        $model = ucfirst($model).'Model';
        $file = ROOT.'/modules/'.Router::request()->module.'/models/'.$model.'.php';
        require_once($file);
        if(!isset($this->$model)){
            return new $model('json', $path);
        }
    }

    public function redirect($url = [], $code = null) {
        if($code == 301){
            header("HTTP/1.1 301 Moved Parmanently");
        }
        if(!$url[2]){
            header('Location: ?m='.$url[0].'&a='.$url[1]);
        }
    }

    public function url($name, $url = [], $params = []) {
        $link = '<a href="?m='.$url[0].'&a='.$url[1];
        foreach($params as $key => $value) {
            $link .= '&'.$key.'='.$value;
        }
        $link .= '">'.$name.'</a>';

        return $link;
    }
}
