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

        foreach ($users as $user) {
            if ($user['email'] === $email) {
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

        foreach ($users as $user) {
            if ($user['email'] === $email && password_verify($password, $user['password'])) {
                return $user;
            }
        }

        return false;
    }
}

