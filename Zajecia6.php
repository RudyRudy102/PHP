<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Lista aut</title>
</head>
<body>
        <h1>Lista aut</h1>

        <table border="1" cellpadding="5" cellspacing="0">
            <tr>
                <th>Marka</th>
                <th>Spalanie</th>
                <th>Kolor auta</th>
            </tr>
<?php
$mysqli = mysqli_connect("localhost", "s24", "s24.ABCD", "s24Patryk");
$sql = "SELECT * FROM auta";
$rez = mysqli_query($mysqli, $sql);

while ($row = mysqli_fetch_row($rez)) {
    echo "<tr>";
    echo "<td>" . $row[1] . "</td>"; // Marka
    echo "<td>" . $row[5] . "</td>"; // Spalanie
    echo "<td>" . $row[7] . "</td>"; // Kolor
    echo "</tr>";
}
mysqli_free_result($rez);
mysqli_close($mysqli);
?>
        </table>
<br>
<a href="index.php">Powrót do menu głównego</a>
</body>
</html>
