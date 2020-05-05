<?php
/**
 * @license     https://www.gnu.org/licenses/gpl-3.0.html GNU/GPL-3.0
 * @author      Anthony VIOLET
 * @version     SimpleFM 1.0 - 02/05/2020
 * @since       SimpleFM 1.1 - 02/05/2020
 * @contributor
 * @page        Classe contenu la gestion du routing
*/

class Router {

    static $routes = [];
    static $params = [];
    static $request;

    static function parse($request) {
        /*
            On scinde la variable request pour séparé le module, l'action, et les paramètres.
            Ensuite on liste le tout pour récupérer uniquement les paramètres passer en url.
        */
        $request->module = (string)$request->module;
        $request->action = (string)$request->action;

        foreach($request->uri as $key => $value) {
            self::$params[$key] = $value;
        }
        foreach(self::$params as $k => $v) {
            if($k == 'm' || $k == 'a'){
                unset(self::$params[$k]);
            }
        }
        //self::$params = array_shift(self::$params);

        $request->params = self::$params;
        self::$request = $request;
        return $request;
    }

    static function request(){
        return self::$request;
    }

    static function url($name, $url = [], $params = []) {
        $link = '<a href="?m='.$url[0].'&a='.$url[1];
        foreach($params as $key => $value) {
            if($key === "class"){
                $link .= '" '.$key.'="'.$value;
            }else{
                $link .= '&'.$key.'='.$value;
            }
        }
        $link .= '">'.$name.'</a>';

        return $link;
    }

    static function css($files = []) {
        foreach($files as $value){
            echo '<link rel="stylesheet" href="'.BASE_URL.'/themes/default/css/'.$value.'.css" media="all">';
        }
    }

    static function js($files = []) {
        foreach($files as $value){
            echo '<script type="text/javascript" src="'.BASE_URL.'/themes/default/js/'.$value.'.js"></script>';
        }
    }
}
