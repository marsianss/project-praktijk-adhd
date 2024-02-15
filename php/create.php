<?php
include('config.php');

$dsn = "mysql:host=$dbHost;dbname=$dbName;charset=UTF8";
$pdo = new PDO($dsn, $dbUser, $dbPass);

// Controleer of er POST-gegevens zijn verzonden
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Controleer of alle vereiste velden zijn ingestuurd
    if(isset($_POST['firstname'], $_POST['lastname'], $_POST['email'])) {
        // Voorbereiden van de SQL-query
        $sql = "INSERT INTO Gebruikers (Voornaam, Tussenvoegsel, Achternaam, `email`, frequentie)
                VALUES (:firstname, :infix, :lastname, :email, :frequentie)";
        
        $statement = $pdo->prepare($sql);
        
        // Binden van waarden aan parameters
        $statement->bindValue(':firstname', $_POST['firstname'], PDO::PARAM_STR);
        $statement->bindValue(':infix', $_POST['infix'] ?? null, PDO::PARAM_STR); 
        $statement->bindValue(':lastname', $_POST['lastname'], PDO::PARAM_STR);
        $statement->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
        $statement->bindValue(':frequentie', $_POST['frequentie'], PDO::PARAM_STR);
        
        // Uitvoeren van de query
        if ($statement->execute()) {
            echo "De gegevens zijn opgeslagen in de database";
        } else {
            echo "Er is een fout opgetreden bij het opslaan van de gegevens";
        }
    } else {
        echo "Niet alle vereiste velden zijn ingevuld";
    }
} else {
    echo "Geen POST-verzoek ontvangen";
}

// Wacht 3.5 seconden voordat de pagina wordt vernieuwd en redirect naar index.html in het html-mapje
header('Refresh: 3.5; url=../html/index.html');

/*http://www.clearminds.nl/html/registreren.html*/
?>