<?php
include('config.php');

$dsn = "mysql:host=$dbHost;dbname=$dbName;charset=UTF8";
$pdo = new PDO($dsn, $dbUser, $dbPass);

$sql = "SELECT * FROM admin";
$statement = $pdo->query($sql);
$users = $statement->fetchAll(PDO::FETCH_ASSOC);

foreach ($users as $user) {
    // Controleer of het wachtwoord nog niet gehasht is
    if (strlen($user['password']) < 60) {
        // Hash het wachtwoord
        $hashedPassword = password_hash($user['password'], PASSWORD_DEFAULT);

        // Update het wachtwoord in de database
        $updateSql = "UPDATE admin SET password = :password WHERE id = :id";
        $updateStatement = $pdo->prepare($updateSql);
        $updateStatement->execute(['password' => $hashedPassword, 'id' => $user['id']]);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $page = $_POST['page'];

    $sql = "SELECT * FROM admin WHERE username=:username";
    $statement = $pdo->prepare($sql);
    $statement->execute(['username' => $username]);
    $admin = $statement->fetch();

    if ($admin) {
        // Controleer of het opgegeven wachtwoord overeenkomt met de opgeslagen hash
        if (password_verify($password, $admin['password'])) {
            // Start een sessie en sla de gebruikersnaam op
            session_start();
            $_SESSION['username'] = $username;
            // Doorsturen naar resultaten.php
            if ($page == "event") {
                header("Location: ../html/addevent.html");
            } else {
                header("Location: ../php/resultaten.php");
            }
            
            exit();
        } else {
            echo "Ongeldige gebruikersnaam of wachtwoord.";
            header('Refresh: 2; url=../html/login.html');
        }
    }
}
?>
