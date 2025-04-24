<?php

class User
{
    private $file;

    public function __construct()
    {
        $this->file = 'BD/Database.json';
    }

    public function create($name, $email, $password)
    {
        $users = json_decode(file_get_contents($this->file), true);

        if (!is_array($users)) {
            $users = []; // 🔐 Important si le fichier est vide ou cassé
        }

        foreach ($users as $user) {
            if (isset($user['email']) && $user['email'] === $email) {
                return false; // utilisateur déjà inscrit
            }
        }

        $users[] = [
            'name' => $name,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ];

        file_put_contents($this->file, json_encode($users, JSON_PRETTY_PRINT));
        return true;
    }

    public function login($email, $password)
    {
        $users = json_decode(file_get_contents($this->file), true);

        if (!is_array($users)) {
            return false;
        }

        foreach ($users as $user) {
            if (
                isset($user['email'], $user['password']) &&
                $user['email'] === $email &&
                password_verify($password, $user['password'])
            ) {
                return $user;
            }
        }

        return false;
    }
}

