<?php
class UsersController extends Controller {
    public function login() {
        $model = $this->loadModel("Users");
        if($model->validate($this->request->data)) {
            $this->request->data->password = sha1($this->request->data->username).sha1($this->request->data->password);
            if($model->find($this->request->data)) {
                $this->Sessions->write('User', $model->get([
                    "username" => $this->request->data->username
                ]));
            }
        }
        $this->render();
    }

    public function logout() {
        $this->Sessions->delete('User');
        $this->redirect(["users", "login"]);
    }
}
