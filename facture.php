<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root"; // Mettez votre nom d'utilisateur MySQL
$password = ""; // Mettez votre mot de passe MySQL
$dbname = "espaces_membres";

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Vérifier si l'ID de la facture est défini dans l'URL et qu'il n'est pas vide
if(isset($_GET['id_facture']) && !empty($_GET['id_facture'])) {
    // Récupérer et échapper l'ID de la facture pour éviter les injections SQL
    $id_facture = $conn->real_escape_string($_GET['id_facture']);
    
    // Récupérer les données de la facture depuis la base de données
    $sql = "SELECT * FROM facture WHERE id_facture = '$id_facture'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        // Afficher les données de la facture
        $row = $result->fetch_assoc();
        $nom = $row['nom'];
        $telephone = $row['telephone'];
        $adresse = $row['adresse'];
        $date_facture = $row['date_facture'];

        // Générer la facture au format HTML
        $html = "
            <h2>Facture</h2>
            <p>Date de la facture: $date_facture</p>
            <p>Nom: $nom</p>
            <p>Téléphone: $telephone</p>
            <p>Adresse: $adresse</p>
            <p>Autres détails de la facture...</p>
        ";

        // Afficher la facture pour l'impression
        echo $html;
    } else {
        echo "Aucune facture trouvée avec cet ID.";
    }
} else {
    echo "L'ID de la facture n'est pas défini dans l'URL ou est vide.";
}

// Fermer la connexion à la base de données
$conn->close();
?>