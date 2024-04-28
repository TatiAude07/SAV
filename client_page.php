<?php
session_start();
/*if(!$_SESSION['gest_id']){
  header("Location: page_login.php");
}*/
?>

<?php
if (!session_id()) {
    session_start();
}

// Connexion à la base de données
$serveur = "localhost"; // Adresse du serveur MySQL
$utilisateur = "root"; // Nom d'utilisateur MySQL
$motdepasse = ""; // Mot de passe MySQL
$basededonnees = "espaces_membres"; // Nom de la base de données

// Vérification si le formulaire est soumis
if (isset($_POST['valider'])) {
    try {
        // Connexion à la base de données
        $bdd = new PDO("mysql:host=$serveur;dbname=$basededonnees;charset=utf8", $utilisateur, $motdepasse);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Activer le mode exception pour les erreurs PDO

        // Fonction pour générer une chaîne aléatoire de 3 caractères
        function randomString($length = 3) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, strlen($characters) - 1)];
            }
            return $randomString;
        }

        // Requête d'insertion
        $requete = $bdd->prepare("INSERT INTO demande (code_achat, date_creation, date_modification, details_demande, code_traitement, meetingDate, meetingTime) VALUES (:valeur1, :valeur2, :valeur3, :valeur4, :valeur5, :valeur6, :valeur7)");

        // Liaison des valeurs aux paramètres de la requête
        $requete->bindParam(':valeur1', $var1);
        $requete->bindParam(':valeur2', $var2);
        $requete->bindParam(':valeur3', $var3);
        $requete->bindParam(':valeur4', $var4);
        $requete->bindParam(':valeur5', $var5);
        $requete->bindParam(':valeur6', $var6);
        $requete->bindParam(':valeur7', $var7);

        // Récupération des valeurs du formulaire
        $var1 = $_POST['code_achat'];
        $var2 = date("Y-m-d H:i:s");
        $var3 = date("Y-m-d H:i:s");
        $var4 = $_POST['message'];
        // Génération d'une chaîne aléatoire pour 'code_traitement'
        $var5 = randomString();

        // Validate meeting date and time
        $meetingDate = $_POST['meetingDate'];
        $meetingTime = $_POST['meetingTime'];

        // Vérification si la date de réunion est renseignée
        if (empty($meetingDate)) {
            echo '<div class="alert alert-danger alert-dismissible" role="alert">
                    <div>La date de réunion est requise.</div>
                  </div>';
        } elseif (strtotime($meetingDate) < strtotime(date("Y-m-d")) || strtotime($meetingDate) > strtotime('+2 months')) {
            // Vérification si la date de réunion est valide
            echo '<div class="alert alert-danger alert-dismissible" role="alert">
                    <div>La date doit être aujourd\'hui ou ultérieure, mais pas plus de deux mois à partir d\'aujourd\'hui.</div>
                  </div>';
        } else {
            // Exécution de la requête
            $var6 = $meetingDate; // Définir la valeur de meetingDate
            $var7 = $meetingTime;
            $requete->execute();

            // Affichage d'un message de succès
            echo '<div class="alert alert-success alert-dismissible" role="alert">
                    <div>Votre demande a été enregistrée avec succès.</div>
                  </div>';
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>

            
            




<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Contact</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSS FILES -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">

        <link href="assets/css/bootstrap.min.css" rel="stylesheet">

        <link href="assets/css/bootstrap-icons.css" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

        <link href="assets/css/stylesheet.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    
    </head>

    <body>
        <?php
            include ("header.php")
        ?>
        <main class="whole">
            <section id="home">
                <div class="container-fluid h-100">
                    <div class="row h-100">
                            <div class="col-md-offset-3 col-md-6 col-sm-12">
                                <div class="home-info">
                                    <p class="small-title">Bienvenue sur la plateforme du <strong class="text-warning">service après-vente</strong>.</p>

                                    <h4>Contactez-nous,  <span class="text-warning">soumettez </span> vos besoins, <span class="text-warning">suivez</span> l'avancement de vos demandes!!!</h4>

                                    <div class="d-flex align-items-center mt-4">
                                    <a class="custom-btn btn custom-link"  href="https://higherglorytechnologies.com/?page_id=26ss">Visiter notre site</a>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </section>

            <section class="contact" id="section_5">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#63a1fd" fill-opacity="1" d="M0,288L48,272C96,256,192,224,288,197.3C384,171,480,149,576,165.3C672,181,768,235,864,250.7C960,267,1056,245,1152,250.7C1248,256,1344,288,1392,304L1440,320L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>

                <div class="contact-container-wrap">
                    <div class="container">
                        <div class="row">

                            <div class="col-lg-6 col-12">
                            <form class="custom-form contact-form" action="" method="post" role="form" enctype="multipart/form-data" onsubmit="return validateForm()">
                            <strong class="text-white">Vous avez un souci ?</strong>
                            <h2 class="mb-5 text-white">Nous Contacter</h2>
                            <div class="row">
                                <div class="col-12">
                                    <input type="text" name="code_achat" id="code_achat" class="form-control" placeholder="Référence appareil" required>
                                    <textarea class="form-control" rows="7" id="message" name="message" placeholder="Description problème"></textarea>
                                    <label for="meetingDate">Date de rendez-vous:</label>
                                    <input type="date" id="meetingDate" name="meetingDate" required><br><br>
                                    <label for="meetingTime">Heure de rendez-vous (entre 8h et 17h):</label>
                                    <input type="time" id="meetingTime" name="meetingTime" min="08:00" max="17:00" required><br><br>
                                    <button type="submit" name="valider" class="form-control">Envoyer <span class="bi bi-send ml-2"></span></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="contact-thumb">
                            <div class="contact-info bg-white shadow-lg">
                                <h5 class="mb-4">Bepanda axe lourd, Douala, Cameroun</h5>
                                <h5 class="mb-2">
                                    <a href="tel:0237670724159">
                                        <i class="bi bi-telephone contact-icon me-2"></i>
                                        +237 6 70 72 41 59
                                    </a>
                                </h5>
                                <h6>
                                    <a href="mailto:info@company.com" class="footer-link">
                                        <i class="bi bi-envelope-fill contact-icon me-2"></i>
                                        info@company.com
                                    </a>
                                </h6>
                                <!-- Insérez ici le code d'intégration de la carte Google Maps -->
                                <iframe class="google-map mt-4" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4063.103580426464!2d-83.0264337484065!3d42.33402597908653!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x883b2cce05ddf4f1%3A0xcc0559eb3fda00c9!2sDetroit%20Riverwalk%2C%20Detroit%2C%20MI!5e1!3m2!1sen!2sus!4v1657814406289!5m2!1sen!2sus" width="100%" height="300" allowfullscreen="" loading="lazy"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="track">
            <div class="container">
                <div class="container-fluid h-100">
                    <div class="row h-100">
                        <div class="col-md-offset-3 col-md-6 col-sm-12">
                            <div class="home-info">
                                <strong class="text-secondary">Vous nous avez transmis une demande ?</strong>
                                <h2 class="mb-5 text-secondary">Suivre votre demande</h2>
                                <form action="" method="get" class="online-form">
                                    <input type="email" name="email" class="form-control" placeholder="Entrer code de suivi" required>
                                    <button type="submit" class="form-control">Valider</button><br><br>
                                    
                        
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include("footer.php"); ?>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
    
    <!-- Initialize the date picker -->
    <script>
        $(document).ready(function(){
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
                startDate: '+0d', // Allow only current and future dates
                endDate: '+2m' // Allow dates up to 2 months in the future
            });
        });
    </script>
    <script src="client.js"></script>
</body>
</html>

    <!-- Initialize the date picker -->
    <script>
        $(document).ready(function(){
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
                startDate: '+0d', // Allow only current and future dates
                endDate: '+2m' // Allow dates up to 2 months in the future
            });
        });
    </script>
    <script src="client.js"></script>
</body>
</html>