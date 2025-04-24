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

