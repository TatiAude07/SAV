<?php
// Connexion à la base de données
$serveur = "localhost"; // Adresse du serveur MySQL
$utilisateur = "root"; // Nom d'utilisateur MySQL
$motdepasse = ""; // Mot de passe MySQL
$basededonnees = "espaces_membres"; // Nom de la base de données

try {
    $bdd = new PDO("mysql:host=$serveur;dbname=$basededonnees;charset=utf8", $utilisateur, $motdepasse);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Activer le mode exception pour les erreurs PDO
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
    die();
}

// Vérification du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Requête pour vérifier l'utilisateur et son rôle
    $requete = $bdd->prepare("SELECT id_users, role FROM users WHERE email = :email AND password = :password");
    $requete->execute(array(
        "email" => $email,
        "password" => $password
    ));

    $resultat = $requete->fetch();

    if ($resultat) {
        // L'utilisateur est authentifié
        $role = $resultat['role'];
        switch ($role) {
            case 1:
                // Redirection vers la page Agent_SAV.php
                header("Location: Notes.php");
                exit;
            case 2:
                // Redirection vers la page Technicien_SAV.php
                header("Location: Devis.php");
                exit;
            case 3:
                // Redirection vers la page client.php
                header("Location: client_page.php");
                exit;
            case 4:
                // Redirection vers la page client.php
                header("Location: dashboard.html");
                exit;
            default:
                // Redirection vers une page par défaut en cas de rôle non défini
                header("Location: default.php");
                exit;
        }
    } else {
        // L'utilisateur n'est pas authentifié, afficher un message d'erreur en rouge
        $messageErreur = "Votre adresse email ou mot de passe est incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <style>
        .error-message {
            color: red;
        }
    </style>
</head>
<body>
    <h1>Connexion</h1>
    <?php if (isset($messageErreur)) : ?>
        <p class="error-message"><?= $messageErreur ?></p>
    <?php endif; ?>
    <form action="" method="post">
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required><br><br>
        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>