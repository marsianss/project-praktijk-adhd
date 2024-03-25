<?php
include('config.php');

$dsn = "mysql:host=$dbHost;dbname=$dbName;charset=UTF8";
try {
    $pdo = new PDO($dsn, $dbUser, $dbPass);
} catch (PDOException $e) {
    echo "Kan geen verbinding maken met de database: " . $e->getMessage();
    exit;
}

// Query om alle evenementen op te halen
$sql = "SELECT * FROM events order by event_date asc";
$statement = $pdo->prepare($sql);
$statement->execute();
$events = $statement->fetchAll(PDO::FETCH_ASSOC);

// Functie om een evenement te verwijderen
function drop($eventName) {
    global $pdo; // Om de databaseverbinding binnen de functie te gebruiken

    // Voorbereiden van de SQL-query om het evenement te verwijderen
    $sql = "DELETE FROM events WHERE event_name = :eventName";

    $statement = $pdo->prepare($sql);

    // Binden van de parameter
    $statement->bindParam(':eventName', $eventName, PDO::PARAM_STR);

    // Uitvoeren van de query
    if ($statement->execute()) {
        header("Refresh: 0; url=addeventPage.php");
    }
    
}

// Verwerken van het POST-verzoek om een evenement te verwijderen
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Controleren of de POST-gegevens voor het te verwijderen evenement zijn verzonden
    if (isset($_POST['event_name'])) {
        $eventNameToDelete = $_POST['event_name'];

        if (drop($eventNameToDelete)) {
            echo "Event successfully deleted from the database.";
        } else {
            echo "Failed to delete event from the database.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add event</title>
    <link rel="icon" href="../img/icon.png">
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/information.css">
    <link rel="stylesheet" href="../css/addevent.css">
</head>
<body>
    <header>
        <div class="hero-img">
          <img src="../img/icon.png" alt="logo" class="logoHero">
          <div class="hero-text">
            <h1>ClearMinds Nederland</h1>
        </div>
        <nav>
          <ul>
              <li class="col-2 button"><a href="../html/index.html">Home<span></span></a></li>
              <li class="col-2 button"><a href="../html/information.html">Informatie<span></span></a></li>
              <li class="col-2 button"><a href="../html/tips.html">Tips<span></span></a></li>
              <li class="col-2 button"><a href="../html/faq.html">Faq<span></span></a></li>
              <li class="col-2 button"><a href="../html/aboutus.html">About us<span></span></a></li>
              <li class="col-2 button"><a href="../html/contact.html">Contact<span></span></a></li>
              <li class="col-2"><img src="../img/icon.png" alt="icon"></li>
          </ul>
      </nav>
    </header>

    <h2>Voeg je eigen evenement toe!</h2>

    <div class="container">
    <form action="../php/addevent.php" method="post">
        <label for="event_name">Evenement Naam:</label><br>
        <input type="text" id="event_name" name="event_name" required><br>

        <label for="event_desc">Evenement Beschrijving:</label><br>
        <input type="text" id="event_desc" name="event_desc" required><br>

        <label for="event_location">Evenement Locatie:</label><br>
        <input type="text" id="event_location" name="event_location" required><br>

        <label for="event_date">Event Date and Time:<br></label>
        <input type="datetime-local" id="event_date" name="event_date" required><br>
        

        <input type="submit" value="Add Event">
    </form>
    </div>

        <!-- Loop door de evenementen en toon ze op de pagina -->
        <?php foreach ($events as $event): ?>
            <section class="Whoaretext">
                <h2><?php echo $event['event_name']; ?></h2>
                <!-- Formulier om het evenement te verwijderen -->
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <input type="hidden" name="event_name" value="<?php echo $event['event_name']; ?>">
                    <input type="submit" value="X">
                </form>
            </section>
        <?php endforeach; ?>

</body>
</html>