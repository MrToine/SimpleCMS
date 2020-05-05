<?php
class MenusController extends Controller {
    public function index(){
        $model = $this->loadModel('Menus', '/core/data/submenu');
        if($_POST){
            $model->save($this->request->data);
            $this->Sessions->set_flash('Le lien à bien été enregistré.', 'success');
            $this->redirect(["menus", "index"], 301);
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
    }

    public function delete() {
        if(empty($this->request->params["id"])) {
            $this->Sessions->set_flash('Le lien séléctionner n\'existes pas.', 'warning');
        }
        debug($this->request->params);
        $this->loadModel('Menus', '/core/data/submenu')->delete($this->request->params["id"]);
        $this->redirect(["menus", "index"], 301);
    }
}
