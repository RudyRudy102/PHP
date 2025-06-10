<?php
$mysqli = mysqli_connect("localhost", "s24", "s24.ABCD", "s24Patryk");

// Krok 1: Formularz wyboru tabeli
if (!isset($_POST['table_name']) && !isset($_POST['record_id']) && !isset($_POST['update_record']) && !isset($_POST['show_table'])) {
    echo "<h2>Wybierz tabelę</h2>";
    echo "<form method='POST'>";
    echo "Nazwa tabeli: <input type='text' name='table_name' required>";
    echo "<input type='submit' value='Zatwierdź'>";
    echo "</form>";
}

// Krok 2: Wyświetlanie danych z tabeli
else if (isset($_POST['table_name']) && !isset($_POST['record_id']) && !isset($_POST['update_record']) && !isset($_POST['show_table'])) {
    $table_name = mysqli_real_escape_string($mysqli, $_POST['table_name']);
    
    echo "<h2>Dane z tabeli: $table_name</h2>";
    
    $sql = "SELECT * FROM $table_name";
    $result = mysqli_query($mysqli, $sql);
    
    if ($result && mysqli_num_rows($result) > 0) {
        echo "<table border='1'>";
        
        // Nagłówki kolumn
        $fields = mysqli_fetch_fields($result);
        echo "<tr>";
        foreach ($fields as $field) {
            echo "<th>" . $field->name . "</th>";
        }
        echo "</tr>";
        
        // Dane wierszy
        $row_number = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>$row_number</td>";
            foreach (array_slice($row, 1) as $value) {
                echo "<td>$value</td>";
            }
            echo "</tr>";
            $row_number++;
        }
        echo "</table>";
        
        // Krok 3: Formularz wyboru rekordu do edycji
        echo "<h3>Edytuj rekord</h3>";
        echo "<form method='POST'>";
        echo "<input type='hidden' name='table_name' value='$table_name'>";
        echo "Numer rekordu do edycji: <input type='number' name='record_id' min='1' required>";
        echo "<input type='submit' value='Edytuj'>";
        echo "</form>";
    } else {
        echo "Brak danych w tabeli lub tabela nie istnieje.";
    }
}

// Krok 4: Formularz edycji rekordu
else if (isset($_POST['record_id']) && !isset($_POST['update_record'])) {
    $table_name = mysqli_real_escape_string($mysqli, $_POST['table_name']);
    $record_id = (int)$_POST['record_id'];
    
    $sql = "SELECT * FROM $table_name LIMIT " . ($record_id - 1) . ", 1";
    $result = mysqli_query($mysqli, $sql);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $record = mysqli_fetch_assoc($result);
        $fields = array_keys($record);
        
        echo "<h2>Edycja rekordu #$record_id z tabeli: $table_name</h2>";
        echo "<form method='POST'>";
        echo "<input type='hidden' name='table_name' value='$table_name'>";
        echo "<input type='hidden' name='record_id' value='$record_id'>";
        echo "<input type='hidden' name='update_record' value='1'>";
        
        foreach ($fields as $field) {
            echo "$field: <input type='text' name='$field' value='" . htmlspecialchars($record[$field]) . "'><br>";
        }
        
        echo "<input type='submit' value='Zatwierdź zmiany'>";
        echo "</form>";
    } else {
        echo "Rekord o podanym numerze nie istnieje.";
    }
}

// Krok 5: Aktualizacja rekordu
else if (isset($_POST['update_record'])) {
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
            // Krok 6: Nowy ekran potwierdzający aktualizację
            echo "<h2>✓ Potwierdzenie aktualizacji</h2>";
            echo "<p><strong>Rekord został pomyślnie zaktualizowany!</strong></p>";
            echo "<p>Tabela: <strong>$table_name</strong></p>";
            echo "<p>Rekord #<strong>$record_id</strong> został zmieniony.</p>";
            echo "<p>Liczba zaktualizowanych rekordów: " . mysqli_affected_rows($mysqli) . "</p>";
            
            echo "<form method='POST'>";
            echo "<input type='hidden' name='table_name' value='$table_name'>";
            echo "<input type='hidden' name='show_table' value='1'>";
            echo "<input type='submit' value='Dalej - Pokaż całą tabelę'>";
            echo "</form>";
        } else {
            echo "Błąd podczas aktualizacji: " . mysqli_error($mysqli);
        }
    }
}

// Krok 7: Wyświetlenie całej zawartości tabeli po aktualizacji
else if (isset($_POST['show_table'])) {
    $table_name = mysqli_real_escape_string($mysqli, $_POST['table_name']);
    
    echo "<h2>Cała zawartość tabeli: $table_name</h2>";
    
    $sql = "SELECT * FROM $table_name";
    $result = mysqli_query($mysqli, $sql);
    
    if ($result && mysqli_num_rows($result) > 0) {
        echo "<table border='1'>";
        
        // Nagłówki kolumn
        $fields = mysqli_fetch_fields($result);
        echo "<tr>";
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
                echo "<td>$value</td>";
            }
            echo "</tr>";
            $row_number++;
        }
        echo "</table>";
        
        echo "<br><a href='" . $_SERVER['PHP_SELF'] . "'>Powrót do początku</a>";
    } else {
        echo "Brak danych w tabeli.";
    }
}

mysqli_close($mysqli);
?>