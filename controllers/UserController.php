<?php
require_once 'models/User.php';

class UserController
{
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $userModel = new User();
            $result = $userModel->create($name, $email, $password);

            if ($result) {
                echo "Inscription réussie ! <a href='?page=login'>Se connecter</a>";
            } else {
                echo "Cet utilisateur existe déjà.";
            }
        } else {
            require_once 'views/register.php';
        }
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $userModel = new User();
            $user = $userModel->login($email, $password);

            if ($user) {
                $_SESSION['user'] = $user;
                header('Location: index.php?page=home');
                exit;
            } else {
                echo "Email ou mot de passe incorrect.";
            }
        } else {
            require_once 'views/login.php';
        }
    }
}

