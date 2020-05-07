<?php
class CommentsModel extends Model {
    public $table_data = "comments";

    var $validate = array(
        'author' => array(
            'rule' => 'notEmpty',
            'message' => 'Vous devez définir un auteur',
        ),
        'content' => array(
            'rule' => 'clean_xss',
            'message' => 'XSS...'
        ),
    );
}
