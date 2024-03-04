<?php
include('config.php');

$dsn = "mysql:host=$dbHost;dbname=$dbName;charset=UTF8";
$pdo = new PDO($dsn, $dbUser, $dbPass);

// Controleer of er POST-gegevens zijn verzonden
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Controleer of alle vereiste velden zijn ingestuurd
    if(isset($_POST['fullname'], $_POST['email'])) {
        // Voorbereiden van de SQL-query
        $sql = "INSERT INTO adhd_responses (fullname, email, q1, q2, q3, q4, q5, q6, q7, q8, q9, q10)
                VALUES (:fullname, :email, :q1, :q2, :q3, :q4, :q5, :q6, :q7, :q8, :q9, :q10)";
        
        $statement = $pdo->prepare($sql);
        
        $q1 = $_POST['q1'] === 'true' ? 1 : 0;
        $q2 = $_POST['q2'] === 'true' ? 1 : 0;
        $q3 = $_POST['q3'] === 'true' ? 1 : 0;
        $q4 = $_POST['q4'] === 'true' ? 1 : 0;
        $q5 = $_POST['q5'] === 'true' ? 1 : 0;
        $q6 = $_POST['q6'] === 'true' ? 1 : 0;
        $q7 = $_POST['q7'] === 'true' ? 1 : 0;
        $q8 = $_POST['q8'] === 'true' ? 1 : 0;
        $q9 = $_POST['q9'] === 'true' ? 1 : 0;
        $q10 = $_POST['q10'] === 'true' ? 1 : 0;
        // Binden van waarden aan parameters
        $statement->bindValue(':fullname', $_POST['fullname'] ?? null, PDO::PARAM_STR); 
        $statement->bindValue(':email', $_POST['email'] ?? null, PDO::PARAM_STR); 
        $statement->bindValue(':q1', $q1, PDO::PARAM_INT);
        $statement->bindValue(':q2', $q2, PDO::PARAM_INT);
        $statement->bindValue(':q3', $q3, PDO::PARAM_INT);
        $statement->bindValue(':q4', $q4, PDO::PARAM_INT);
        $statement->bindValue(':q5', $q5, PDO::PARAM_INT);
        $statement->bindValue(':q6', $q6, PDO::PARAM_INT);
        $statement->bindValue(':q7', $q7, PDO::PARAM_INT);
        $statement->bindValue(':q8', $q8, PDO::PARAM_INT);
        $statement->bindValue(':q9', $q9, PDO::PARAM_INT);
        $statement->bindValue(':q10', $q10, PDO::PARAM_INT);
        
        // Uitvoeren van de query
        if ($statement->execute()) {
            // Haal de ingevoerde naam op
            $fullname = $_POST['fullname'];
            
            // Bereken het aantal aangevinkte checkboxen
            $num_checked = 0;
            for ($i = 1; $i <= 10; $i++) {
                if (isset($_POST['q' . $i]) && $_POST['q' . $i] == 'X') {
                    $num_checked++;
                }
            }
            
            // Bepaal de boodschap op basis van het aantal aangevinkte checkboxen
            $message = '';
            if ($num_checked > 5) {
                $message = "<p>$fullname, mogelijk heb je ADHD. Neem contact op met een huisarts.</p>";
                $possible_adhd = 1; // Indien mogelijk ADHD, zet de waarde op 1
            } else {
                $message = "<p>$fullname, waarschijnlijk heb je geen ADHD, maar raadpleeg een professional voor zekerheid.</p>";
                $possible_adhd = 0; // Indien geen ADHD, zet de waarde op 0
            }
            
            echo $message;
            
            // Update de database met de mogelijke ADHD-waarde
            $update_sql = "UPDATE adhd_responses SET mogelijk_adhd = :possible_adhd WHERE fullname = :fullname AND email = :email";
            $update_statement = $pdo->prepare($update_sql);
            $update_statement->bindValue(':possible_adhd', $possible_adhd, PDO::PARAM_INT);
            $update_statement->bindValue(':fullname', $_POST['fullname'] ?? null, PDO::PARAM_STR);
            $update_statement->bindValue(':email', $_POST['email'] ?? null, PDO::PARAM_STR);
            $update_statement->execute();
            
            // Redirect naar index.html na 3.5 seconden
            header('Refresh: 3.5; url=../html/index.html');
        } else {
            echo "Er is een fout opgetreden bij het opslaan van de gegevens";
        }
    } else {
        echo "Niet alle vereiste velden zijn ingevuld";
    }
} else {
    echo "Geen POST-verzoek ontvangen";
}
