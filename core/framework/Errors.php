<?php
/**
 * @license     https://www.gnu.org/licenses/gpl-3.0.html GNU/GPL-3.0
 * @author      Anthony VIOLET
 * @version     SimpleFM 1.0 - 02/05/2020
 * @since       SimpleFM 1.1 - 02/05/2020
 * @contributor
 * @page        Gestion des erreurs lié au Core.
*/

class Errors {
    public static function file($file){

		die('File <strong>'.$file.'</strong> does not exists.');

	}

	public static function folder($dir){

		die('Folder <strong>'.$dir.'</strong> does not exists.');

	}

	public static function module($name) {

		die('Module <strong>'.$name.'</strong> does not exists.');

	}

    public static function controller($name) {

		die('Controller <strong>'.$name.'</strong> does not exists.');

	}
}
