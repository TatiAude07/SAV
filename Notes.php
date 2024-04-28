<?php
include("dashboardAgent.php");

?>

<?php

// Connexion à la base de données
$serveur = "localhost"; // Adresse du serveur MySQL
$utilisateur = "root"; // Nom d'utilisateur MySQL
$motdepasse = ""; // Mot de passe MySQL
$basededonnees = "espaces_membres"; // Nom de la base de données

try {
    // Connexion à la base de données
    $bdd = new PDO("mysql:host=$serveur;dbname=$basededonnees;charset=utf8", $utilisateur, $motdepasse);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Activer le mode exception pour les erreurs PDO
    
    // Sélection des demandes à l'état 0
    $requete = $bdd->prepare("SELECT id_demande, code_achat, date_creation FROM demande WHERE Etat = 0");
    $requete->execute();
    $demandes = $requete->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
    die(); // Arrêter l'exécution du script en cas d'erreur de connexion
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des demandes</title>
    <link rel="stylesheet" href="Notes.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }
        
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 50%;
        }
        
        .modal-buttons {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>Liste des demandes!!!</h1>
    
    <?php if (!empty($demandes)) { ?>
        <table>
            <thead>
                <tr>
                    <th>Date de demande</th>
                    <th>Code Achat</th>
                    <th>Visualiser</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($demandes as $demande) { ?>
                    <tr>
                        <td><?php echo $demande['date_creation']; ?></td>
                        <td><?php echo $demande['code_achat']; ?></td>
                        <td>
                            <button onclick="openModal(<?php echo $demande['id_demande']; ?>)">Visualiser</button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p>Aucune demande à l'état 0 trouvée.</p>
    <?php } ?>

    <div id="modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Visualiser la demande</h2>
                <span class="modal-close" onclick="closeModal()">&times;</span>
            </div>
            <div class="modal-body">
                <p><strong>Code d'achat :</strong> <span id="codeAchat"></span></p>
                <p><strong>Détails de la demande :</strong> <span id="detailsDemande"></span></p>
                <button onclick="validerDemande()">Valider</button>
                <button onclick="refuserDemande()">Refuser</button>
            </div>
        </div>
    </div>

    <script>
        let currentDemandeId = null;
        
        function openModal(demandeId) {
    currentDemandeId = demandeId;

    // Récupérer les détails de la demande à partir du serveur
    $.getJSON("get_details.php?demandeId=" + demandeId, function(data) {
        // Afficher les détails de la demande dans la fenêtre modale
        $("#codeAchat").text(data.code_achat);
        $("#detailsDemande").text(data.details_demande);

        // Afficher la fenêtre modale
        $("#modal").css("display", "block");
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        console.error("Erreur lors de la récupération des détails de la demande :", errorThrown);
    });
}
        
        function validerDemande() {
            if (currentDemandeId!= null) {
                // Mettre à jour l'état de la demande à 1 dans la base de données
                fetch("update_demande.php?demandeId=" + currentDemandeId + "&etat=1")
                    .then(response => response.text())
                    .then(data => {
                        // Fermer la fenêtre modale
                        document.getElementById("modal").style.display = "none";
                        
                        // Recharger la page pour afficher les demandes mises à jour
                        location.reload();
                    })
                    .catch(error => {
                        console.error("Erreur lors de la mise à jour de l'état de la demande :", error);
                    });
            }
        }
        
        function refuserDemande() {
            if (currentDemandeId != null) {
                // Mettre à jour l'état de la demande à 2 dans la base de données
                fetch("update_demande.php?demandeId=" + currentDemandeId + "&etat=2")
                    .then(response => response.text())
                    .then(data => {
                        // Fermer la fenêtre modale
                        document.getElementById("modal").style.display = "none";
                        
                        // Recharger la page pour afficher les demandes mises à jour
                        location.reload();
                    })
                    .catch(error => {
                        console.error("Erreur lors de la mise à jour de l'état de la demande :", error);
                    });
            }
        
      }
      function closeModal() {
    $("#modal").css("display", "none");
}
    </script>
</body>
</html>