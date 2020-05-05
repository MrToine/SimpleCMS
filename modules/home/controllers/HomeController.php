<?php
class HomeController extends Controller {

    public function index($data){
        /*
            On charge le model
        */

        $edito = $this->loadModel('home');
        $this->set([
            "test" => "azertyuiop",
            "cracra" => "je suis au courant",
            "id" => 154,
            "edito" => $edito->get(),
        ]);
        $this->render('lol');
    }

    public function edit_edito(){
        $edito = $this->loadModel('Home');

        if($edito->validate($this->request->data)){
            $edito->save($this->request->data);
            $this->redirect(["home", "index"]);
        }
        $this->request->data = $edito->get();
        $this->render();
    }
}
