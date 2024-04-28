<?php
include("dashboardAgent.php");
?>
<?php
// Connexion à la base de données (à adapter selon votre configuration)
$dsn = "mysql:host=localhost;dbname=espaces_membres;charset=utf8";
$username = "root";
$password = "";

try {
    $connexion = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}

// Requête pour récupérer les données de la table "article"
$query = "SELECT * FROM article";
$statement = $connexion->prepare($query);
$statement->execute();
$articles = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Liste des article</title>
    <style>
    body {
    font-family: Arial, sans-serif;
    background-color: #f9f9f9;
    margin: 0;
    padding: 0;
}

h2 {
    text-align: center;
    color: #333;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

thead {
    background-color: #f2f2f2;
}

th, td {
    padding: 10px;
    text-align: left;
}

th {
    background-color: #333;
    color: white;
}

tr:nth-child(even) {
    background-color: #f9f9f9;
}

tr:nth-child(odd) {
    background-color: #e9e9e9;
}

    </style>
</head>
<body>
    <h2>Liste des articles</h2>

    <table>
        <thead>
            <tr>
                <th>ID Article</th>
                <th>Libellé Article</th>
                <th>Quantité en Stock</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($articles as $article) { ?>
                <tr>
                    <td><?php echo $article['id_article']; ?></td>
                    <td><?php echo $article['libelle_article']; ?></td>
                    <td><?php echo $article['qte_stock']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
