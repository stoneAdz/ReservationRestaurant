<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="assets/css/login.css"> 
</head>
<body class="login-container">

    <div class="container">
        <h1>Connexion</h1>

        <form method="POST" action="?page=login">
            <label for="email">Email :</label>
            <input type="email" name="email" required><br><br>

            <label for="password">Mot de passe :</label>
            <input type="password" name="password" required><br><br>

            <button type="submit">Se connecter</button>
        </form>

        <p>Pas encore inscrit ? <a href="?page=register">Créer un compte</a></p>
    </div>
</body>
</html>
