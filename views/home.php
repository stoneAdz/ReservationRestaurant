<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil - Réservation Restaurant</title>
    <link rel="stylesheet" href="assets/css/home.css">
</head>
<body>
    <h1>Bienvenue sur le système de réservation</h1>

    <?php if (isset($_SESSION['user'])): ?>
        <p>Bonjour <strong><?= htmlspecialchars($_SESSION['user']['name']) ?></strong> !</p>
        <p><a href="?page=reserve">Faire une réservation</a></p>
        <p><a href="?page=mes-reservations">Voir mes réservations</a></p>

        <?php if ($_SESSION['user']['email'] === 'admin@resto.com'): ?>
            <p><a href="?page=all-reservations">Voir toutes les réservations (Admin)</a></p>
        <?php endif; ?>

        <p><a href="?page=logout">Se déconnecter</a></p>
    <?php else: ?>
        <p><a href="?page=reserve">Faire une réservation</a></p>
        <p><a href="?page=login">Se connecter</a></p>
        <p><a href="?page=register">S'inscrire</a></p>
    <?php endif; ?>
</body>
</html>

