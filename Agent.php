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

// Suppression d'un agent
if (isset($_GET['supprimer']) && !empty($_GET['supprimer'])) {
    $idAgent = $_GET['supprimer'];

    // Supprimer l'agent de la table "agents_sav"
    $query = "DELETE FROM agents_sav WHERE id_agent = :id_agent";
    $statement = $db->prepare($query);
    $statement->bindParam(':id_agent', $idAgent);
    $statement->execute();
}

// Récupérer les agents depuis la base de données
$query = "SELECT * FROM agents_sav";
$agents = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Liste des agents SAV</title>
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
    <h1>Liste des agents SAV</h1>

    <table>
        <tr>
            <th>ID Agent</th>
            <th>Nom Agent</th>
            <th>Prénom Agent</th>
            <th>Supprimer</th>
        </tr>
        <?php foreach ($agents as $agent) : ?>
            <tr>
                <td><?php echo $agent['id_agent']; ?></td>
                <td><?php echo $agent['nom_agent']; ?></td>
                <td><?php echo $agent['prenom_agent']; ?></td>
                <td><a href="?supprimer=<?php echo $agent['id_agent']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet agent ?')">Supprimer</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>