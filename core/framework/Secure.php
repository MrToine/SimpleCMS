<?php
/**
 * @license     https://www.gnu.org/licenses/gpl-3.0.html GNU/GPL-3.0
 * @author      Anthony VIOLET
 * @version     SimpleFM 1.0 - 03/05/2020
 * @since       SimpleFM 1.1 - 03/05/2020
 * @contributor
 * @page        Cette classe gère tout ce qui rapporte à la sécurité du Framework
*/

class Secure {

    public $excluded = ["themes"];

    public function cms($folder) {
        /*
            On liste tous les dossiers du CMS et on vérifie qu'un fichier .htaccess(deny from all)
            existes dans les dossiers sensibles. Si c'est pas le cas, on le créer.
        */
        $MyDirectory = opendir($folder) or die('Erreur');
        while($entry = @readdir($MyDirectory)) {
            if($entry == "themes") {
                return false;
            }
            if(!file_exists('data.ini') && $entry != '.' && $entry != '..') {
                echo 'Aucun fichier ".htaccess" dans le dossier '.$entry.'<br />';
                //fwrite('.htaccess', 'Deny from all');
            }
            if(is_dir($folder.'/'.$entry) && $entry != '.' && $entry != '..') {
                $this->cms($folder.'/'.$entry);
            }
        }
      closedir($MyDirectory);
    }

    public function liste_files($folder) {
        $MyDirectory = opendir($folder) or die('Erreur');
        while($entry = @readdir($MyDirectory)) {
            if($entry == "themes") {
                return false;
            }
            if(is_dir($folder.'/'.$entry) && $entry != '.' && $entry != '..') {
                             echo '<ul>'.$entry;
                $this->data($folder.'/'.$entry);
                            echo '</ul>';
            }else{
                if($entry != '.' && $entry != '..') {
                    echo '<li>'.$entry.'</li>';
                }
            }
        }
      closedir($MyDirectory);
    }
}
