<?php

class UserController
{
    public function login()
    {
        // Affiche la vue de connexion
        require_once 'views/login.php';
    }

    public function register()
    {
        // Affiche la vue d'inscription
        require_once 'views/register.php';
    }

    // Plus tard, tu ajouteras ici la logique pour vérifier les identifiants, etc.
}
