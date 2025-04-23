<h1>Réserver une table</h1>

<form method="POST" action="?page=reserve">
    <label for="date">Date :</label>
    <input type="date" name="date" required><br><br>

    <label for="time">Heure :</label>
    <input type="time" name="time" required><br><br>

    <label for="guests">Nombre de personnes :</label>
    <input type="number" name="guests" min="1" required><br><br>

    <button type="submit">Confirmer la réservation</button>
</form>

