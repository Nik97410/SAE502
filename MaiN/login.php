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

// Récupération des données du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmation = $_POST['confirmation'];

    // Vérification des identifiants dans la base de données
    $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    echo '<!DOCTYPE html>';
    echo '<html lang="en">';
    echo '<head>';
    echo '<meta charset="UTF-8">';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
    echo '<title>Login</title>';
    echo '<link rel="stylesheet" href="style2.css">'; // Lien vers le fichier style2.css

    // Styles supplémentaires spécifiques à login.php
    echo '<style>';
    echo '/* Ajoutez ici vos styles spécifiques à login.php si nécessaire */';
    echo '</style>';

    echo '</head>';
    echo '<body>';

    echo '<div id="container">';

    if ($result->num_rows > 0) {
        // L'utilisateur est authentifié avec succès
        $row = $result->fetch_assoc();
        $userId = $row['username'];

        // Mise à jour du statut de l'utilisateur dans la table user
        $updateStatutQuery = "UPDATE user SET statut = '$confirmation' WHERE username = '$username'";

        if ($conn->query($updateStatutQuery) === TRUE) {
            // Affichage du message de réussite avec lien de retour
            echo '<div class="success">Mise à jour du statut réussie : ' . $confirmation . '</div>';
            echo '<a href="index.html" class="return-link">Retour à la page d\'accueil</a>';
        } else {
            // Affichage du message d'échec
            echo '<div class="error">Erreur lors de la mise à jour du statut.</div>';
        }
    } else {
        // Identifiants invalides
        echo '<div class="error">Identifiants invalides</div>';
    }

    echo '</div>';

    echo '</body>';
    echo '</html>';
}

// Fermeture de la connexion à la base de données
$conn->close();
?>
