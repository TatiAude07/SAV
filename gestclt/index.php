<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demande de Service Après-Vente</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Demande de Service Après-Vente</h1>

    <form>
        <div class="form-group">
            <label for="achatDansEntreprise">Le matériel a-t-il été acheté dans notre entreprise ?</label>
            <select id="achatDansEntreprise" onchange="redirigerPage()">
                <option value="">Choisissez une option</option>
                <option value="oui">Oui</option>
                <option value="non">Non</option>
            </select>
        </div>
    </form>

    <script>
        function redirigerPage() {
            var choix = document.getElementById("achatDansEntreprise").value;
            if (choix === "oui") {
                window.location.href = "ent.php";
            } else if (choix === "non") {
                window.location.href = "ext.php";

            }
        }
    </script>
</body>

</html>