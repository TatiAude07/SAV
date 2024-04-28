<?php
include("dashboardTechnicien.php");

?>


<?php
// Connexion à la base de données (à adapter selon votre configuration)
$dsn = "mysql:host=localhost;dbname=espaces_membres;charset=utf8";
$username = "root";
$password = "";

try {
    $db = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}
// Déclaration de l'encodage des caractères
header('Content-Type: text/html; charset=utf-8');

if(isset($_GET['id'])) {
    $idDemande = $_GET['id'];
    
    // Sélection des détails de la demande
    $query = "SELECT * FROM demande WHERE id_demande = :id_demande";
    $statement = $db->prepare($query);
    $statement->bindParam(':id_demande', $idDemande);
    $statement->execute();
    $detailsDemande = $statement->fetch(PDO::FETCH_ASSOC);
    
    if($detailsDemande) {
        // Afficher les détails de la demande
        echo "<h2>Détails de la demande</h2>";
        echo "<p>Date de demande: " . $detailsDemande['date_creation'] . "</p>";
        echo "<p>Code d'achat: " . $detailsDemande['code_achat'] . "</p>";
        echo "<p> Intitulé demande:". $detailsDemande['details_demande'] . "</p>";
        echo "<p> Date rendez-vous:". $detailsDemande['meetingDate'] . "</p>";
        echo "<p> Heure rendez-vous:". $detailsDemande['meetingTime'] . "</p>";
        
        
        
        // Afficher le formulaire de traitement
        echo "<form action='traiter_demande.php' method='POST'>";
        echo "<label for='description_reparation'>Description réparation:</label>";
        echo "<textarea name='description_reparation' rows='4' cols='50'></textarea><br>";
        echo "<label for='date_debut'>Date début:</label>";
        echo "<input type='date' name='date_debut'><br><br>.";
        echo "<label for='date_fin'>Date fin:</label>";
        echo "<input type='date' name='date_fin'><br><br>";
        echo "<label for='materiel'>Matériel:</label>";
        echo "<input type='text' name='materiel'><br><br>";
        echo "<label for='quantite'>Quantité:</label>";
        echo "<input type='text' name='quantite'><br><br>";
        echo "<input type='hidden' name='id_demande' value='" . $idDemande . "'>";
        echo "<input type='submit' value='Envoyer'>";
        echo "</form>";
    } else {
        echo "Détails de la demande non trouvés.";
    }
} else {
    echo "ID de demande non spécifié.";
}
?>
<html>
    <head><title>Formulaire</title>
        <link rel="stylesheet" href="details.css">
</head>
</htmL>
