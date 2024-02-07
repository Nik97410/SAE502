<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Professeur</title>
    <link rel="stylesheet" href="style3.css"> <!-- Ajout du lien vers style3.css -->
</head>
<body>

<div id="container">
    <h1>Liste des élèves</h1>

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

    // Vérifier si le formulaire a été soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupérer les valeurs du formulaire
        $username = $_POST['username'];
        $newStatut = $_POST['new_statut'];

        // Mise à jour du statut de l'élève
        $updateStatutQuery = "UPDATE user SET statut = '$newStatut' WHERE username = '$username'";

        if ($conn->query($updateStatutQuery) === TRUE) {
            echo "Statut mis à jour avec succès.";
        } else {
            echo "Erreur lors de la mise à jour du statut.";
        }
    }

    // Afficher les élèves pour chaque statut
    afficherTableau("Présents", "present");
    afficherTableau("En Retard (5 minutes)", "retard_5min");
    afficherTableau("En Retard (10 minutes)", "retard_10min");
    afficherTableau("Absents", "absent");

    // Fermeture de la connexion à la base de données
    $conn->close();

    function afficherTableau($titre, $statut) {
        global $conn;

        echo '<div class="table-container">';
        echo "<h2>Élèves $titre</h2>";
        echo '<form method="post" action="">';
        echo '<table>';
        echo '<tr><th>Identifiant</th><th>Statut</th><th>Modifier Statut</th></tr>';

        $result = $conn->query("SELECT username, statut FROM user WHERE statut = '$statut'");

        while ($row = $result->fetch_assoc()) {
            echo '<tr><td>' . $row['username'] . '</td><td>' . $row['statut'] . '</td>';
            
            // Ajout de la liste déroulante pour modifier le statut
            echo '<td>';
            echo '<select name="new_statut">';
            echo '<option value="present">Présent</option>';
            echo '<option value="retard_5min">Retard 5 min</option>';
            echo '<option value="retard_10min">Retard 10 min</option>';
            echo '<option value="absent">Absent</option>';
            echo '</select>';
            echo '<input type="hidden" name="username" value="' . $row['username'] . '">';
            echo '<input type="submit" value="Modifier">';
            echo '</td></tr>';
        }

        echo '</table>';
        echo '</form>';
        echo '</div>';
    }
    ?>

<div class="footer">
    <form action="index.html">
        <input type="submit" value="Retour à l'accueil">
    </form>
    <!-- Formulaire pour ajouter un nouvel utilisateur -->
    <h2>Ajouter un nouvel utilisateur</h2>
    <form method="post" action="verification.php"> <!-- Modification ici -->
        <label for="new_username">Identifiant :</label>
        <input type="text" id="new_username" name="new_username" required>

        <label for="new_password">Mot de passe :</label>
        <input type="password" id="new_password" name="new_password" required>

        <input type="submit" value="Ajouter utilisateur">
    </form>
    <h2>Supprimer un utilisateur</h2>
    <form method="post" action="verification.php">
        <label for="user_to_delete">Choisir un utilisateur à supprimer :</label>
        <select name="user_to_delete" id="user_to_delete">
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
            // Récupérer la liste des utilisateurs
            $userListQuery = "SELECT username FROM user";
            $userListResult = $conn->query($userListQuery);

            while ($userRow = $userListResult->fetch_assoc()) {
                echo '<option value="' . $userRow['username'] . '">' . $userRow['username'] . '</option>';
            }
            ?>
        </select>
        <input type="submit" value="Supprimer">
    </form>

    <?php
    // Traitement de la suppression d'utilisateur
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['user_to_delete'])) {
        $userToDelete = $_POST['user_to_delete'];

        // Suppression de l'utilisateur de la base de données
        $deleteUserQuery = "DELETE FROM user WHERE username = '$userToDelete'";
        
        if ($conn->query($deleteUserQuery) === TRUE) {
            echo "Utilisateur '$userToDelete' supprimé avec succès.";
        } else {
            echo "Erreur lors de la suppression de l'utilisateur.";
        }
    }
    ?>
</div>

</div>

</body>
</html>
