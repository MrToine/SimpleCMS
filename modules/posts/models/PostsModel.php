<?php
class PostsModel extends Model {
    public $table_data = "posts";

    var $validate = array(
        'content' => array(
            'rule' => 'clean_xss',
            'message' => 'XSS...'
        ),
    );
}
