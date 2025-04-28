<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Réservations</title>
    <link rel="stylesheet" href="assets/css/reservations.css">
</head>
<body class="reservations-list">

    <div class="container">
        <h1>Mes Réservations</h1>

        <?php if (!empty($reservations)): ?>
            <ul>
                <?php foreach ($reservations as $index => $res): ?>
                    <li>
                        Le <?= htmlspecialchars($res['date']) ?> à <?= htmlspecialchars($res['time']) ?>
                        pour <?= htmlspecialchars($res['guests']) ?> personnes.
                        <a href="?page=cancel-reservation&id=<?= $index ?>">Annuler</a>
                        <a href="?page=edit-reservation&id=<?= $index ?>">Modifier</a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Aucune réservation enregistrée.</p>
        <?php endif; ?>

        <p><a href="?page=home">Retour à l'accueil</a></p>
    </div>
</body>
</html>
