<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Professeur</title>
    <link rel="stylesheet" href="style.css"> <!-- Lien vers votre fichier de style CSS -->
</head>
<body>

<div id="container">
    <h1>Connexion Professeur</h1>

    <div class="login-form">
        <form method="post" action="">
            <label for="username">Identifiant :</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" value="Se connecter">
        </form>
    </div>

    <div class="footer">
        <form action="index.html">
            <input type="submit" value="Retour à l'accueil">
        </form>
    </div>

    <?php
    // Vérifier si le formulaire a été soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username']) && isset($_POST['password'])) {
        // Récupérer les valeurs du formulaire
        $inputUsername = $_POST['username'];
        $inputPassword = $_POST['password'];

        // Connexion à la base de données
        $servername = "localhost";
        $dbUsername = "admin";
        $dbPassword = "thomas1";
        $dbname = "SAE502";

        $conn = new mysqli($servername, $dbUsername, $dbPassword, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Vérifier les informations de connexion dans la table 'prof'
        $query = "SELECT * FROM prof WHERE username = '$inputUsername' AND password = '$inputPassword'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            // Connexion réussie
            // Rediriger vers la page prof.php
            header("Location: prof.php");
            exit(); // Assurez-vous de terminer l'exécution du script après la redirection
        } else {
            // Identifiants incorrects
            echo "Identifiants incorrects.";
        }

        // Fermeture de la connexion à la base de données
        $conn->close();
    }
    ?>

</div>

</body>
</html>
