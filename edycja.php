<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edycja rekordu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
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
        .form-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .field-group {
            margin-bottom: 15px;
        }
        label {
            display: inline-block;
            width: 120px;
            font-weight: bold;
            color: #2c3e50;
        }
        input[type="text"] {
            width: 300px;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #3498db;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }
        input[type="submit"]:hover {
            background-color: #2980b9;
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

// Krok 4: Formularz edycji rekordu
if (isset($_POST['record_id']) && !isset($_POST['update_record'])) {
    $table_name = mysqli_real_escape_string($mysqli, $_POST['table_name']);
    $record_id = (int)$_POST['record_id'];
    
    $sql = "SELECT * FROM $table_name LIMIT " . ($record_id - 1) . ", 1";
    $result = mysqli_query($mysqli, $sql);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $record = mysqli_fetch_assoc($result);
        $fields = array_keys($record);
        
        echo "<div class='form-container'>";
        echo "<h2>Edycja rekordu #$record_id z tabeli: $table_name</h2>";
        echo "<p style='text-align: center; color: #666; margin-bottom: 20px;'>Edytujesz rekord wybrany z tabeli przez kliknięcie</p>";
        echo "<form method='POST' action='potwierdzenie.php'>";
        echo "<input type='hidden' name='table_name' value='$table_name'>";
        echo "<input type='hidden' name='record_id' value='$record_id'>";
        echo "<input type='hidden' name='update_record' value='1'>";
        
        foreach ($fields as $field) {
            echo "<div class='field-group'>";
            echo "<label>$field:</label>";
            echo "<input type='text' name='$field' value='" . htmlspecialchars($record[$field]) . "'>";
            echo "</div>";
        }
        
        echo "<input type='submit' value='Zatwierdź zmiany'>";
        echo "</form>";
        echo "</div>";
        
        echo "<a href='formularz.php'>Powrót do wyboru tabeli</a>";
        echo "<a href='index.php' style='margin-left: 10px; background-color: #e74c3c; color: white; padding: 8px 16px; border-radius: 4px;'>← Powrót do menu głównego</a>";
    } else {
        echo "<div class='error'>Rekord o podanym numerze nie istnieje.</div>";
        echo "<a href='formularz.php'>Powrót do wyboru tabeli</a>";
        echo "<a href='index.php' style='margin-left: 10px; background-color: #e74c3c; color: white; padding: 8px 16px; border-radius: 4px;'>← Powrót do menu głównego</a>";
    }
} else {
    echo "<div class='error'>Błędne parametry.</div>";
    echo "<a href='formularz.php'>Powrót do wyboru tabeli</a>";
    echo "<a href='index.php' style='margin-left: 10px; background-color: #e74c3c; color: white; padding: 8px 16px; border-radius: 4px;'>← Powrót do menu głównego</a>";
}

mysqli_close($mysqli);
?>
</body>
</html>
