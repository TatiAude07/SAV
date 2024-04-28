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

// Sélection des demandes à l'état 1
$query = "SELECT id_demande, date_creation, code_achat FROM demande WHERE Etat = 1";
$statement = $db->prepare($query);
$statement->execute();
$demandes = $statement->fetchAll(PDO::FETCH_ASSOC);
?>
<html>
    <head><title>Devis</title>
    <link rel="stylesheet" href="Devis.css">
    <link rel="stylesheet" href="details.css">

<table>
    <caption><h2>Liste des demandes à traiter !!!</caption></h2>
    <thead>
        <tr>
            <th>Date de demande</th>
            <th>Code d'achat</th>
            <th>Traiter</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($demandes as $demande) : ?>
            <tr>
                <td><?php echo $demande['date_creation']; ?></td>
                <td><?php echo $demande['code_achat']; ?></td>
                <td>
                    <a href="details_demande.php?id=<?php echo $demande['id_demande']; ?>">Traiter</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>