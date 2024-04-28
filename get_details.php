<?php

// Connexion à la base de données
$serveur = "localhost"; // Adresse du serveur MySQL
$utilisateur = "root"; // Nom d'utilisateur MySQL
$motdepasse = ""; // Mot de passe MySQL
$basededonnees = "espaces_membres"; // Nom de la base de données

$demandeId = $_GET['demandeId'];

try {
    // Connexion à la base de données
    $bdd = new PDO("mysql:host=$serveur;dbname=$basededonnees;charset=utf8", $utilisateur, $motdepasse);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Activer le mode exception pour les erreurs PDO
    
    // Récupérer les détails de la demande
    $requete = $bdd->prepare("SELECT code_achat, details_demande FROM demande WHERE id_demande = :demandeId");
    $requete->bindParam(':demandeId', $demandeId);
    $requete->execute();
    $detailsDemande = $requete->fetch(PDO::FETCH_ASSOC);
    
    // Retourner les détails de la demande au format JSON
    header('Content-Type: application/json');
    echo json_encode($detailsDemande);
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
    die(); // Arrêter l'exécution du script en cas d'erreur de connexion
}

?>