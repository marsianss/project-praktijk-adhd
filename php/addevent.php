<?php
include('config.php');

$dsn = "mysql:host=$dbHost;dbname=$dbName;charset=UTF8";
try {
    $pdo = new PDO($dsn, $dbUser, $dbPass);
} catch (PDOException $e) {
    echo "Kan geen verbinding maken met de database: " . $e->getMessage();
    exit;
}

// Controleer of er POST-gegevens zijn verzonden
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Controleer of alle vereiste velden zijn ingestuurd
    $requiredFields = ['event_name', 'event_desc', 'event_location', 'event_date'];
    $missingFields = array_diff($requiredFields, array_keys($_POST));
    
    if (!empty($missingFields)) {
        $missingFieldsList = implode(', ', $missingFields);
        echo "Ontbrekende velden: " . $missingFieldsList;
        exit; // Stop de uitvoering van het script
    }

    // Voorbereiden van de SQL-query
    $sql = "INSERT INTO events (event_name, event_desc, event_location, event_date)
            VALUES (:event_name, :event_desc, :event_location, :event_date)";

    $statement = $pdo->prepare($sql);

    // Binden van waarden aan de voorbereide verklaring
    $statement->bindParam(':event_name', $_POST['event_name'], PDO::PARAM_STR);
    $statement->bindParam(':event_desc', $_POST['event_desc'], PDO::PARAM_STR);
    $statement->bindParam(':event_location', $_POST['event_location'], PDO::PARAM_STR);
    $statement->bindParam(':event_date', $_POST['event_date'], PDO::PARAM_STR);

    // Uitvoeren van de query
    if ($statement->execute()) {
        echo "<script>
                setTimeout(function() {
                    window.location.href = '../php/addeventPage.php';
                    alert('Evenement succesvol toegevoegd aan de database.');
                }, 100);
              </script>";
    } else {
        echo "Er is een probleem opgetreden bij het toevoegen van het evenement aan de database.";
    }
    

}
