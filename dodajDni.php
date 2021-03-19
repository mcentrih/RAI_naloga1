<?php
include_once('header.php');
//metoda, ki doda dni na pogladi idja
if (isset($_GET["id"])) {
    global $conn;
    $i = $_GET["id"];
    echo $i;
    $query = "UPDATE oglas SET datum_zapadlosti = ADDDATE(datum_zapadlosti,30) WHERE id = $i";
    $res = $conn->query($query);
    if ($conn->query($query) === TRUE) {
    } else {
        echo "Napaka pri podaljševanju zapadlosti!";
        echo mysqli_error($conn);

        return false;
    }
}
header("Location: index.php");
include_once('footer.php');
?>