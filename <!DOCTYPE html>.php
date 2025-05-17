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
    echo "<p>Masz: $wiek lat,  więc rok twojego urodzenia to $rok_urodzenia.</p>";
    echo "<p>Wprowadzone przez Ciebie liczby to: $liczba1, $liczba2, $liczba3.</p>";
    echo "<p>Suma tych liczb wynosi $suma.</p>";
    echo "<p>Największa liczba to: $najwieksza</p>";
    echo "<p>i graficznie wygląda ona tak:</p>";


    
    $obrazki = array(
        '0' => 'https://icon2.cleanpng.com/lnd/20240703/ofa/a7d2edz0e.webp',
        '1' => 'https://banner2.cleanpng.com/20240401/oh/transparent-brush-strokes-watercolor-painting-of-letter-one-in-abstract-styl660b20a2d1c1f1.59604242.we$',
        '2' => 'https://banner2.cleanpng.com/lnd/20240625/bfu/a61m07915.webp',
        '3' => 'https://banner2.cleanpng.com/lnd/20240507/tty/avq9ef1ss.webp',
        '4' => 'https://banner2.cleanpng.com/lnd/20240507/oos/avpddatz0.webp',
        '5' => 'https://banner2.cleanpng.com/20240401/bsi/transparent-3d-cartoon-number-number-5-bubble-pink-yellow-colorful-bubble-number-5-for-various-applic$',
        '6' => 'https://banner2.cleanpng.com/lnd/20240626/spg/a621auoem.webp',
        '7' => 'https://banner2.cleanpng.com/lnd/20240626/zlw/a625333u5.webp',
        '8' => 'https://icon2.cleanpng.com/20240406/vhw/transparent-number-8-liquid-art-swirling-design-bright-colors-swirling-liquid-shape-with-bright-colors-$',
        '9' => 'https://banner2.cleanpng.com/20240406/klw/transparent-orange-colorful-abstract-design-of-number-96610d3ef0a4826.93427828.webp'
    );
    
    $cyfry = str_split($najwieksza);
    foreach ($cyfry as $cyfra) {
        echo "<img src='{$obrazki[$cyfra]}' alt='Cyfra $cyfra' style='margin: 5px; width: 65px; height:150px; '>";
    }
    ?>
    <br><br>
    <br><br>
    <a href="formularz1.php">Powrót do formularza</a>
    <a href="index.php">Powrót na start</a>
    <iframe 
        width="560" 
        height="315" 
        src="https://www.youtube.com/embed/IxX_QHay02M?si=LxAKb7z-GIn33_0Y" 
        title="YouTube video player" 
        frameborder="0" 
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
        referrerpolicy="no-referrer" 
        allowfullscreen>
    </iframe>
</body>
</html>