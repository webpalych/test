<?php

require_once __DIR__.'/../config.php';

class Database {

    public function __construct() {
        mysql_connect( DB_HOST, DB_USER, DB_PASSWORD );
        mysql_select_db( DB_NAME ) or die ("Ошибка соединения с базой данных!");
    }

    public function get_result( $query , $class = 'stdClass' ) {
        $result = mysql_query( $query );
        if (!$result){
            return false;
        }
        $return = [];
        while ( $row = mysql_fetch_object($result, $class) ) {
            $return[] = $row;
        }
        return $return;
    }

    public function query_exec( $query ) {
        return mysql_query( $query );
    }

} 