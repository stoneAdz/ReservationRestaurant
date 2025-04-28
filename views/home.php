<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Réservation Restaurant</title>
    <link rel="stylesheet" href="assets/css/home.css">  
</head>
<body class="home-container">

    <div class="container">
        <h1>Restaurant L'Evidence</h1>

        <?php if (isset($_SESSION['user'])): ?>
            <div class="logged-in">
                <p>Bonjour <strong><?= htmlspecialchars($_SESSION['user']['name']) ?></strong> !</p>
                <p><a href="?page=reserve">Faire une réservation</a></p>
                <p><a href="?page=mes-reservations">Voir mes réservations</a></p>

                <?php if ($_SESSION['user']['email'] === 'admin@resto.com'): ?>
                    <div class="admin-links">
                        <p><a href="?page=all-reservations">Voir toutes les réservations (Admin)</a></p>
                    </div>
                <?php endif; ?>

                <p><a href="?page=logout">Se déconnecter</a></p>
            </div>
        <?php else: ?>
            <p><a href="?page=reserve">Faire une réservation</a></p>
            <p><a href="?page=login">Se connecter</a></p>
            <p><a href="?page=register">S'inscrire</a></p>
        <?php endif; ?>
    </div>
</body>
</html>
