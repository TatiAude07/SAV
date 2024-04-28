<?php

// Connexion à la base de données
$serveur = "localhost"; // Adresse du serveur MySQL
$utilisateur = "root"; // Nom d'utilisateur MySQL
$motdepasse = ""; // Mot de passe MySQL
$basededonnees = "espaces_membres"; // Nom de la base de données

$demandeId = $_GET['demandeId'];
$etat = $_GET['etat'];

try {
    // Connexion à la base de données
    $bdd = new PDO("mysql:host=$serveur;dbname=$basededonnees;charset=utf8", $utilisateur, $motdepasse);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Activer le mode exception pour les erreurs PDO
    
    // Mettre à jour l'état de la demande
    $requete = $bdd->prepare("UPDATE demande SET Etat = :etat WHERE id_demande = :demandeId");
    $requete->bindParam(':etat', $etat);
    $requete->bindParam(':demandeId', $demandeId);
    $requete->execute();
    
    echo "L'état de la demande a été mis à jour avec succès.";
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
    die(); // Arrêter l'exécution du script en cas d'erreur de connexion
}

?>