<?php
include('config.php');

$dsn = "mysql:host=$dbHost;dbname=$dbName;charset=UTF8";
$pdo = new PDO($dsn, $dbUser, $dbPass);

// Controleer of er POST-gegevens zijn verzonden
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Controleer of alle vereiste velden zijn ingestuurd
    $requiredFields = ['fullname', 'email', 'q1', 'q2', 'q3', 'q4', 'q5', 'q6', 'q7', 'q8', 'q9', 'q10'];
    $missingFields = array_diff($requiredFields, array_keys($_POST));
    
    if (!empty($missingFields)) {
        $missingFieldsList = implode(', ', $missingFields);
        exit; // Stop the script execution
    }

    // Voorbereiden van de SQL-query
    $sql = "INSERT INTO adhd_responses (fullname, email, q1, q2, q3, q4, q5, q6, q7, q8, q9, q10)
            VALUES (:fullname, :email, :q1, :q2, :q3, :q4, :q5, :q6, :q7, :q8, :q9, :q10)
            ON DUPLICATE KEY UPDATE q1 = VALUES(q1), q2 = VALUES(q2), q3 = VALUES(q3), q4 = VALUES(q4),
            q5 = VALUES(q5), q6 = VALUES(q6), q7 = VALUES(q7), q8 = VALUES(q8), q9 = VALUES(q9), q10 = VALUES(q10),
            Mogelijk_adhd = VALUES(Mogelijk_adhd)";
    
    $statement = $pdo->prepare($sql);
    
    // Binden van waarden aan parameters
    $statement->bindValue(':fullname', $_POST['fullname'] ?? null, PDO::PARAM_STR); 
    $statement->bindValue(':email', $_POST['email'] ?? null, PDO::PARAM_STR); 
    
    // Bind and handle checkbox values
    for ($i = 1; $i <= 10; $i++) {
        $question = 'q' . $i;
        $value = isset($_POST[$question]) ? ($_POST[$question] === 'true' ? 1 : 0) : null;
        $statement->bindValue(':' . $question, $value, PDO::PARAM_INT);
    }
    
    // Uitvoeren van de query
    if ($statement->execute()) {
        // Haal de ingevoerde naam op
        $fullname = $_POST['fullname'];
        
        // Bereken het aantal aangevinkte checkboxen
        $num_checked = 0;
        for ($i = 1; $i <= 10; $i++) {
            if (isset($_POST['q' . $i]) && $_POST['q' . $i] == 'true') {
                $num_checked++;
            }
        }
        // Bepaal de boodschap op basis van het aantal aangevinkte checkboxen
        $message = '';
        if ($num_checked > 5) {
            $message = "<p>$fullname, mogelijk heb je ADHD. Neem contact op met een huisarts.</p>";
            $possible_adhd = $num_checked > 5 ? 1 : 0; // Indien mogelijk ADHD, zet de waarde op 1
        } else {
            $message = "<p>$fullname, waarschijnlijk heb je geen ADHD, maar raadpleeg een professional voor zekerheid.</p>";
            $possible_adhd = $num_checked > 5 ? 1 : 0; // Indien geen ADHD, zet de waarde op 0
        }
        
        // Update de database met de mogelijke ADHD-waarde
        $update_sql = "UPDATE adhd_responses SET Mogelijk_adhd = :possible_adhd WHERE fullname = :fullname AND email = :email";
        $update_statement = $pdo->prepare($update_sql);
        $update_statement->bindValue(':possible_adhd', $possible_adhd, PDO::PARAM_INT);
        $update_statement->bindValue(':fullname', $_POST['fullname'] ?? null, PDO::PARAM_STR);
        $update_statement->bindValue(':email', $_POST['email'] ?? null, PDO::PARAM_STR);
        $update_statement->execute();
        
        // Redirect naar index.html na 3.5 seconden
        //header('Refresh: 3.5; url=../html/index.html');
        ?>
        
        <?php
    } else {
        echo "Er is een fout opgetreden bij het opslaan van de gegevens";
    }
} else {
    echo "Geen POST-verzoek ontvangen";
    header('Refresh: 3.5; url=../html/quiz.html');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>resultaat quiz</title>
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/create.css">
    <link rel="icon" href="../img/icon.png">
</head>
<body>
    <nav>
        <ul>
            <li class="col-2 button"><a href="../html/index.html">Home <span></span></a></li>
            <li class="col-2 button"><a href="../html/information.html">Informatie <span></span></a></li>
            <li class="col-2 button"><a href="../html/tips.html">Tips <span></span></a></li>
            <li class="col-2 button"><a href="../html/faq.html">FAQ <span></span></a></li>
            <li class="col-2 button"><a href="../html/aboutus.html">About Us <span></span></a></li>
            <li class="col-2 button"><a href="../html/contact.html">Contact <span></span></a></li>
            <li class="col-2"><img src="../img/icon.png" alt="icon"></li>
        </ul>
    </nav>
    <div class="container">
        <p><?php echo $message; ?></p>
        <a href="../html/quiz.html">keer terug naar Quiz</a>
    </div>
</body>
</html>
