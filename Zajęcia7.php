
1. Formularz: uytkownik podaje nazwę tabeli, klika zatwierdź
2. Dane z danej tabeli wyświetlają sie na ekranie
3. Uzytkownik podaje numer rekordu i otwiera się pole do edycji rekordu
4. Uzytkownik edytuje rekord i klika zatwierdź
5. Rekord zostaje zaktualizowany w bazie danych po kliknięciu zatwierdź
6. Nowy ekran potwierdzający aktualizację rekordu
7. Po kliknięciu dalej wyświetla się cała zawartość tabeli

<?php
$mysqli = mysqli_connect("localhost", "s24", "s24.ABCD", "s24Patryk");
$sql = "select * from auta";
$rez = mysqli_query($mysqli,$sql);




<?php
$mysqli = mysqli_connect("localhost", "s24", "s24.ABCD", "s24Patryk");

if (!isset($_POST['table_name']) && !isset($_POST['record_id']) && !isset($_POST['update_record']) && !isset($_POST['show_table'])) {
    echo "<h2>Wybierz tabelę</h2>";
    echo "<form method='POST'>";
    echo "Nazwa tabeli: <input type='text' name='table_name' required>";
    echo "<input type='submit' value='Zatwierdź'>";
    echo "</form>";
}

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
        

}