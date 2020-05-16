<?php
class AdminMenusController extends AdminController {
    public function index(){
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
                $model = $this->loadModel('Menus', '/core/data/submenu');
                if($_POST){
                    $model->save($this->request->data);
                    $this->Sessions->set_flash('Le lien à bien été enregistré.', 'success');
                    $this->redirect(["menus", "temple"], 301);
                }
                if(isset($model->get_last()->id)){
                    $id = $model->get_last()->id +1;
                }else{
                    $id = 1;
                }
                $this->set([
                    "menu" => $model->get(),
                    "new_id" => $id
                ]);
                $this->request->data = $model->get();
                $this->render();
                break;
        }
    }

    private function delete() {
        if(empty($this->request->params["id"])) {
            $this->Sessions->set_flash('Le lien séléctionner n\'existes pas.', 'warning');
        }

        $this->loadModel('Menus', '/core/data/submenu')->delete($this->request->params["id"]);
        $this->redirect(["menus", ConfigApp::$admin_module_name], 301);
    }
}
