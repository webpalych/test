<?php


abstract class AbstractModel {

    protected static $table;

    protected $data = [];

    public function __set($k , $v) {
        $this->data[$k] = $v;
    }

    public function __get($k) {
        return $this->data[$k];
    }

    //Получение всех записей из БД
    public static function get_all() {
        $class = get_called_class();
        $db = new Database;
        $db->set_class_name($class);
        $query = 'SELECT * FROM ' . static::$table;
        return  $db->query($query);
    }

    //Получение одной записи из БД
    public static function get_one_by_id( $id ) {

        $class = get_called_class();
        $db = new Database;
        $db->set_class_name($class);
        $query = "SELECT * FROM " .  static::$table . " WHERE id=:id";
        return $db->query($query, [':id' => $id])[0];

    }

    public static function get_one_by_field( $field, $value ) {

        $class = get_called_class();
        $db = new Database;
        $db->set_class_name($class);
        $query = "SELECT * FROM " .  static::$table . " WHERE " . $field . " = :value";
        return $db->query($query, [ ':value' => $value])[0];

    }

    protected function insert() {

        $cols = array_keys($this->data);
        $data = [];
        foreach ($cols as $col) {
            $data[':'.$col] = $this->data[$col];
        }
        $db = new Database;
        $query = "INSERT INTO " .  static::$table . "
         (". implode(', ', $cols) .")
         VALUES
         (". implode(', ', array_keys($data)) .")";

       if ($db->execute($query, $data)) {
           $added_article = self::get_one_by_field('title', $this->title);

           $this->id = $added_article->id;
       }

    }

    protected function update() {

        $cols = array_keys($this->data);
        $data = [];
        $string = [];
        foreach ($cols as $col) {
            $data[':'.$col] = $this->data[$col];
            $string[$col] = $col .'=:'. $col;
        }

        $db = new Database;
        $query = "UPDATE " .  static::$table . " SET " . implode(', ', $string) . " WHERE id=". $this->id;

        return $db->execute($query, $data);



    }

    public function save() {

        if ($this->id) {
            $this->update();
        } else {
            $this->insert();
        }

    }

    public static function delete( $id ) {

        $db = new Database;

        $query = "DELETE FROM " .  static::$table . " WHERE id=:id";

        return $db->execute($query, [':id' => $id]);

    }
} 