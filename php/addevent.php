<?php
include('config.php');

$dsn = "mysql:host=$dbHost;dbname=$dbName;charset=UTF8";
try {
    $pdo = new PDO($dsn, $dbUser, $dbPass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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

    // Controleren of er al een evenement met dezelfde naam bestaat
    $checkSql = "SELECT COUNT(*) AS count FROM events WHERE event_name = :event_name";
    $checkStatement = $pdo->prepare($checkSql);
    $checkStatement->bindParam(':event_name', $_POST['event_name'], PDO::PARAM_STR);
    $checkStatement->execute();
    $result = $checkStatement->fetch(PDO::FETCH_ASSOC);

    if ($result['count'] > 0) {
        echo "<script>
                    setTimeout(function() {
                        window.location.href = '../php/addeventPage.php';
                        alert('Er bestaat al een evenement met dezelfde naam.');
                    }, 100);
                  </script>";
    } else {
        // Voorbereiden van de SQL-query om het evenement toe te voegen
        $sql = "INSERT INTO events (event_name, event_desc, event_location, event_date)
                VALUES (:event_name, :event_desc, :event_location, :event_date)";

        $statement = $pdo->prepare($sql);

        // Binden van waarden aan de voorbereide verklaring
        $statement->bindParam(':event_name', $_POST['event_name'], PDO::PARAM_STR);
        $statement->bindParam(':event_desc', $_POST['event_desc'], PDO::PARAM_STR);
        $statement->bindParam(':event_location', $_POST['event_location'], PDO::PARAM_STR);
        $statement->bindParam(':event_date', $_POST['event_date'], PDO::PARAM_STR);

        // Uitvoeren van de query om het evenement toe te voegen
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
}
?>
