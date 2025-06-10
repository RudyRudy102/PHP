<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Potwierdzenie aktualizacji</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        h2 {
            color: #2c3e50;
            text-align: center;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
        }
        .success-container {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .success {
            color: #155724;
            font-weight: bold;
        }
        .confirmation-details {
            background-color: white;
            padding: 15px;
            border-radius: 4px;
            margin-top: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            margin: 20px 0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
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
            padding: 8px 16px;
            background-color: white;
            border-radius: 4px;
            border: 1px solid #3498db;
        }
        a:hover {
            background-color: #3498db;
            color: white;
            text-decoration: none;
        }
        .table-summary {
            background-color: white;
            padding: 10px;
            border-radius: 4px;
            margin-top: 10px;
            font-weight: bold;
        }
    </style>
</head>
<body>


<?php
$mysqli = mysqli_connect("localhost", "s24", "s24.ABCD", "s24Patryk");

// Krok 5 i 6: Aktualizacja rekordu i potwierdzenie
if (isset($_POST['update_record'])) {
    $table_name = mysqli_real_escape_string($mysqli, $_POST['table_name']);
    $record_id = (int)$_POST['record_id'];
    
    // Pobierz pierwotny rekord dla porównania
    $sql = "SELECT * FROM $table_name LIMIT " . ($record_id - 1) . ", 1";
    $result = mysqli_query($mysqli, $sql);
    $original_record = mysqli_fetch_assoc($result);
    $primary_key = array_keys($original_record)[0];
    $primary_value = $original_record[$primary_key];
    
    // Przygotuj zapytanie UPDATE
    $update_parts = array();
    foreach ($original_record as $field => $original_value) {
        if (isset($_POST[$field]) && $field != $primary_key) {
            $new_value = mysqli_real_escape_string($mysqli, $_POST[$field]);
            $update_parts[] = "$field = '$new_value'";
        }
    }
    
    if (!empty($update_parts)) {
        $update_sql = "UPDATE $table_name SET " . implode(", ", $update_parts) . " WHERE $primary_key = '$primary_value'";
        $update_result = mysqli_query($mysqli, $update_sql);
        
        if ($update_result) {
            // Krok 6: Ekran potwierdzający aktualizację
            echo "<h2 class='success'>✓ Operacja zakończona pomyślnie!</h2>";
            echo "<div class='success-container'>";
            echo "<h3>Potwierdzenie aktualizacji rekordu</h3>";
            echo "<div class='confirmation-details'>";
            echo "<p><strong>Tabela:</strong> $table_name</p>";
            echo "<p><strong>Numer rekordu:</strong> #$record_id</p>";
            echo "<p><strong>Status:</strong> Rekord został pomyślnie zaktualizowany w bazie danych</p>";
            echo "<p><strong>Liczba zmienionych pól:</strong> " . count($update_parts) . "</p>";
            echo "</div>";
            echo "</div>";
            
            // Krok 7: Wyświetlanie całej zawartości tabeli
            echo "<h2>Cała zawartość tabeli: $table_name</h2>";
            echo "<p>Poniżej przedstawiona jest aktualna zawartość tabeli po wprowadzonych zmianach:</p>";
            
            $sql = "SELECT * FROM $table_name";
            $result = mysqli_query($mysqli, $sql);
            
            if ($result && mysqli_num_rows($result) > 0) {
                echo "<table>";
                
                // Nagłówki kolumn
                $fields = mysqli_fetch_fields($result);
                echo "<tr style='background-color: #f8f9fa;'>";
                echo "<th>Nr</th>";
                foreach ($fields as $field) {
                    echo "<th>" . $field->name . "</th>";
                }
                echo "</tr>";
                
                // Dane wierszy
                $row_number = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>$row_number</td>";
                    foreach ($row as $value) {
                        echo "<td>" . htmlspecialchars($value) . "</td>";
                    }
                    echo "</tr>";
                    $row_number++;
                }
                echo "</table>";
                
                echo "<div class='table-summary'>Całkowita liczba rekordów: " . ($row_number - 1) . "</div>";
            }
            
            echo "<a href='formularz.php'>Rozpocznij od początku</a>";
            echo "<a href='index.php' style='margin-left: 10px; background-color: #e74c3c; color: white;'>Powrót do menu głównego</a>";
            
        } else {
            echo "<div class='error'>Błąd podczas aktualizacji: " . mysqli_error($mysqli) . "</div>";
            echo "<a href='formularz.php'>Powrót do wyboru tabeli</a>";
            echo "<a href='index.php' style='margin-left: 10px; background-color: #e74c3c; color: white;'>Powrót do menu głównego</a>";
        }
    }
} else {
    echo "<div class='error'>Błędne parametry.</div>";
    echo "<a href='formularz.php'>Powrót do wyboru tabeli</a>";
    echo "<a href='index.php' style='margin-left: 10px; background-color: #e74c3c; color: white;'>Powrót do menu głównego</a>";
}

mysqli_close($mysqli);
?>
</body>
</html>
