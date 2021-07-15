<?php

class Connection {
    public static function getConnection() {
        $database = "atividade";
        $username = "elaine";
        $password = "123";
        
        return new PDO ("mysql:host=localhost;dbname=$database", $username, $password);
    }
}