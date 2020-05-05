<?php
/**
 * @license     https://www.gnu.org/licenses/gpl-3.0.html GNU/GPL-3.0
 * @author      Anthony VIOLET
 * @version     SimpleFM 1.0 - 02/05/2020
 * @since       SimpleFM 1.1 - 02/05/2020
 * @contributor
 * @page        Class permettant de gérer les helpers
*/
class Helpers {
    public $controller;

    public function __construct($controller) {
        $this->controller = $controller;
    }

    public function load_data($file) {
        $file = ROOT.'/core/data/'.$file.'.json';
        return json_decode(file_get_contents($file), true);
    }
}
