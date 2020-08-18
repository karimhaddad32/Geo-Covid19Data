<?php

class Model{
	protected static $_connection;
	
	public function __construct()
    {	
        $server = 'localhost';
        $DBName = 'serenity';
        $user = 'root';
        $pass = 'i1ZU8kB3avqNsEM4';
    
        self::$_connection = new PDO("mysql:host=$server;dbname=$DBName;charset=utf8", $user, $pass);
        self::$_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
}

?>
