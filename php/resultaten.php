<?php
include("config.php");

session_start();
if (!isset($_SESSION['username'])) {
    header("location: login.html");
    exit;
}

$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

if ($conn->connect_error) {
    die("Kan geen verbinding maken met de database: " . $conn->connect_error);
}

$sql = "SELECT * FROM adhd_responses";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
</head>
<body>
    <h2>ADHD Resultaten</h2>
    <table>
        <tr>
            <th>Naam</th>
            <th>E-mail</th>
            <th>q1</th>
            <th>q2</th>
            <th>q3</th>
            <th>q4</th>
            <th>q5</th>
            <th>q6</th>
            <th>q7</th>
            <th>q8</th>
            <th>q9</th>
            <th>q10</th>
            <th>Mogelijk ADHD</th>
        </tr>
        <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    // Toon de gegevens in de tabel met "true" of "false"
                    echo "<tr><td>" . $row["fullname"] . "</td><td>" . $row["email"] . "</td>";
                    echo "<td>" . ($row["q1"] ? "true" : "false") . "</td>";
                    echo "<td>" . ($row["q2"] ? "true" : "false") . "</td>";
                    echo "<td>" . ($row["q3"] ? "true" : "false") . "</td>";
                    echo "<td>" . ($row["q4"] ? "true" : "false") . "</td>";
                    echo "<td>" . ($row["q5"] ? "true" : "false") . "</td>";
                    echo "<td>" . ($row["q6"] ? "true" : "false") . "</td>";
                    echo "<td>" . ($row["q7"] ? "true" : "false") . "</td>";
                    echo "<td>" . ($row["q8"] ? "true" : "false") . "</td>";
                    echo "<td>" . ($row["q9"] ? "true" : "false") . "</td>";
                    echo "<td>" . ($row["q10"] ? "true" : "false") . "</td>";
                    echo "<td>" . ($row["Mogelijk_adhd"] ? "Ja" : "Nee") . "</td></tr>";
                }
            } else {
                echo "<tr><td colspan='13'>Geen resultaten gevonden</td></tr>";
            }
            $conn->close();
            ?>
    </table>
</body>
</html>