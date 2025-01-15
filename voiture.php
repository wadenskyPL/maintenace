<?php
// Configuration de la base de données
$servername = "sql5.freesqldatabase.com";
$username = "sql5757833";
$password = "1szAScjDI6";
$dbname = "sql5757833";

// Connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// Gestion de l'ajout des données du véhicule
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matricule = $_POST['matricule'];
    $nom_de_voiture = $_POST['nom_dela_voiture'];
    $marque = $_POST['marque'];
    $annee = $_POST['annee'];
    $expiration_assurances = $_POST['expiration_assurances'];

    $sql = "INSERT INTO vehicules (matricule, nom_dela_voiture, marque, annee, expiration_assurances) 
            VALUES ('$matricule', '$nom_de_voiture', '$marque', '$annee', '$expiration_assurances')";

    if ($conn->query($sql) === TRUE) {
        echo "Nouveau véhicule ajouté avec succès";
    } else {
        echo "Erreur: " . $sql . "<br>" . $conn->error;
    }
}

// Récupérer les données des véhicules
$sql = "SELECT matricule, nom_dela_voiture, marque, annee, expiration_assurances, date_enregistrement FROM vehicules";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Enregistrement de Véhicules</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Ajouter votre style CSS ici */
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        .menu {
            text-align: right;
            margin-bottom: 20px;
        }
        .menu a {
            margin-left: 10px;
            text-decoration: none;
            color: blue;
        }
        .form-container {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>

    <div class="menu">
        <a href="voitures.php">Ajouter des voitures</a>
        <a href="voitures.php">Liste des voitures</a>
        <a href="maintenances.php">Maintenances</a>
        <a href="generatrices.php">Génératrices</a>
    </div>

    <h2>Ajouter un Véhicule</h2>

    <div class="form-container">
        <!-- Formulaire d'enregistrement des véhicules -->
        <form method="post" action="voitures.php">
            <label for="matricule">Matricule :</label>
            <input type="text" id="matricule" name="matricule" placeholder="Matricule du véhicule" required>

            <label for="nom_dela_voiture">Nom de la Voiture :</label>
            <input type="text" id="nom_dela_voiture" name="nom_dela_voiture" placeholder="Nom de la voiture" required>

            <label for="marque">Marque :</label>
            <input type="text" id="marque" name="marque" placeholder="Marque du véhicule" required>

            <label for="annee">Année de fabrication :</label>
            <input type="number" id="annee" name="annee" placeholder="Année de fabrication" required>

            <label for="expiration_assurances">Date d'expiration de l'assurance :</label>
            <input type="date" id="expiration_assurances" name="expiration_assurances" required>

            <input type="submit" value="Enregistrer">
        </form>
    </div>

    <h2>Liste des Véhicules Enregistrés</h2>

    <!-- Table pour afficher les données des véhicules -->
    <table>
        <thead>
            <tr>
                <th>Matricule</th>
                <th>Nom de la Voiture</th>
                <th>Marque</th>
                <th>Année</th>
                <th>Date Expiration Assurance</th>
                <th>Date Enregistrement</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Affichage des données récupérées de la base de données
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["matricule"] . "</td>
                            <td>" . $row["nom_dela_voiture"] . "</td>
                            <td>" . $row["marque"] . "</td>
                            <td>" . $row["annee"] . "</td>
                            <td>" . $row["expiration_assurances"] . "</td>
                            <td>" . $row["date_enregistrement"] . "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Aucun véhicule trouvé.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <?php
    // Fermer la connexion à la base de données
    $conn->close();
    ?>

</body>
</html>
