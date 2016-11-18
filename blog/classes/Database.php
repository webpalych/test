<?php

require_once __DIR__ . '/../config.php';

class Database {

    private $dbh;

    private $class_name = 'stdClass';


    public function __construct() {

        $dsn = 'mysql:dbname=' . DB_NAME .';host=' . DB_HOST;
        $this->dbh = new PDO($dsn , DB_USER, DB_PASSWORD);

    }

    public function set_class_name($class_name) {

        $this->class_name = $class_name;

    }

    public function query($sql, $args=[]) {

        $sth = $this->dbh->prepare($sql);
        $sth->execute($args);
        return $sth->fetchAll(PDO::FETCH_CLASS, $this->class_name);

    }

    public function execute($sql, $args=[]) {

        $sth = $this->dbh->prepare($sql);
        return  $sth->execute($args);

    }

    public function last_insert_id() {

        return $this->dbh->lastInsertId();

    }


} 