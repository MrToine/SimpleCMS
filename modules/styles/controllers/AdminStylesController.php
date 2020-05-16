<?php
class AdminStylesController extends AdminController {
    public function index() {
        if(!empty($this->request->params["admin"])){
            $action = $this->request->params["admin"];
        }else{
            $action = "";
        }

        switch($action) {
            case "delete":
                $this->delete();
                break;
            default:
                $this->default();
                break;
        }
    }

    private function default(){
        $value = [];
        $value_css = [];
        $folder = 'themes/';
        $entry_css = "";
        $valuefile = "";
        $valuefile_link = "";
        $link = "";
        $dir = opendir($folder) or die('Erreur');

        while($entry = @readdir($dir)) {
            if($entry != "." && $entry != ".." && $entry != "layout") {
                $value[] = $entry;
                $entry_css = 'themes/'.$entry.'/css/';
                $entry_css = opendir($entry_css) or die('Erreur');
                while($cssfiles = @readdir($entry_css)) {
                    if($cssfiles != "." && $cssfiles != "..") {
                        $value_css[$entry][] = $cssfiles;
                    }
                }
                closedir($entry_css);
            }
        }
        closedir($dir);

        if($_POST) {
            if(!empty($_POST['create'])) {
                debug($_POST);
                if($_POST['create_dir'] && $_POST['dirstyle'] == ""){
                    if(mkdir('themes/'.$_POST['create_dir'].'/css/', 0755, true)) {
                        $_POST['dirstyle'] = $_POST['create_dir'];
                    }
                }
                if(!file_exists("themes/".$_POST['dirstyle']."/css/".$_POST['create'].".css")){
                    $link = "themes/".$_POST['dirstyle']."/css/".$_POST['create'].".css";
                    $valuefile_link = fopen("themes/".$_POST['dirstyle']."/css/".$_POST['create'].".css", "w+");
                    fwrite($valuefile_link, '/* Créez votre style ici */');
                    $valuefile = fread($valuefile, filesize('themes/'.$_POST['dirstyle'].'/css/'.$_POST['create'].'.css'));
                }else{
                    $this->Sessions->set_flash('Le fichier <strong>'.$_POST['create'].'.css</strong> existes déjà.', 'danger');
                }
            }elseif($_POST['style']){
                $return_value = explode('_', $_POST['style']);
                $link = 'themes/'.$return_value[0].'/css/'.$return_value[1];
                $valuefile_link = fopen('themes/'.$return_value[0].'/css/'.$return_value[1], 'r');
                $valuefile = fread($valuefile_link, filesize('themes/'.$return_value[0].'/css/'.$return_value[1]));
            }elseif($_POST['valuefile']){
                debug($_POST);
                $valuefile_link = fopen($_POST['file_link'] , 'w+');
                fwrite($valuefile_link, $_POST['valuefile']);
                $this->redirect(["styles", ConfigApp::$admin_module_name], 301);
            }
        }

          $this->set([
              'styles' => $value,
              'files' => $value_css,
              'valuefile' => $valuefile,
              'valuefile_link' => $link,
          ]);

          $this->render();
        }

        private function delete() {
            if(empty($this->request->params['file'])) {
                $this->Sessions->set_flash('Le lien séléctionner n\'existes pas.', 'warning');
            }
            unlink('themes/'.$this->request->params['file']);
            $this->redirect(["styles", ConfigApp::$admin_module_name], 301);
        }
}
/*

*/
