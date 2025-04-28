<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier la réservation</title>
    <link rel="stylesheet" href="assets/css/edit_reservation.css">
</head>
<body class="edit-reservation-container">

    <h1>Modifier la réservation</h1>

    <form method="POST" action="?page=edit-reservation&id=<?= $id ?>">
        <label for="date">Date :</label>
        <input type="date" name="date" value="<?= $res['date'] ?>" required><br><br>

        <label for="time">Heure :</label>
        <input type="time" name="time" value="<?= $res['time'] ?>" required><br><br>

        <label for="guests">Nombre de personnes :</label>
        <input type="number" name="guests" value="<?= $res['guests'] ?>" required><br><br>

        <button type="submit">Mettre à jour</button>
    </form>

    <p><a href="?page=mes-reservations">Retour</a></p>
</body>
</html>
