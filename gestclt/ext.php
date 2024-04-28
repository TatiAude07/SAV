<?php

require  'configuration.php';
// Récupération des données du formulaire d'inscription
session_start();
include ("connection.php");

if (isset($_POST['submit'])){
$nom_client = $_POST['name'];
$ville_client = $_POST['ville'];
$type_appareil = $_POST['type_appareil'];
$caracteristique = $_POST['caracteristique'];
$probleme = $_POST['probleme'];

// Requête SQL pour insérer les données de l'utilisateur dans la base de données
$sql = "INSERT INTO `maintenance` (nom_client,ville_client, type_appareil,caracteristique, probleme ) VALUES ('$nom_client','$ville_client', '$type_appareil', '$caracteristique','$probleme')";

$stmt = $conn->prepare($sql);

// Vérifier si la préparation a réussi
if ($stmt) {
    // Exécution de la requête
    if ($stmt->execute()) {
        echo '<div class="alert alert-success text-center" role="alert">
       client ajouter avec sucess 
    </div>';
    header('location:login.php');
    } else {
        echo '<div class="alert alert-danger text-center" role="alert">
        Erreur! Impossible d\'ajouter un client: ' . $stmt->error . '
    </div>';
    }
        // Fermeture du statement
        $stmt->close();
    } else {
        // En cas d'échec de la préparation
        echo '<div class="alert alert-danger text-center" role="alert">
        Erreur lors de la préparation de la requête: ' . $conn->error . '
    </div>';
    }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="ext.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire Achat à l'Extérieur</title>
</head>

<body>
<div class="container">
        <h1>Bienvenue Au Service De Maintenance</h1>
    <form>
        <h3>
        <label for="nomClient">Nom du client:</label><br>
        <input type="text" id="nomClient" name="nomClient"><br>
        <label for="ville">Ville:</label><br>
        <input type="text" id="ville" name="ville"><br>
        <label for="typeMateriel">Type de matériel:</label><br>
        <input type="text" id="typeMateriel" name="typeMateriel"><br>
        <label for="marque">Marque:</label><br>
        <input type="text" id="marque" name="marque"><br>
        <label for="caracteristiques">Caractéristiques:</label><br>
        <input type="text" id="caracteristiques" name="caracteristiques"><br>
        <label for="problemes">Problèmes observés:</label><br>
        <textarea id="problemes" name="problemes"></textarea><br>
        <input type="submit" value="Soumettre" class="submit-btn">
        </h3>
    </form>
</body>

</html>