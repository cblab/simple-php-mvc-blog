<?php
require_once __DIR__ . '/../../vendor/autoload.php';

class TestDatabaseBuilderTest extends PHPUnit_Framework_TestCase {
    private $db;

    public function setUp() {
        $this->db = new PDO('sqlite::memory:');
        $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        // Ignoring mysql dialect for reasons of simplicity
        $sql = <<<SQL
        CREATE TABLE IF NOT EXISTS `blog_users` (
                  `id` int(10) NOT NULL,
                  `user_login` varchar(60),
                  `user_pass` varchar(64),
                  `user_name` varchar(64),
                  `user_last_name` varchar(64),
                  `user_street` varchar(64),
                  `user_place` varchar(64),
                  `user_email` varchar(100),
                  `user_url` varchar(100),
                  PRIMARY KEY (`id`)
                );
SQL;

        $this->db->exec($sql);
        $this->db->exec("INSERT INTO blog_users (id, user_login, user_pass) VALUES ('1', 'test', 'test')");
    }

    /**
     * Test if a database exists and table is populated with data
     */
    public function testMyDatabaseDataPopulation() {
        $this->assertTrue($this->db instanceof PDO);
        $users = $this->db->query('SELECT * FROM blog_users')->fetchAll();
        $this->assertEquals('test', $users[0]['user_login']);
    }
}