<?php
class HomeModel extends Model {

    public $table_data = "home";

    var $validate = array(
        'content' => array(
            'rule' => 'clean_xss',
            'message' => 'XSS...'
        ),
    );
}
/* ROOT.'/modules/'.Router::request()->module.'/data/'.$this->table_data.'.json' */
