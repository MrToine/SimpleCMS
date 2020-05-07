<?php
/**
 * @license     https://www.gnu.org/licenses/gpl-3.0.html GNU/GPL-3.0
 * @author      Anthony VIOLET
 * @version     SimpleFM 1.0 - 02/05/2020
 * @since       SimpleFM 1.1 - 07/05/2020
 * @contributor
 * @page        Contient plusieurs fonctions indépendantes utiles.
*/

function debug($var) {
    if(ConfigApp::$debug){
        $backtrace = debug_backtrace();
        echo '<p><a href="#" class="link-footer" onclick="$(this).parent().next(\'ol\').slideToggle(); return false;"><strong>'.$backtrace[0]['file'].' line '.$backtrace[0]['line'].'</strong></a></p>';
        echo '<ol style="display:none">';
        foreach ($backtrace as $key => $value) {
            if($key > 0) {
                echo '<li>'.$value['file'].'</strong> line '.$value['line'].'</li>';
            }
        }
        echo '</ol>';
        echo "<pre>";
        print_r($var);
        echo "</pre>";
    }else{
        error_reporting(0);
    }
}

function cut_txt($content, $nb_word) {
    /*
        Permet de couper un texte en fonction du nombre de caractères
    */
    $content = explode(' ', $content);
    if(count($content) > $nb_word && $nb_word > 0) {
        $content = implode(' ', array_slice($content, 0, $nb_word)).'...';
    }
    return $content;
}
