<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="ent.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire Achat dans l'Entreprise</title>
</head>

<body>
    <div class="container">
        <h1>Bienvenue Au Service Apres_vente</h1>
    <form>
        <label for="idMateriel">Sélectionnez l'ID du matériel:</label><br>
        <input type="text" id="idMateriel" name="idMateriel"><br>
        <label for="problemes">Problèmes observés:</label><br>
        <textarea id="problemes" name="problemes"></textarea><br>
        <label for="besoinsReparation">Besoins en réparation:</label><br>
        <textarea id="besoinsReparation" name="besoinsReparation"></textarea><br>
        <button type="submit">Soumettre</button> <!-- Ajout du bouton "Soumettre" -->
    </form>
</body>

</html>