<?php
class PagesController extends Controller {

    public function list(){
        $model = $this->loadModel('Pages');
        $this->set([
            "pages" => $model->get()
        ]);
        $this->render();
    }

    public function view() {
        if(empty($this->request->params['id'])){
            $this->redirect(["home", "index"], 301);
        }
        $model = $this->loadModel('Pages');
        $this->set(["page" => $model->get(["id" => $this->request->params['id']])]);
        $this->render();
    }

    public function create() {
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
        $this->render();
    }
}
