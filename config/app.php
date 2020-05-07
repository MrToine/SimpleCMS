<?php
/**
 * @license     https://www.gnu.org/licenses/gpl-3.0.html GNU/GPL-3.0
 * @author      Anthony VIOLET
 * @version     SimpleFM 1.0 - 02/05/2020
 * @since       SimpleFM 1.1 - 02/05/2020
 * @contributor
 * @page        Contient la configuration générale du framework.
*/

class ConfigApp {

    static $debug = true; // Mettez a false pour passer en production


    static $config_dir = [
        /*
            La première partie du tableau correspond au nom des dossiers utilisés.
            Ne modifier pas le nom à gauche qui correspond lui au nom de la variable du tableau.
            Il est aussi nécéssaire que les dossiers se trouve à la racine du siteweb.
        */
        "modules" => "modules",
        "assets" => "themes",
    ];

    static $module_default = "home";

    static $admin_module_name = "temple";

    /*
        Permet de choisir les helpers à inclure (contenu du dossier utils)
    */
    static $helpers = ["Form", "Menus"];

    static $author = "Auteur";
}
