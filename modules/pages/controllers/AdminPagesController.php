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
            default:
                $this->list();
                $this->render('AdminList');
                break;
        }
    }

    private function list(){
        $model = $this->loadModel('Pages');
        $this->set([
            "pages" => $model->get()
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
}
