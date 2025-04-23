<h1>Mes Réservations</h1>

<?php if (!empty($reservations)): ?>
    <ul>
        <?php foreach ($reservations as $res): ?>
            <li>
                Le <?= htmlspecialchars($res['date']) ?> à <?= htmlspecialchars($res['time']) ?> 
                pour <?= htmlspecialchars($res['guests']) ?> personnes.
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Aucune réservation enregistrée.</p>
<?php endif; ?>

<p><a href="?page=home">Retour à l'accueil</a></p>

