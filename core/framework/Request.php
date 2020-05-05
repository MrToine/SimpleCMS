<?php
/**
 * @license     https://www.gnu.org/licenses/gpl-3.0.html GNU/GPL-3.0
 * @author      Anthony VIOLET
 * @version     SimpleFM 1.0 - 02/05/2020
 * @since       SimpleFM 1.1 - 02/05/2020
 * @contributor
 * @page        Classe qui permet de gérer les requêtes passé aux urls
*/

class Request {

    public $uri = [];
    public $module;
    public $action;
    public $params;
    public $data = false;
    public $view;

    function __construct(){
        /*
            On commence par attribuer les valeurs par défaut aux variables. Ensuite on
            attribue à la variable $this->request un tableau contenu le nom du module et de l'action.
        */
        if(isset($_GET['m'])){
            $this->module = $_GET['m'];
            if(empty($this->module)){
                $this->module = "home";
            }
        }
        if(isset($_GET['a'])){
            $this->action = $_GET['a'];
        }

        $this->uri = $_GET;
        $this->uri[] = $this->view;

        $this->data = new stdClass();
        foreach($_POST as $key => $value) {
            $this->data->$key = $value;
        }

        return $this->uri;
    }
}
