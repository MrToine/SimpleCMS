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

    public function submenu() {
        $object = $this->load_data('submenu');
        $this->menu = '<nav class="navigation"><ul>';
        if(isset($object)){
            foreach ($object as $item) {
                $this->menu .= '<li>'.Router::url($item['name'], [$item['module'], $item['action']]).'</li>';
            }
            $this->menu .= '</ul></nav>';
        }
        return $this->menu;
    }

    public function get($file){
        return $this->load_data('$file');
    }
}
