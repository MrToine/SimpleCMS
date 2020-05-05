<?php
class PostsController extends Controller {
    public function index() {
        $model = $this->loadModel("Posts");
        $this->set([
            "posts" => $model->get()
        ]);
        $this->render();
    }

    public function view() {
        if(empty($this->request->params["id"])) {
            $this->redirect(["posts", "index"]);
        }
        $model = $this->loadModel("Posts");
        $this->set(["post" => $model->get(["id" => $this->request->params['id']])]);
        $this->render();
    }

    public function edit(){
        if(empty($this->request->params["id"])) {
            $this->redirect(["posts", "index"]);
        }
        $model = $this->loadModel('Posts');
        if($model->validate($this->request->data)){
            $this->request->data->created = date('j/m/Y');
            $this->request->data->author = "Toine";
            $model->save($this->request->data);
            $this->redirect(["posts", "index"]);
        }
        $this->request->data = $model->get(["id" => $this->request->params['id']]);
        $this->render();
    }
}
