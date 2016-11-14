<?php


abstract class AbstractModel {

    protected static $table;
    protected static $class;


    //Получение всех записей из БД
    public static function get_all() {
        $db = new Database;
        $query = 'SELECT * FROM ' . static::$table;
        return  $db->get_result($query, static::$class);
    }

    //Получение одной записи из БД
    public static function get_one( $id ) {
        $db = new Database;
        $query = "SELECT * FROM " .  static::$table . " WHERE id=".$id;
        return $db->get_result($query, static::$class)[0];
    }


} 