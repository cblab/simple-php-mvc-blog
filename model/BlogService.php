<?php
    class BlogService {
        protected $database;

        public function __construct(PDO $database) {
            $this->database = $database;
        }

        public function getInformationById($id) {
            return $this->database->query(
                "SELECT model, year, price " .
                "FROM car " .
                "WHERE id = " . (int) $id
            )->fetch();
        }
    }
