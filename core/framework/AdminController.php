<?php
/**
 * @license     https://www.gnu.org/licenses/gpl-3.0.html GNU/GPL-3.0
 * @author      Anthony VIOLET
 * @version     SimpleFM 1.0 - 05/05/2020
 * @since       SimpleFM 1.1 - 05/05/2020
 * @contributor
 * @page        Controller qui gère tous ce qui rapporte à l'administration des modules.
*/
class AdminController extends Controller {
    public function __construct($request) {
        /* Chargement des helpers */
        foreach (ConfigApp::$helpers as $value) {
            $value = ucfirst($value);
            require ROOT.'/core/utils/'.$value.'.php';
            $this->$value = new $value($this);
        }
        $this->Sessions = new Sessions();
        $this->request = $request;

        if(empty($this->Sessions->read('User'))) {
            $this->redirect([$this->request->module, "index"], 301);
        }else{
            if($this->Sessions->read('User')->role != "admin"){
                $this->redirect([$this->request->module, "index"], 301);
            }
        }
    }
}
