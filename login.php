
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
$messageErreur = "";
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
                header("Location: dashboardAgent.php");
                exit;
            case 2:
                // Redirection vers la page Technicien_SAV.php
                header("Location: dashboardTechnicien.php");
                exit;
            case 3:
                // Redirection vers la page client.php
                header("Location: client_page.php");
                exit;
            case 4:
                // Redirection vers la page client.php
                header("Location: dashboard.php");
                exit;
            default:
                // Redirection vers une page par défaut en cas de rôle non défini
                header("Location: default.php");
                exit;
        }
    } else {
        // L'utilisateur n'est pas authentifié
        echo "<script>alert('Votre mot de passe ou votre adresse email est incorrect.');</script>";
    }
}
?>

<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Login Form</title>
      <link rel="stylesheet" href="login.css">
     
   </head>
   <body>
      <div class="wrapper">
         <div class="title">
            Login Form
         </div>
         
         <form action="" method="POST">
            <div class="field">
               <input type="text" name="email" required>
               <label>Email Address</label>
            </div>
            <div class="field">
               <input type="password" name="password" required>
               <label>Password</label>
            </div>
            <div class="content">
               <div class="checkbox">
               </div>
               <div class="pass-link">
               </div>
            </div>
            <div class="field">
               <input type="submit" value="Login">
            </div>
            <div class="signup-link">
            </div>
         </form>
      </div>
   </body>
</html>

