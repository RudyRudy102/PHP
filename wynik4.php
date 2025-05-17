<!DOCTYPE html>
<html>
<head>
    <title>Wynik - Dane osobowe</title>
</head>
<body>
    <?php
    $imie = $_POST['imie'];
    $nazwisko = $_POST['nazwisko'];
    $wiek = $_POST['wiek'];
    $liczba1 = $_POST['liczba1'];
    $liczba2 = $_POST['liczba2'];
    $liczba3 = $_POST['liczba3'];
    

    $imie_wspak = strrev($imie);
    

    $rok_urodzenia = date("Y") - $wiek;
    

    $suma = $liczba1 + $liczba2 + $liczba3;

    $najwieksza = max($liczba1, $liczba2, $liczba3);
    
    echo "<p>Witaj $imie $nazwisko,</p>";
    echo "<p>Twoje imię pisane wspak to: $imie_wspak</p>";
    echo "<p>Twoje imię ma " . strlen($imie) . " znaków i zaczyna się na literę " . $imie[0] . ".</p>";
    echo "<p>Masz: $wiek więc masz $wiek lat.</p>";
    echo "<p>Wprowadzone przez Ciebie liczby to: $liczba1, $liczba2, $liczba3.</p>";
    echo "<p>Suma tych liczb wynosi $suma.</p>";
    echo "<p>Największa liczba to: $najwieksza</p>";
    echo "<p>i graficznie wygląda ona tak:</p>";
    

    for ($i = 0; $i < $najwieksza; $i++) {
        echo "*";
    }
    
    // Tablica z URL-ami obrazków dla każdej cyfry
    $obrazki = array(
        '0' => 'https://via.placeholder.com/150x75/FF0000/FFFFFF?text=0',
        '1' => 'https://via.placeholder.com/150x75/00FF00/FFFFFF?text=1',
        '2' => 'https://via.placeholder.com/150x75/0000FF/FFFFFF?text=2',
        '3' => 'https://via.placeholder.com/150x75/FFFF00/FFFFFF?text=3',
        '4' => 'https://via.placeholder.com/150x75/FF00FF/FFFFFF?text=4',
        '5' => 'https://via.placeholder.com/150x75/00FFFF/FFFFFF?text=5',
        '6' => 'https://via.placeholder.com/150x75/FFA500/FFFFFF?text=6',
        '7' => 'https://via.placeholder.com/150x75/800080/FFFFFF?text=7',
        '8' => 'https://via.placeholder.com/150x75/008000/FFFFFF?text=8',
        '9' => 'https://via.placeholder.com/150x75/800000/FFFFFF?text=9'
    );
    
    echo "<p>Twój wiek w obrazkach:</p>";
    $cyfry = str_split($wiek);
    foreach ($cyfry as $cyfra) {
        echo "<img src='{$obrazki[$cyfra]}' alt='Cyfra $cyfra' style='margin: 5px; width: 75px; height: 37px;'>";
    }
    ?>
    <br><br>
    <a href="formularz1.php">Powrót do formularza</a>
    <a href="index.php">Powrót na start</a>
</body>
</html>


