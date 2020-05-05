<?php
class PagesModel extends Model {
    public $table_data = "pages";
    public $validate= [
        "name" => [
            "rule" => "notEmpty",
            "message" => "Le titre ne peut pas être vide"
        ],
        "content" => [
            "rule" => 'clean_xss',
            "message" => 'XSS'
        ]
    ];
}
