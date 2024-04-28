<?php
include("dashboard.php");

?>
<?php
// Connexion à la base de données (à adapter selon votre configuration)
$dsn = "mysql:host=localhost;dbname=espaces_membres;charset=utf8";
$username = "root";
$password = "";

// Déclaration de l'encodage des caractères
header('Content-Type: text/html; charset=utf-8');

try {
    $db = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}

// Récupérer les demandes dont l'Etat est égal à 1
$query = "SELECT date_creation, code_achat, details_demande FROM demande WHERE Etat = 1";
$demandes = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Liste des demandes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <h1>Liste des demandes en cours!!!</h1>

    <table>
        <tr>
            <th>Date de création</th>
            <th>Code d'achat</th>
            <th>Détails de la demande</th>
        </tr>
        <?php foreach ($demandes as $demande) : ?>
            <tr>
                <td><?php echo $demande['date_creation']; ?></td>
                <td><?php echo $demande['code_achat']; ?></td>
                <td><?php echo $demande['details_demande']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>