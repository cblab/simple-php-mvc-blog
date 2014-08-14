<?php
namespace Model;

class BlogService {
    protected $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function getInformationById($id)
    {
        return $this->database->query(
            "SELECT * " .
            "FROM article " .
            "WHERE id = " . (int)$id
        )->fetch();
    }
}
