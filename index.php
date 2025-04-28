<?php
 
session_start();

 
error_reporting(E_ALL);
ini_set('display_errors', 1);

 
require_once 'BD/Router.php';

 
$router = new Router();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Réservation - Confirmation</title>

     
    <link rel="stylesheet" href="assets/css/index.css">

    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>

    <header>
        <h1>Réservation en ligne</h1>
        <nav>
            <a href="index.php">Accueil</a>
            <a href="index.php?page=reserve">Réserver</a>
        </nav>
    </header>

    <main class="container">
        <?php
        $router->handleRequest();
        ?>
    </main>

    <footer>
        © 2025 Mon Site de Réservation. Tous droits réservés.
    </footer>

</body>
</html>
