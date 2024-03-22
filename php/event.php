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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evenementen & Ondersteuningsgroepen</title>
    <link rel="stylesheet" href="../css/event.css">
    <link rel="stylesheet" href="../css/global.css">
    <link rel="icon" href="../img/icon.png">
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
              <li class="col-2 button"><a href="../html/information.html">Information<span></span></a></li>
              <li class="col-2 button"><a href="../html/tips.html">Tips<span></span></a></li>
              <li class="col-2 button"><a href="../html/faq.html">Faq<span></span></a></li>
              <li class="col-2 button"><a href="../html/aboutus.html">About us<span></span></a></li>
              <li class="col-2 button"><a href="../html/contact.html">Contact<span></span></a></li>
              <li class="col-2"><img src="../img/icon.png" alt="icon"></li>
          </ul>
      </nav>
    </header>
    <h1>Evenementen & Bijeenkomsten</h1>
        
    <?php foreach ($events as $event): ?>
    <section class="Whoaretext">
        <h2><?php echo $event['event_name']; ?></h2>
        <p>
            <?php echo $event['event_desc']; ?><br>
            Datum en tijd: <?php echo $event['event_date']; ?><br>
            Meer informatie: <a href="">Meer informatie</a>
        </p>
        <div id="contact-container">
            <iframe src="<?php echo $event['event_location']; ?>"
                    width="700px"
                    height="100%"
                    style="border: 0;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>
<?php endforeach; ?>
</main> 

</body>
</html>