<?php
class PostsController extends Controller {
    public function index() {
        $model = $this->loadModel("Posts");
        $this->set([
            "posts" => $model->get_list()
        ]);

        $this->render();
    }

    public function view() {
        if(empty($this->request->params["id"])) {
            $this->redirect(["posts", "index"]);
        }
        $model = $this->loadModel("Posts");
        $model_comments = $this->loadModel("Comments");
        $this->set([
            "post" => $model->get(["id" => $this->request->params['id']]),
            "comments" => $model_comments->get_list(["id_post" => $this->request->params['id']]),
        ]);
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

    public function addcomment() {
        $html = "";
        $model = $this->loadModel('Comments');

        if(isset($model->get_last()->id)){
            $id = $model->get_last()->id +1;
        }else{
            $id = 1;
        }

        if($model->validate($this->request->data)){
            $this->request->data->created = date('j/m/Y');
            $this->request->data->id = $id;
            $this->request->data->id_post = $this->request->params['id'];
            unset($this->request->data->nobotc);
            unset($this->request->data->try);
            unset($this->request->data->nobotv);
            unset($this->request->data->antispam);
            $model->save($this->request->data);
        }else{
            $html .= "Attention, des erreurs se sont glissées. Une innatention peut-être ?";
            $html .= "<ol>";
            foreach ($model->errors as $key => $value) {
                $html .= "<li>".$value."</li>";
            }
            $html .= "</ol>";
            $this->Sessions->set_flash($html, "warning");
        }
        $this->redirect(["posts", "view&id=".$this->request->params["id"]]);
    }
}
