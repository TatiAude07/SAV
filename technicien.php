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

// Suppression d'un technicien
if (isset($_GET['supprimer']) && !empty($_GET['supprimer'])) {
    $idTechnicien = $_GET['supprimer'];

    // Supprimer le technicien de la table
    $query = "DELETE FROM technicien WHERE id_technicien = :id_technicien";
    $statement = $db->prepare($query);
    $statement->bindParam(':id_technicien', $idTechnicien);
    $statement->execute();
}

// Récupérer les techniciens depuis la base de données
$query = "SELECT * FROM technicien";
$techniciens = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<div style="margin: 0 auto; width: 80%;">
<html>
<head>
    <title>Liste des techniciens</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: left;
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

        a {
            text-decoration: none;
            color: #007bff;
        }

        a:hover {
            text-decoration: underline;
            color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Liste des techniciens</h1>

    <table>
        <tr>
            <th>ID Technicien</th>
            <th>Nom Technicien</th>
            <th>Prénom Technicien</th>
            <th>Supprimer</th>
        </tr>
        <?php foreach ($techniciens as $technicien) : ?>
            <tr>
                <td><?php echo $technicien['id_technicien']; ?></td>
                <td><?php echo $technicien['nom_technicien']; ?></td>
                <td><?php echo $technicien['prenom_technicien']; ?></td>
                <td><a href="?supprimer=<?php echo $technicien['id_technicien']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce technicien ?')">Supprimer</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
        </div>