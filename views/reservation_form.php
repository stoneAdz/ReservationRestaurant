<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Réserver une table</title>
</head>
<body>
    <h1>Réserver une table</h1>
    <form method="POST" action="?page=reserve">
        <label for="date">Date :</label>
        <input type="date" name="date" required><br><br>

        <label for="heure">Heure :</label>
        <input type="time" name="heure" required><br><br>

        <label for="personnes">Nombre de personnes :</label>
        <input type="number" name="personnes" required><br><br>

        <button type="submit">Réserver</button>
    </form>
</body>
</html>
