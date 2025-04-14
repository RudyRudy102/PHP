<?php
    $pierwsza = $_POST['pierwszaliczba'];
    $druga = $_POST['drugaliczba'];
    $operacja = $_POST['operacja'];
    $wynik = 0;

    switch($operacja) {
        case 'dodawanie':
            $wynik = $pierwsza + $druga;
            echo "<p>Wynik dodawania: $wynik</p>";
            break;
        case 'odejmowanie':
            $wynik = $pierwsza - $druga;
            echo "<p>Wynik odejmowania: $wynik</p>";
            break;
        case 'mnozenie':
            $wynik = $pierwsza * $druga;
            echo "<p>Wynik mnożenia: $wynik</p>";
            break;
        case 'dzielenie':
            if($druga != 0) {
                $wynik = $pierwsza / $druga;
                echo "<p>Wynik dzielenia: $wynik</p>";
            } else {
                echo "Nie można dzielić przez zero!";
            }
            break;
    }
    echo "<br><br><a href='Zajęcia3.php'>Powrót do kalkulatora</a>";
?>
