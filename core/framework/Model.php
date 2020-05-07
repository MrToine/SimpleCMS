<?php
/**
 * @license     https://www.gnu.org/licenses/gpl-3.0.html GNU/GPL-3.0
 * @author      Anthony VIOLET
 * @version     SimpleFM 1.0 - 02/05/2020
 * @since       SimpleFM 1.1 - 07/05/2020
 * @contributor
 * @page        Gestion des interaction avec les données.
*/
class Model {
    public $table_data = "";
    public $data_file;
    public $type = "json";

    public function __construct($type, $path=null) {
        if($type === "json"){
            $this->data_file = ROOT.'/modules/'.Router::request()->module.'/data/'.$this->table_data.'.json';
            if(!empty($path)){
                $this->data_file = ROOT.$path.'.json';
            }
            $this->data_file = utf8_encode($this->data_file);
            $this->data = json_decode(file_get_contents($this->data_file));
        }elseif($type === "ini"){
            $this->data_file = ROOT.'/modules/'.Router::request()->module.'/data/'.$this->table_data.'.ini';
            $data = parse_ini_file($this->data_file);
            $this->data = (object) $data;
            $this->type = "ini";
        }
    }

    public function openfile($mode) {
        $file = fopen($this->data_file, $mode);
        return $file;
    }

    public function closefile($file) {
        return fclose($file);
    }

    public function get_count($params = []) {
        $data = $this->get($params);
        $data = (array)$data;
        debug(count($data));
    }

    public function find($params = []){
        /*
            On commence par convertir les objets en array.
            On déclare une variable $match (pour ensuite matcher les résultats)
            on liste le tableau $params
            on liste le tableau contenant les données ($this->data)
            on verifie si ça match et si c'est le cas on rajouter 1 à la variable $match
            puis pour finir, pn vérifie que le nombre de $match correspond au nombre d'entrée de l'array $params
        */
        $params = (array)$params;
        $this->data = (array)$this->data;
        $match = 0;
        if($params) {
            foreach($params as $k => $v){
                $return = $v;
                foreach($this->data as $value) {
                    $value = (array)$value;
                    if($params[$k] == $value[$k]) {
                        $match++;
                    }
                }
            }
            if($match == count($params)){
                return true;
            }
        }
        return false;
    }

    public function get($params = []){
        /*
            Permet de récupérer les données. Si des paramèetres sont passé on récupère en fonctions de ces derniers.
            On liste les paramètres. Ensuite on liste les données et on vérifie l'égalité avec les paramètres.
        */
        if($params) {
            foreach($params as $key => $value) {
                foreach($this->data as $v) {
                    if($v->$key == $value) {
                        $this->data = $v;
                    }
                }
            }
        }
        $this->data = (array)$this->data;
        arsort($this->data);
        return (object)$this->data;
    }

    public function get_list($params = []){
        /*
            Permet de récupérer les données. Si des paramèetres sont passé on récupère en fonctions de ces derniers.
            On liste les paramètres. Ensuite on liste les données et on vérifie l'égalité avec les paramètres.
        */
        $data = [];
        if($params) {
            foreach($params as $key => $value) {
                foreach($this->data as $v) {
                    if($v->$key == $value) {
                        $data[] = $v;
                    }
                }
            }
        }else{
            $data = $this->data;
        }

        $this->data = (array)$data;
        arsort($this->data);
        return (object)$this->data;
    }

    public function get_last(){
        return end($this->data);
    }

    public function save($data){
        $backup = json_decode(file_get_contents($this->data_file), true);
        $new_file = $backup;
        $data = (array)$data;
        if(!in_array($data['id'], $new_file[$data['id']])){
            $new_file[] = $data;
        }
        $data = (object)$data;
        foreach($backup as $k => $v) {
            foreach($v as $key => $value) {
                if($new_file[$k]['id'] == $data->id){
                    $new_file[$k][$key] = $data->$key;
                }
            }
            $new_file[$k] = (object) $new_file[$k];
        }
        $new_file = (object) $new_file;
        $file = $this->openfile('w+');
        if($this->type === "json") {
            $this->create_json_file($new_file);
            fwrite($file, $this->create_json_file($new_file));
        }
        $this->closefile($file);
    }

    public function delete($key) {
        $backup = json_decode(file_get_contents($this->data_file), true);
        $new_file = $backup;
        $data = $this->get(["id" => $key]);
        unset($new_file[$key]);
        $new_file = (object)$new_file;
        $file = $this->openfile('w+');
        fwrite($file, $this->create_json_file($new_file));
        $this->closefile($file);
    }

    public function validate($data, $validate=true) {
        /*
        *   Si $validate = false, alors on ne chercher pas a vérifier les règles de validation
        */
        $try=(isset($_GET['try'])?$_GET['try']:(isset($_POST['try'])?$_POST['try']:''));
        $nobotv=(isset($_GET['nobotv'])?$_GET['nobotv']:(isset($_POST['nobotv'])?$_POST['nobotv']:''));
        $nobotc=(isset($_GET['nobotc'])?$_GET['nobotc']:(isset($_POST['nobotc'])?$_POST['nobotc']:''));
        $nobots=(isset($_GET['nobots'])?$_GET['nobots']:(isset($_POST['nobots'])?$_POST['nobots']:''));

        $errors = array();
        $reg_expression = "";
        if(!$_POST){
            return false;
        }

        if($_POST['try'] === 'send'){
            if(($nobotc != sha1($nobotv)) || ($nobotv == "") || ($nobots != "")) {
                $errors['Antispam'] = "Vous n'avez pas coché la case anti-spam.";
            }
        }
        if($validate){
            foreach ($this->validate as $key => $value) {
                if($value['rule'] == "alphanumeric_hyphen_repeat"){
                    $reg_expression = "([a-z0-9\-]+)";
                }
                if(!isset($data->$key)) {
                    $errors[$key] = $value['message'];
                }else{
                    if($value['rule'] == 'notEmpty'){
                        if(empty($data->$key)){
                            $errors[$key] = $value['message'];
                        }
                    }elseif($value['rule'] == 'clean_xss') {
                        if(preg_match('/\<script(.*?)?\>(.|\s)*?\<\/script\>/i', $data->content)){
                            $errors[$key] = $value['message'];
                        }
                    }elseif(!preg_match('/^'.$reg_expression.'$/', $data->$key)){
                        $errors[$key] = $value['message'];
                    }
                }
            }
        }
        $this->errors = $errors;
        if(empty($errors)) {
            return true;
        }
        return false;
    }

    public function create_json_file($data) {
        /*
            On créer un fichier JSON contenant les données récupérer. Et on n'oublie pas
            de replacer les caractère particulier pour éviter des erreurs
        */
        $jsonfile = '';
        $jsonfile .= '{';
        end($data);
        $last_data = key($data);
        foreach($data as $key => $value) {
            $value = (object)$value;
            $jsonfile .= '"'.$value->id.'":{';
            end($value);
            $last_value = key($value);
            foreach($value as $k => $v) {
                $v = str_replace('"', '\"', $v);
                $v = str_replace(array("\r\n","\n"), '', $v);
                $jsonfile .= '"'.$k.'":"'.$v.'"';
                if($k != $last_value) {
                    $jsonfile .= ',';
                }
            }
            $jsonfile .= '}';
            if($key != $last_data) {
                $jsonfile .= ',';
            }
            //$jsonfile .= '{"'.$key.'": "'.$value.'"}';
        }
        $jsonfile .= '}';
        return $jsonfile;
    }
}
