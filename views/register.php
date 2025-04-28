<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="assets/css/register.css">
</head>
<body>
    <h1>Inscription</h1>
    <form method="POST" action="?page=register">
        <label for="name">Nom :</label>
        <input type="text" name="name" required><br><br>

        <label for="email">Email :</label>
        <input type="email" name="email" required><br><br>

        <label for="password">Mot de passe :</label>
        <input type="password" name="password" required><br><br>

        <button type="submit">S'inscrire</button>
    </form>

    <p>Déjà un compte ? <a href="?page=login">Se connecter</a></p>
</body>
</html>
