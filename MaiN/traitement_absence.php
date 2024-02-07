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

// Récupération de l'identifiant de l'élève et du statut à mettre à jour
if (isset($_GET['username']) && isset($_GET['statut'])) {
    $username = $_GET['username'];
    $statut = $_GET['statut'];

    // Mise à jour du statut de l'élève
    $updateStatutQuery = "UPDATE user SET statut = '$statut' WHERE username = '$username'";

    if ($conn->query($updateStatutQuery) === TRUE) {
        // Redirection vers la page prof.php après la mise à jour
        header("Location: prof.php");
        exit();
    } else {
        echo "Erreur lors de la mise à jour du statut.";
    }
}

// Fermeture de la connexion à la base de données
$conn->close();
?>
