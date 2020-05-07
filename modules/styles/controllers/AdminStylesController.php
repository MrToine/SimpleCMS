<?php
class AdminStylesController extends AdminController {
    public function index(){
        $value = [];
        $value_css = [];
        $folder = 'themes/';
        $entry_css = "";
        $valuefile = "";

        $MyDirectory = opendir($folder) or die('Erreur');
        while($entry = @readdir($MyDirectory)) {
            if($entry != "layout"){
                if($entry != '.' && $entry != '..') {
                    $value[] = $entry;
                    $entry_css = 'themes/'.$entry.'/css/';
                    $entry_css = opendir($entry_css) or die('Erreur');
                    while($cssfiles = @readdir($entry_css)) {
                        if($cssfiles != '.' && $cssfiles != '..') {
                            $value_css[] = $cssfiles;
                        }
                    }
                    closedir($entry_css);
                }
            }
        }
        closedir($MyDirectory);

        if($_POST){
            $return_value = explode('_', $_POST['style']);
            $valuefile = fopen('themes/'.$return_value[0].'/css/'.$return_value[1], 'r');
            $valuefile = fread($valuefile, filesize('themes/'.$return_value[0].'/css/'.$return_value[1]));
         }

          $this->set([
              'styles' => $value,
              'files' => $value_css,
              'valuefile' => $valuefile
          ]);

          $this->render();
        }
}
