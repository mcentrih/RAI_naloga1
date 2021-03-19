<?php
include_once('header.php');
//metoda, ki zbrise oglas na podlagi id
if (isset($_GET["id"])) {
    global $conn;
    $i = $_GET["id"];
    echo $i;
    $query = "DELETE FROM oglas WHERE id = $i";
    $res = $conn->query($query);
    if ($conn->query($query) === TRUE) {
    } else {
        echo "Napak pri večanju števila ogledov!";
        return false;
    }
}
header("Location: index.php");
include_once('footer.php');
?>