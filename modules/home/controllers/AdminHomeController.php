<?php
class AdminHomeController extends AdminController {
    public function index(){
        $edito = $this->loadModel('Home');

        if(!empty($this->request->params["admin"])){
            $action = $this->request->params["admin"];
        }else{
            $action = "";
        }

        switch($action) {
            case 'edit':
                if($edito->validate($this->request->data)){
                    $edito->save($this->request->data);
                    $this->redirect(["home", "index"]);
                }
                $this->request->data = $edito->get();
                $this->render('AdminEdit');
                break;
            default:
                $this->render('AdminIndex');
                break;
        }

    }
}
