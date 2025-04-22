<?php

class Database
{
    private static $instance = null;

    public static function getInstance()
    {
        if (self::$instance === null) {
            $dsn = 'mysql:host=127.0.0.1;charset=utf8';
            $username = 'root'; 
            $password = '';  

            try {
                self::$instance = new PDO($dsn, $username, $password);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Création de la base de données si elle n'existe pas
                self::$instance->exec("CREATE DATABASE IF NOT EXISTS restaurant");

                // Sélectionner la base de données
                self::$instance->exec("USE restaurant");

                // Création de la table 'users' si elle n'existe pas
                self::$instance->exec("CREATE TABLE IF NOT EXISTS users (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    name VARCHAR(100) NOT NULL,
                    email VARCHAR(100) NOT NULL UNIQUE,
                    password VARCHAR(255) NOT NULL,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                ) ENGINE=INNODB;");

            } catch (PDOException $e) {
                die('Erreur de connexion : ' . $e->getMessage());
            }
        }

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
