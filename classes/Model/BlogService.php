<?php
    class BlogService {
        protected $database;

        public function __construct(PDO $database) {
            $this->database = $database;
        }

        public function getInformationById($id) {
            return $this->database->query(
                "SELECT * " .
                "FROM article " .
                "WHERE id = " . (int) $id
            )->fetch();
        }
    }
