<?php
// Connexion à la base de données
$servername = "localhost";  // Adresse du serveur MySQL
$username = "admin";  // Nom d'utilisateur MySQL
$password = "thomas1";  // Mot de passe MySQL
$dbname = "SAE502";  // Nom de la base de données

// Création de la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
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

    if ($result->num_rows > 0) {
        // L'utilisateur est authentifié avec succès

        // Mise à jour du statut de l'utilisateur dans la table user
        $updateStatutQuery = "UPDATE user SET statut = '$confirmation' WHERE username = '$username'";

        if ($conn->query($updateStatutQuery) === TRUE) {
            // Affichage du message de réussite
            echo '<div style="text-align: center; padding: 20px; background-color: #4CAF50; color: white;">Mise à jour du statut réussie : ' . $confirmation . '</div>';
            echo '<a href="index.html" style="display: block; text-align: center; margin-top: 10px;">Retour à la page d\'accueil</a>';        
} else {
            // Affichage du message d'échec
            echo '<div style="text-align: center; padding: 20px; background-color: #f44336; color: white;">Erreur lors de la mise à jour du statut.</div>';
            echo '<a href="index.html" style="display: block; text-align: center; margin-top: 10px;">Retour à la page d\'accueil</a>';        
}
    } else {
        // Identifiants invalides
        echo '<div style="text-align: center; padding: 20px; background-color: #f44336; color: white;">Identifiants invalides</div>';
        echo '<a href="index.html" style="display: block; text-align: center; margin-top: 10px;">Retour à la page d\'accueil</a>';
    }
}

// Fermeture de la connexion à la base de données
$conn->close();
?>
