<?php
class PagesController extends Controller {

    public function view() {
        if(empty($this->request->params['id'])){
            $this->redirect(["home", "index"], 301);
        }
        $model = $this->loadModel('Pages');
        $this->set(["page" => $model->get(["id" => $this->request->params['id']])]);
        $this->render();
    }
}
