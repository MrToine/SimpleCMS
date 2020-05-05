<?php
/**
 * @license     https://www.gnu.org/licenses/gpl-3.0.html GNU/GPL-3.0
 * @author      Anthony VIOLET
 * @version     SimpleFM 1.0 - 02/05/2020
 * @since       SimpleFM 1.1 - 02/05/2020
 * @contributor
 * @page        Module qui permet de gérer une Base de données au format JSON
*/
class BddController extends Controller {
    public function index() {
        $tables = $this->list();
        $this->set(["tables" => $tables]);
        $this->render();
    }

    private function list(){
        $folder = opendir(ROOT.'/modules/');
        $tables = [];
        while($entry = @readdir($folder)){
            if($entry != "." && $entry != ".."){
                if(file_exists(ROOT.'/modules/'.$entry.'/data/')){
                    $tables[] = $entry;
                }
            }
        }
        return $tables;
    }

    public function view() {
        $tablename = $this->request->params["table"];
        $path = ROOT.'/modules/'.$tablename.'/data/'.$tablename.'.json';
        $data = [];
        if(!file_exists($path)) {
            $this->redirect(["bdd", "index"]);
        }

        $open = json_decode(file_get_contents($path), true);
        foreach ($open as $key => $value) {
            $data[] = $value;
        }

        $this->set([
            "name" => $tablename,
            "nb_entry" => count($open),
            "data" => $data,
            "i" => 1
        ]);
        $this->render();
    }
}
