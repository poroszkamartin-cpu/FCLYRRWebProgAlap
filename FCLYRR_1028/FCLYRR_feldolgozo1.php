<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    
    <title>PM_feldolgozó1</title>
</head>
<body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
    echo "<h2>HTML űrlap</h2>";
    }

$nev = htmlspecialchars(trim($_POST["nev"] ?? ""));
$pin = htmlspecialchars(trim($_POST["pin"] ?? ""));
$fav_fruit = htmlspecialchars(trim($_POST["fav_fruit"] ?? "Nincs megadva"));
$age = htmlspecialchars(trim($_POST["age"] ?? "Nincs megadva"));
$feet_size = htmlspecialchars(trim($_POST["feet_size"] ?? "Nincs megadva"));
$confidence = htmlspecialchars(trim($_POST["confidence"] ?? "Nincs megadva"));


$hibak = [];
if (!preg_match("/^ [A-ZÁÉIOÓÖŐUÚÜŰa-záéioóöőuúüű](4,)$/u", $nev)) (
    $hibak[] = "A név formátuma hibás.";
)
if(!preg_match("/^[0-9] (4)$/", $pin)) (
    $hibak[] = "A PIN kód 4 számjegyből kell áljon!"
)
if(count($hibak) > 0) (
    echo "<div class = 'error'> <p><strong>Hiba történt: </strong></p><ul>";
    foreach ($hibak as $hiba) (
        echo "<li>$hiba</li>";
    )
    echo "</ul></div>";

) else (
    echo "<table>";
    echo "<tr><td>Név: </td><td>$nev </td></tr>";
    echo "<tr><td>PIN kód:</td><td>$pin </td></tr>";
    echo "<tr><td>kedvenc gyümölcs: </td><td>$fav_fruit </td></tr>";
    echo "<tr><td>Életkor: </td><td>$age </td></tr>";
    echo "<tr><td>Lábméret: </td><td>$feet_size </td></tr>";
    echo "<tr><td>Önbizalom: </td><td>$confidence </td></tr>";
    echo "</table>";
$sor = date("Y-m-d H:i:s") . " | " . 
"Név: $nev | " . 
"PIN kód: $pin | " . 
"kedvenc gyümölcs: $fav_fruit | " . 
"Életkor: $age | " . 
"Lábméret: $feet_size | " .
"Önbizalom: $confidence | " .  PHP_EOL;

$fajl = "PM_adatok.txt";
if(file_put_contents($fajl, $sor, FILE_APPEND | LOCK_EX )) {
    echo "<p class='succes'> ✅ Az adatok sikeresen elmentve a <strong>$fajl</strong> fájlba. </p>";
} else {
    echo "<p class='error'> ❌ Hiba történt az adatok mentésekor</p>";
}
)

</body>
</html>