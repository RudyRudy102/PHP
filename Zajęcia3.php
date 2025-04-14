ssh s24@193.0.78.160
s24.ABCD
cd public_html
mkdir Papryk
cd Papryk
nano index.php

cd public_html/Papryk


$t = date("H");
if ($t < "10") {
  echo "Have a good morning!";
} elseif ($t < "20") {
  echo "Have a good day!";
} else {
  echo "Have a good night!";
}


$favcolor = "red";

switch ($favcolor) {
  case "red":
    echo "Your favorite color is red!";
    break;
  case "blue":
    echo "Your favorite color is blue!";
    break;
  case "green":
    echo "Your favorite color is green!";
    break;
  default:
    echo "Your favorite color is neither red, blue, nor green!";
}
                                                                     
$i = 1;
while ($i < 6) {
  echo $i;
  $i++;
}

for ($x = 0; $x <= 10; $x++) {
  echo "The number is: $x <br>";
}

<!--Kalkulator -->

<!DOCTYPE html>
<html>
<head>
    <title>Kalkulator z wyborem działania</title>
</head>
<body>
    <h2>To jest kalkulator1</h2>
    <br><br>
    <form action="wynik3.php" method="post">
        Podaj pierwszą liczbę: <br>
        <input type="text" name="pierwszaliczba"/> <br>
        Podaj drugą liczbę: <br>
        <input type="text" name="drugaliczba"/> <br>
        <br>
        Wybierz działanie: <br>
        <input type="radio" name="operacja" value="dodawanie" checked> Dodawanie<br>
        <input type="radio" name="operacja" value="odejmowanie"> Odejmowanie<br>
        <input type="radio" name="operacja" value="mnozenie"> Mnożenie<br>
        <input type="radio" name="operacja" value="dzielenie"> Dzielenie<br>
        <br>
        <input type="submit" value="Potwierdź"/>
    </form>
    <br>
    <a href="index.php">Powrót na start</a>
</body>
</html>


<!-- Wynik kalkulatora 1 -->
<!DOCTYPE html>
<html>
<head>
    <title>Wynik - Kalkulator 1</title>
</head>
<body>
    <h2>To jest wynik z kalkulator1</h2>
    <br>
    <?php
    $z1 = $_POST["pierwszaliczba"];
    $z2 = $_POST["drugaliczba"];
    echo "Pierwsza liczba to: " . $z1 . "<br>";
    echo "Druga liczba to: " . $z2 . "<br>";
    echo "Suma liczb to: " . ($z1 + $z2) . "<br>";
    echo "Iloczyn liczb to: " . ($z1 * $z2) . "<br>";
    ?>
    <br>
    <a href="index.php">Powrót na start</a>
</body>
</html>


<!--Dane osobowe-->

<!DOCTYPE html>
<html>
<head>
    <title>Formularz do wprowadzania danych</title>
</head>
<body>
    <h2>Formularz do wprowadzania danych</h2>
    <br><br>
    <form action="wynik4.php" method="post">
        Imię: <br> <input type="text" name="imie"/> <br>
        Nazwisko: <br> <input type="text" name="nazwisko"/> <br>
        Wiek: <br>
        <input type="text" name="wiek"/> <br>
        <br>
        Liczba 1: <br> <input type="text" name="liczba1"/> <br>
        Liczba 2:<br> <input type="text" name="liczba2"/> <br>
        Liczba 3: <br> <input type="text" name="liczba3"/> <br>
        <br>
        Płeć: <br>
        <input type="radio" name="gender" value="Kobieta" checked> Kobieta<br>
        <input type="radio" name="gender" value="Męzczyzna"> Męzczyzna<br>
        <input type="radio" name="gender" value="Inna"> Inna<br>
        <br>
        <input type="submit" value="Wyślij zapytanie"/>
    </form>
    <br>
    <a href="index.php">Powrót na start</a>
</body>
</html>



