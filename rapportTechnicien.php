<?php
include("dashboardAgent.php");

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

// Récupérer les interventions depuis la base de données
$query = "SELECT date_debut, date_fin, description, quantite, materiel FROM intervention";
$interventions = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Liste des interventions</title>
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
    <h1>Liste des interventions</h1>

    <table>
        <tr>
            <th>Date de début</th>
            <th>Date de fin</th>
            <th>Description</th>
            <th>Quantité</th>
            <th>Matériel</th>
        </tr>
        <?php foreach ($interventions as $intervention) : ?>
            <tr>
                <td><?php echo $intervention['date_debut']; ?></td>
                <td><?php echo $intervention['date_fin']; ?></td>
                <td><?php echo $intervention['description']; ?></td>
                <td><?php echo $intervention['quantite']; ?></td>
                <td><?php echo $intervention['materiel']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>