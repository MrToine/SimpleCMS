<?php
class UsersController extends Controller {
    public function login() {
        $model = $this->loadModel("Users");
        if($model->validate($this->request->data)) {
            if($model->find($this->request->data)) {
                debug("Trouvé");
                $this->Sessions->write('User', $model->get([
                    "username" => $this->request->data->username
                ]));
                debug($_SESSION);
            }
        }
        $this->render();
    }
}
