<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toutes les réservations</title>
    <link rel="stylesheet" href="assets/css/reservations.css"> 
</head>
<body class="reservations-list">

    <div class="container">
        <h1>📋 Toutes les réservations</h1>

        <?php if (!empty($reservations)): ?>
            <ul>
                <?php foreach ($reservations as $res): ?>
                    <li>
                        <strong><?= htmlspecialchars($res['name']) ?></strong> (<?= htmlspecialchars($res['user']) ?>) – 
                        le <?= htmlspecialchars($res['date']) ?> à <?= htmlspecialchars($res['time']) ?> –
                        <?= htmlspecialchars($res['guests']) ?> personnes
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
