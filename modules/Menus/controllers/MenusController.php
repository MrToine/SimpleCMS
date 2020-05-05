<?php
class MenusController extends Controller {
    public function index() {
        $this->redirect(['home', 'index']);
    }
}
