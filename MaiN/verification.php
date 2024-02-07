<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification</title>
    <style>
        body {
            background-color: #3498db; /* Bleu clair */
            color: #ffffff; /* Texte en blanc */
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 20px;
        }

        h1 {
            font-size: 36px;
        }

        .success-message {
            background-color: #27ae60; /* Vert */
            padding: 20px;
            margin: 20px;
            border-radius: 10px;
        }

        .return-button {
            background-color: #2c3e50; /* Gris foncé */
            color: #ffffff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 18px;
            margin-top: 20px;
            display: inline-block;
        }
    </style>
</head>
<body>

<div id="container">
    <?php
    // Connexion à la base de données
    $servername = "localhost";
    $username = "admin";
    $password = "thomas1";
    $dbname = "SAE502";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Vérifier si le formulaire a été soumis pour ajouter un nouvel utilisateur
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['new_username']) && isset($_POST['new_password'])) {
        // Récupérer les valeurs du formulaire
        $newUsername = $_POST['new_username'];
        $newPassword = $_POST['new_password'];

        // Vérifier si l'utilisateur n'existe pas déjà
        $checkUserQuery = "SELECT * FROM user WHERE username = '$newUsername'";
        $result = $conn->query($checkUserQuery);

        if ($result->num_rows == 0) {
            // Ajouter le nouvel utilisateur à la base de données
            $addUserQuery = "INSERT INTO user (username, password, statut) VALUES ('$newUsername', '$newPassword', 'absent')";

            if ($conn->query($addUserQuery) === TRUE) {
                echo '<p class="success-message">Nouvel utilisateur ajouté avec succès.</p>';
            } else {
                echo '<p class="error-message">Erreur lors de l\'ajout du nouvel utilisateur.</p>';
            }
        } else {
            echo '<p class="error-message">Cet utilisateur existe déjà.</p>';
        }
    }

    // Vérifier si le formulaire a été soumis pour la suppression d'un utilisateur
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['user_to_delete'])) {
        $userToDelete = $_POST['user_to_delete'];

        // Suppression de l'utilisateur de la base de données
        $deleteUserQuery = "DELETE FROM user WHERE username = '$userToDelete'";
        
        if ($conn->query($deleteUserQuery) === TRUE) {
            echo '<p class="success-message">Utilisateur "'.$userToDelete.'" supprimé avec succès.</p>';
        } else {
            echo '<p class="error-message">Erreur lors de la suppression de l\'utilisateur.</p>';
        }
    }

    // Fermeture de la connexion à la base de données
    $conn->close();
    ?>

    <div class="footer">
        <form action="prof.php">
            <input type="submit" value="Retour à la page Professeur">
        </form>
    </div>
</div>

</body>
</html>
