<?php

class User
{
    private $pdo;

    public function __construct()
    {
        require_once 'core/Database.php';
        $this->pdo = Database::getInstance();
    }

    public function create($name, $email, $password)
    {
        // Vérifie si l'utilisateur existe déjà
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->rowCount() > 0) {
            return false; // Utilisateur déjà inscrit
        }

        // Hachage du mot de passe
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insertion en base
        $stmt = $this->pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        return $stmt->execute([$name, $email, $hashedPassword]);
    }

    public function login($email, $password)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            return $user; // Connexion réussie
        }

        return false; // Échec
    }
}

