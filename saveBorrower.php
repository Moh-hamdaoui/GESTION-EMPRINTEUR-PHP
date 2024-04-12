<?php

$conn = include("connexionDB.php");

if (isset($_POST['submit'])) {
    

    $nom = $_POST["nom"];
    $email = $_POST["email"];
    $id_livre = $_POST["id_livre"];
    $date_emprunt = $_POST["date_emprunt"];
    $date_retour = $_POST["date_retour"];

   
    $query = "INSERT INTO emprunteurs (nom, email, id_livre, date_emprunt, date_retour	
    ) 
    VALUES 
    (?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ssiss", $nom, $email, $id_livre, $date_emprunt, $date_retour );

    if (mysqli_stmt_execute($stmt)) {
        echo "L'emprunteur est bien ajouté";
        $query1 = "UPDATE livres SET disponible = 0 WHERE id = $id_livre;";
            if (mysqli_query($conn, $query1)) {
                echo "<br>"."Mise a jour de tous les tables est faite!";
            } else {
                echo "Error : " . mysqli_error($conn);
            }
    } else {
        echo "Erreur d'ajout d'emprunteur  : " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($conn);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un emprunteur</title>
</head>
<body>
    <h2>Ajouter un emprunteur</h2>
    <form action="saveBorrower.php" method="POST">
        <label for="nom">Nom:</label><br>
        <input type="text" id="nom" name="nom" required><br><br>
        
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email"><br><br>
        
        <label for="id_livre">ID du livre emprunté:</label><br>
        <input type="number" id="id_livre" name="id_livre" required><br><br>
        
        <label for="date_emprunt">Date d'emprunt:</label><br>
        <input type="date" id="date_emprunt" name="date_emprunt" required><br><br>
        
        <label for="date_retour">Date de retour:</label><br>
        <input type="date" id="date_retour" name="date_retour"><br><br>
        
        <input type="submit" name="submit" value="Ajouter">
    </form>
</body>
</html>
