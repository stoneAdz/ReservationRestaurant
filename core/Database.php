<?php

class Database
{
    private static $instance = null;

    public static function getInstance()
    {
        if (self::$instance === null) {
            $dsn = 'mysql:host=127.0.0.1;dbname=restaurant;charset=utf8';
            $username = 'root';
            $password = ''; // À adapter selon ton serveur

            try {
                self::$instance = new PDO($dsn, $username, $password);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die('Erreur de connexion : ' . $e->getMessage());
            }
        }

        self::initialize();

        return self::$instance;
    }

    private static function initialize()
    {
        $sql = "CREATE TABLE IF NOT EXISTS users (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    name VARCHAR(100) NOT NULL,
                    email VARCHAR(100) NOT NULL UNIQUE,
                    password VARCHAR(255) NOT NULL,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                ) ENGINE=INNODB;";
        self::$instance->exec($sql);
    }
}
