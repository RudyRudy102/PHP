<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formularz wyboru tabeli</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        h2, h3 {
            color: #2c3e50;
            text-align: center;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
        }
        .form-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        select, input[type="number"], input[type="submit"] {
            padding: 8px;
            margin: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #3498db;
            color: white;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #2980b9;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            margin: 20px 0;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f8f9fa;
            font-weight: bold;
        }
        .error {
            color: red;
            font-weight: bold;
        }
        a {
            display: inline-block;
            margin-top: 10px;
            color: #3498db;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<?php
$mysqli = mysqli_connect("localhost", "s24", "s24.ABCD", "s24Patryk");

// Krok 1: Formularz wyboru tabeli
if (!isset($_POST['table_name'])) {
    echo "<div class='form-container'>";
    echo "<h2>Wybierz tabelę</h2>";
    echo "<p>Kliknij na nazwę tabeli, którą chcesz edytować:</p>";
    
    // Pobierz listę wszystkich tabel
    $tables_result = mysqli_query($mysqli, "SHOW TABLES");
    echo "<div style='display: grid; gap: 10px; margin: 20px 0;'>";
    while ($table = mysqli_fetch_array($tables_result)) {
        $table_name = $table[0];
        echo "<form method='POST' style='margin: 0;'>";
        echo "<input type='hidden' name='table_name' value='$table_name'>";
        echo "<input type='submit' value='$table_name' style='width: 100%; padding: 15px; font-size: 16px; background-color: white; color: #2c3e50; border: 2px solid #ddd; border-radius: 4px; cursor: pointer;'>";
        echo "</form>";
    }
    echo "</div>";
    echo "</div>";
}

// Krok 2: Wyświetlanie danych z tabeli
else if (isset($_POST['table_name'])) {
    $table_name = mysqli_real_escape_string($mysqli, $_POST['table_name']);
    
    echo "<h2>Dane z tabeli: $table_name</h2>";
    
    $sql = "SELECT * FROM $table_name";
    $result = mysqli_query($mysqli, $sql);
    
    if ($result && mysqli_num_rows($result) > 0) {
        echo "<table>";
        
        // Nagłówki kolumn
        $fields = mysqli_fetch_fields($result);
        echo "<tr>";
        echo "<th>Nr</th>";
        foreach ($fields as $field) {
            echo "<th>" . $field->name . "</th>";
        }
        echo "<th>Akcje</th>";
        echo "</tr>";
        
        // Dane wierszy
        $row_number = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>$row_number</td>";
            foreach ($row as $value) {
                echo "<td>" . htmlspecialchars($value) . "</td>";
            }
            echo "<td>";
            echo "<form method='POST' action='edycja.php' style='margin: 0; display: inline;'>";
            echo "<input type='hidden' name='table_name' value='$table_name'>";
            echo "<input type='hidden' name='record_id' value='$row_number'>";
            echo "<input type='submit' value='Edytuj' style='background-color: #f39c12; color: white; border: none; padding: 5px 10px; border-radius: 3px; cursor: pointer; font-size: 12px;'>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
            $row_number++;
        }
        echo "</table>";
        
        echo "<div class='form-container'>";
        echo "<h3>Instrukcja</h3>";
        echo "<p style='text-align: center; color: #2c3e50;'>Kliknij przycisk 'Edytuj' w wybranym wierszu, aby edytować rekord.</p>";
        echo "</div>";
    } else {
        echo "<div class='error'>Brak danych w tabeli lub tabela nie istnieje.</div>";
    }
}

mysqli_close($mysqli);
?>

<div style="margin-top: 20px; text-align: center;">
    <a href="index.php" style="background-color: #e74c3c; color: white; padding: 8px 16px; text-decoration: none; border-radius: 4px;">← Powrót do menu głównego</a>
</div>
mysqli_close($mysqli);body>
?></html>
<div style="margin-top: 20px; text-align: center;">    <a href="index.php" style="background-color: #e74c3c; color: white; padding: 8px 16px; text-decoration: none; border-radius: 4px;">← Powrót do menu głównego</a></div></body></html>
