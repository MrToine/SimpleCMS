<?php
/**
 * @license     https://www.gnu.org/licenses/gpl-3.0.html GNU/GPL-3.0
 * @author      Anthony VIOLET
 * @version     SimpleFM 1.0 - 02/05/2020
 * @since       SimpleFM 1.1 - 02/05/2020
 * @contributor
 * @page        Utilitaire qui gère les menus
*/

class Menus extends Helpers {

    public $menu;

    public function __construct() {
        $this->Sessions = new Sessions();
    }

    public function submenu() {
        $object = $this->load_data('submenu');
        $this->menu = '<nav class="navigation"><ul>';
        if($this->Sessions->isLogged()){
            $role = $this->Sessions->read('User')->role;
        }else{
            $role = "visitor";
        }
        if(isset($object)){
            foreach ($object as $item) {
                /*
                    On gère d'aboir a l'aide d'un preg_match si le menu est de type "double" (Connexion;Deconnexion - users;users - login;logout)
                */
                if(preg_match('/;/', $item['name'])) {
                    $item['name'] = explode(';', $item['name']);
                    if(!$this->Sessions->isLogged()){
                        $item['name'] = $item['name'][0];
                    }else{
                        $item['name'] =$item['name'][1];
                    }
                }
                if(preg_match('/;/', $item['module'])) {
                    $item['module'] = explode(';', $item['module']);
                    if(!$this->Sessions->isLogged()){
                        $item['module'] = $item['module'][0];
                    }else{
                        $item['module'] =$item['module'][1];
                    }
                }
                if(preg_match('/;/', $item['action'])) {
                    $item['action'] = explode(';', $item['action']);
                    if(!$this->Sessions->isLogged()){
                        $item['action'] = $item['action'][0];
                    }else{
                        $item['action'] =$item['action'][1];
                    }
                }
                if($item['access'] === "visitor" && $role === "visitor"){
                    $this->menu .= '<li>'.Router::url($item['name'], [$item['module'], $item['action']]).'</li>';
                }
                /* Liens users */
                elseif($item['access'] === "user" || $item['access'] === "visitor"){
                    if($role === "user" || $role == "admin"){
                        $this->menu .= '<li>'.Router::url($item['name'], [$item['module'], $item['action']]).'</li>';
                    }
                }
                /* Liens admin */
                elseif($item['access'] === "user" || $item['access'] === "visitor" || $item['access'] === "admin"){
                    if($role === "admin"){
                        $this->menu .= '<li>'.Router::url($item['name'], [$item['module'], $item['action']]).'</li>';
                    }
                }
            }
            $this->menu .= '</ul></nav>';
        }
        return $this->menu;
    }

    public function get($file){
        return $this->load_data('$file');
    }
}
