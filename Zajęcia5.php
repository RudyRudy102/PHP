<!--Wynik-->
<html>
<head>
    <meta charset="utf-8">
    <title>Wynik dodania studenta</title>
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
        .result {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .success {
            color: green;
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
$Sn = $_POST["Snazwisko"];
$Si = $_POST["Simie"];
$Sindeks = $_POST["Sindeks"];
$SdataUR = $_POST["SdataUR"];

$mysqli = mysqli_connect("localhost", "s24", "s24.ABCD", "s24Patryk");
$sql = "INSERT INTO studenci VALUES ('0', '$Sn', '$Si', '$Sindeks', '$SdataUR')";
$rez = mysqli_query($mysqli,$sql);
mysqli_close($mysqli);
echo "<br>";
echo $Sn;
echo "<br>";
echo $Si;
echo "<br>";
echo $Sindeks;
echo "<br>";
echo $SdataUR;
echo "<br>";
?>
<br>
<a href="index.php">do menu</a>
</body>
</html>

<!--Formularz nowego studenta-->
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <title>Formularz do wprowadzania danych</title>
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
        form {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        input[type="text"], input[type="date"] {
            width: 100%;
            padding: 8px;
            margin: 5px 0 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #3498db;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #2980b9;
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
<h2>Formularz do wpisywania danych osobowych studenta</h2>
<form action="Studentwynik.php" method="post">
        <label for="Snazwisko">Podaj nazwisko studenta:</label>
        <input type="text" id="Snazwisko" name="Snazwisko" />
        
        <label for="Simie">Podaj imię studenta:</label>
        <input type="text" id="Simie" name="Simie" />
        
        <label for="Sindeks">Podaj indeks studenta:</label>
        <input type="text" id="Sindeks" name="Sindeks" maxlength="5" pattern="[0-9]{5}" title="Indeks powinien składać się z 5 cyfr" />
        
        <label for="SdataUR">Podaj datę urodzenia studenta:</label>
        <input type="date" id="SdataUR" name="SdataUR" />
        
        <input type="submit" value="Potwierdź" />
</form>
<br>
<a href="index.php">Przeniesienie do głównego menu</a>
</body>
</html>



Ćwiczenie - wprowadzanie nowych rekordów1
1. Baza st2023_xxx.

2. Tabela dla wykładowców.

3. Tworzymy formularz do wprowadzania danych wykładowców. (pola sprawdzamy w monitorze SQL). Wypełniamy wszystkie pola. Nazwa pliku. WykForm1.php

4. Dane przesyłamy POST do pliku WykWprowadz.php, który wprowadzi je do tabeli wykładowcy.

5. W monitorze SQL sprawdzamy czy dane pojawiły się w tabeli.

6. Modyfikujemy plik WykWprowadz.php tak aby na ekranie w przeglądarce pojawił się tekst np:

Wykładowca prof. Jan Marcinkowski został dodany do tabeli. Urzęduje w pok.124.

<!--Formularz wykładowcy-->
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <title>Ni to librus ni to USOS</title>
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
        form {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        input[type="text"], input[type="date"], select {
            width: 100%;
            padding: 8px;
            margin: 5px 0 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #3498db;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #2980b9;
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
<h2>Ni to librus ni to USOS</h2>
<form action="WykWprowadz.php" method="post">
        <label for="@nazwisko">Podaj nazwisko wykładowcy:</label>
        <input type="text" id="Wnazwisko" name="Wnazwisko" />

        <label for="Simie">Podaj imię wykładowcy:</label>
        <input type="text" id="Wimie" name="Wimie" />
        
        <label for="Wtytul">Podaj tytuł naukowy:</label>
        <select id="Wtytul" name="Wtytul">
            <option value="">Wybierz tytuł</option>
            <option value="mgr">mgr</option>
            <option value="mgr inż.">mgr inż.</option>
            <option value="dr">dr</option>
            <option value="dr inż.">dr inż.</option>
            <option value="dr hab.">dr hab.</option>
            <option value="dr hab. inż.">dr hab. inż.</option>
            <option value="prof.">prof.</option>
            <option value="prof. dr hab.">prof. dr hab.</option>
            <option value="prof. dr hab. inż.">prof. dr hab. inż.</option>
        </select>
        
        <label for="SdataUR">Podaj pokój:</label>
        <input type="text" id="Wpokoj" name="Wpokoj" />
        
        <input type="submit" value="Potwierdź" />
</form>
<br>
<a href="index.php">Przeniesienie do głównego menu</a>
</body>
</html>

<!--Wynik wykładowcy-->
<html>
<head>
    <meta charset="utf-8">
    <title>Wynik dodania wykładowcy</title>
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
        .result {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .success {
            color: green;
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
<div class="result">
<?php
$Wn = $_POST["Wnazwisko"];
$Wi = $_POST["Wimie"];
$Wtytul = $_POST["Wtytul"];
$Wpokoj = $_POST["Wpokoj"];

$mysqli = mysqli_connect("localhost", "s24", "s24.ABCD", "s24Patryk");
$sql = "INSERT INTO wykladowcy VALUES ('0', '$Wn', '$Wi', '$Wtytul', '$Wpokoj')";
$rez = mysqli_query($mysqli,$sql);
mysqli_close($mysqli);

// Wyświetlanie komunikatu potwierdzającego
echo "<p class='success'>Wykładowca $Wtytul $Wi $Wn został dodany do tabeli. Urzęduje w pok.$Wpokoj.</p>";
?>
</div>
<br>
<a href="index.php">Powrót do menu</a>
</body>
</html>



<!--Fetch rekord-->
<html lang="pl">
<head>
 <meta charset="utf-8">
</head>
<body>

<?php
$mysqli = mysqli_connect("localhost", "s24", "s24.ABCD", "s24Patryk");
$sql = "select * from auta";
$rez = mysqli_query($mysqli,$sql);
while($row = mysqli_fetch_row($rez))
{
echo "Samochodzik ... ";
echo $row[1];
echo " ";
echo $row[5];
echo " ";
echo $row[7];
echo " ";
}
mysqli_free_result($rez);
mysqli_close($mysqli);
?>

<br>
<a href="index.php">Przeniesienie do głównego</a>
</body>
</html>




Tabela auta
Wyświetl na WWW zawartość wszystkich rekordów z tabeli auta w układzie:
Kolumna 1: Marka
Kolumna 2: Spalanie
Kolumna 3: kolor auta  

<!--Zadanie-->
<!DOCTYPE HTML>
<html lang="pl">
<head>
        <meta charset="utf-8" />
        <title>Lista aut PHP</title>
        <style>
                    body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
            
            table {
                width: 80%;
                border-collapse: collapse;
                margin: 20px 0;
            }
            th, td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: left;
            }
            th {
                background-color: #3498db;
                color: white;
            }
            tr:nth-child(even) {
                background-color: #f2f2f2;
            }
            h1 {
                color: #2c3e50;
            }
        </style>
</head>
<body>
        <h1>Lista aut</h1>

        <table>
            <tr>
                <th>Marka</th>
                <th>Spalanie</th>
                <th>Kolor auta</th>
            </tr>
<?php
$mysqli = mysqli_connect("localhost", "s24", "s24.ABCD", "s24Patryk");
$sql = "select * from auta";
$rez = mysqli_query($mysqli,$sql);
while($row = mysqli_fetch_row($rez))
{
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



Tabela auta
Wyświetl na ekranie zdania o wszystkich autach wg wzoru:
Polonez kosztuje 2300zł czyli 1200EUR.

<!--Tabela auta - wyświetlanie zdań-->
<!DOCTYPE HTML>
<html lang="pl">
<head>
    <meta charset="utf-8" />
    <title>Informacje o autach</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        
        h1 {
            color: #2c3e50;
        }
        
        .auto-info {
            background-color: white;
            padding: 8px;
            border: 1px solid #ddd;
            margin: 5px 0;
        }
        
        .auto-info:nth-child(even) {
            background-color: #f2f2f2;
        }
        
        .container {
            width: 80%;
            margin: 20px 0;
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
    <h1>Informacje o autach</h1>

    <div class="container">
    <?php
    $mysqli = mysqli_connect("localhost", "s24", "s24.ABCD", "s24Patryk");
    $sql = "select * from auta";
    $rez = mysqli_query($mysqli, $sql);

    // Kurs Euro
    $kursEuro = 4.29;

    while($row = mysqli_fetch_row($rez)) {
        $marka = $row[1]; 
        $cenaZl = $row[3]; 
        $cenaEur = round($cenaZl / $kursEuro, 2); 
        
        echo "<div class='auto-info'>$marka kosztuje {$cenaZl}zł czyli {$cenaEur}EUR.</div>";
    }

    mysqli_free_result($rez);
    mysqli_close($mysqli);
    ?>
    </div>

    <br>
    <a href="index.php">Powrót do menu głównego</a>
</body>
</html>