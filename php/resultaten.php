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
    <title>Resultaten</title>
    <link rel="icon" href="../img/icon.png">
    <link rel="stylesheet" href="../css/font.css">
    <link rel="stylesheet" href="../css/global.css">
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
    <br>
    <form method="post" action="">
        <label for="column">Procent wel/niet van:</label>
        <select name="column" id="column">
            <option value="q1">q1</option>
            <option value="q2">q2</option>
            <option value="q3">q3</option>
            <option value="q4">q4</option>
            <option value="q5">q5</option>
            <option value="q6">q6</option>
            <option value="q7">q7</option>
            <option value="q8">q8</option>
            <option value="q9">q9</option>
            <option value="q10">q10</option>
            <option value="Mogelijk_adhd">Mogelijk_adhd</option>
        </select>
        <input type="submit" value="Bereken percentage">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $selectedColumn = $_POST['column'];
            $truePercentage = calculatePercentage($result, $selectedColumn, '1');
            $falsePercentage = calculatePercentage($result, $selectedColumn, '0');
            echo "<p> </p>";
            echo "<p> </p>";
            if($selectedColumn == "Mogelijk_adhd"){
                echo "<p>Percentage wel $selectedColumn:" . round($truePercentage) . "%</p>";
                echo "<p>Percentage niet $selectedColumn:" . round($falsePercentage) . "%</p>";
            } else {
                echo "<p>Percentage 'true' antwoorden voor $selectedColumn:" . round($truePercentage) . "%</p>";
                echo "<p>Percentage 'false' antwoorden voor $selectedColumn:" . round($falsePercentage) . "%</p>";
            }
        }

        // Functie om het percentage "true" of "false" antwoorden te berekenen
        function calculatePercentage($result, $columnName, $value) {
            $totalRows = $result->num_rows;
            $count = 0;
            $result->data_seek(0); // Terugkeren naar het begin van de resultaten
            while($row = $result->fetch_assoc()) {
                if ($row[$columnName] === $value) {
                    $count++;
                }
            }
            return ($count / $totalRows) * 100;
        }
    ?>
    </form>
    <br>
    <a href="../html/index.html">Return to Home Page</a>
</body>
</html>