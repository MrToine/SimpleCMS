<?php
class AdminPostsController extends AdminController {
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
        $model = $this->loadModel('Posts');
        $this->set([
            "posts" => $model->get()
        ]);
    }


    private function create() {
        $model = $this->loadModel('Posts');

        if($model->validate($this->request->data)){
            $this->request->data->created = date('d/m/Y');
            $this->request->data->author = "Auteur";
            $model->save($this->request->data);
            $this->redirect(["posts", "temple"]);
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
        $model = $this->loadModel('Posts');
        if(empty($this->request->params["id"])) {
            $this->Sessions->set_flash('Le lien séléctionner n\'existes pas.', 'warning');
        }
        $data = $model->get(["id" => $this->request->params["id"]]);
        $this->request->data->created = $data->created;
        $this->request->data->author = $data->author;
        if($model->validate($this->request->data)){
            $model->save($this->request->data);
            $this->redirect(["posts", "temple"]);
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
        $this->loadModel('Posts')->delete($this->request->params["id"]);
        $this->redirect(["posts", "temple"], 301);
    }
}
