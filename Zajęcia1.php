ssh s24@193.0.78.160
s24.ABCD
cd public_html
mkdir Papryk
cd Papryk
nano index.php

cd public_html/Papryk
http://193.0.78.160/~s24/Papryk


<html lang="pl">
<head>
 <meta charset="utf-8">
</head>
<body>
PB Start
<br>
<a href="http://www.uw.edu.pl">UW</a>
</body>
</html>



<?php
echo "<h2> PHP is fun!</h2>";
echo "Hello world!<br>";
echo " I'm about to learn PHP!<br>";
echo "This ", "string ", "was ", "made ", "with multiple parameters.<br>";
?>

<?php
print "<h2 style='color: red;'> PHP is fun!</h2>";
print "Hello world!<br>";
print " I'm about to learn PHP!";
?>


echo "$y * $zmienna";

<?php

echo "$y * $zmienna" = " . ($y *$zmienna);
?>
