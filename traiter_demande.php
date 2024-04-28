
<?php
// Connexion à la base de données (à adapter selon votre configuration)
$dsn = "mysql:host=localhost;dbname=espaces_membres;charset=utf8";
$username = "root";
$password = "";

// Déclaration de l'encodage des caractères
header('Content-Type: text/html; charset=utf-8');

try {
    $db = new PDO($dsn, $username, $password);

if(isset($_POST['date_debut']) && isset($_POST['quantite'])) {
    // Récupérer les valeurs des champs
    $dateDebut = $_POST['date_debut'];
    $quantite = $_POST['quantite'];

    // Utiliser les valeurs récupérées
    // ...
} else {
    // Afficher un message d'erreur ou effectuer une autre action appropriée
    echo "Certains champs du formulaire ne sont pas définis.";
}
if(isset($_POST['id_demande'])) {
    $idDemande = $_POST['id_demande'];
    $dateDebut = $_POST['date_debut'];
    $dateFin = $_POST['date_fin'];
    $description = $_POST['description_reparation'];
    $quantite = $_POST['quantite'];
    $materiel = $_POST['materiel'];

    // Insérer les données dans la table "intervention"
    $query = "INSERT INTO intervention (id_demande, date_debut, date_fin, description, quantite, materiel)
              VALUES (:id_demande, :date_debut, :date_fin, :description, :quantite, :materiel)";
    $statement = $db->prepare($query);
    $statement->bindParam(':id_demande', $idDemande);
    $statement->bindParam(':date_debut', $dateDebut);
    $statement->bindParam(':date_fin', $dateFin);
    $statement->bindParam(':description', $description);
    $statement->bindParam(':quantite', $quantite);
    $statement->bindParam(':materiel', $materiel);
    $statement->execute();

    // Mettre à jour l'état de la demande à 3
    $query = "UPDATE demande SET Etat = 3 WHERE id_demande = :id_demande";
    $statement = $db->prepare($query);
    $statement->bindParam(':id_demande', $idDemande);
    $statement->execute();

   /* echo '<div style="background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; border-radius: .25rem; padding: .75rem 1.25rem; margin-top: 20px;">
    Votre demande a été enregistrée avec succès.
  </div>';*/
  $message = '<div style="background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; border-radius: .25rem; padding: .75rem 1.25rem; margin-top: 20px;">
  Votre demande a été enregistrée avec succès.
   </div>';
}
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}
?>
<html>
<head>
    <link rel="stylesheet" href="details.css">
</head>
<body>
    <?php echo $message; ?> <!-- Afficher le message ici -->
    <!-- Le reste du contenu de la page -->
</body>
</html>