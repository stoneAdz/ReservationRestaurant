<?php
    require_once 'models/User.php';

class UserController
{
    public function login()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $user = new User();
        $email = $_POST['email'];
        $password = $_POST['password'];

        $loggedInUser = $user->login($email, $password);

        if ($loggedInUser) {
            session_start();
            $_SESSION['user'] = $loggedInUser;
            header("Location: ?page=home");
            exit;
        } else {
            echo "Identifiants invalides.";
        }
    } else {
        require_once 'views/login.php';
    }
}

public function register()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = new User();
        $success = $user->create($name, $email, $password);

        if ($success) {
            header("Location: ?page=login"); // Redirection après inscription réussie
            exit;
        } else if (!$success) {
            header("Location: ?page=register&error=true"); // Rediriger avec un message d'erreur
            exit;
        }else{
            echo "Erreur : l'utilisateur existe déjà.";
        }
    } else {
        require_once 'views/register.php';
    }
}

    

}

