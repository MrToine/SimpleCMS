<?php
/**
 * @license     https://www.gnu.org/licenses/gpl-3.0.html GNU/GPL-3.0
 * @author      Anthony VIOLET
 * @version     SimpleFM 1.0 - 02/05/2020
 * @since       SimpleFM 1.1 - 02/05/2020
 * @contributor
 * @page        Contient plusieurs fonctions indépendantes utiles.
*/

function debug($var) {
    if(ConfigApp::$debug){
        $backtrace = debug_backtrace();
        echo '<p><a href="#" onclick="$(this).parent().next(\'ol\').slideToggle(); return false;"><strong>'.$backtrace[0]['file'].' line '.$backtrace[0]['line'].'</strong></a></p>';
        echo '<ol>';
        foreach ($backtrace as $key => $value) {
            if($key > 0) {
                echo '<li>'.$value['file'].'</strong> line '.$value['line'].'</li>';
            }
        }
        echo '</ol>';
        echo "<pre>";
        print_r($var);
        echo "</pre>";
    }
}
