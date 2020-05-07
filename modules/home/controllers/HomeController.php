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
            "edito" => $edito->get(["name" => "edito"])
        ]);
        $this->render('lol');
    }
}
