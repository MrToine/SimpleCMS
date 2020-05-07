<?php
class AdminPagesController extends AdminController {

    public function index() {
        if(!empty($this->request->params["admin"])){
            $action = $this->request->params["admin"];
        }else{
            $action = "";
        }

        switch($action) {
            case 'create':
                $this->create();
                $this->render('AdminCreate');
                break;
            case 'edit':
                $this->edit();
                $this->render('AdminCreate');
                break;
            case "delete":
                $this->delete();
                break;
            default:
                $this->list();
                $this->render('AdminList');
                break;
        }
    }

    private function list(){
        $model = $this->loadModel('Pages');
        $this->set([
            "pages" => $model->get_list()
        ]);
    }


    private function create() {
        $model = $this->loadModel('Pages');

        if($model->validate($this->request->data)){
            $model->save($this->request->data);
            $this->redirect(["pages", "list"]);
        }
        if(isset($model->get_last()->id)){
            $id = $model->get_last()->id +1;
        }else{
            $id = 1;
        }
        $this->request->data = $model->get();
        $this->set([
            "id" => $id
        ]);
    }

    public function edit() {
        $model = $this->loadModel('Pages');
        if(empty($this->request->params["id"])) {
            $this->Sessions->set_flash('Le lien séléctionner n\'existes pas.', 'warning');
        }
        $data = $model->get_list(["id" => $this->request->params["id"]]);

        if($model->validate($this->request->data)){
            $model->save($this->request->data);
            $this->redirect(["pages", "temple"]);
        }
        $this->request->data = $data;
        $this->set([
            "post" => $data,
        ]);
    }

    private function delete() {
        if(empty($this->request->params["id"])) {
            $this->Sessions->set_flash('Le lien séléctionner n\'existes pas.', 'warning');
        }
        debug($this->request->params);
        $this->loadModel('Pages')->delete($this->request->params["id"]);
        $this->redirect(["pages", "temple"], 301);
    }
}
