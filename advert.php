<?php
include_once('header.php');

//Funkcija izbere oglas s podanim ID-jem. Doda tudi uporabnika, ki je objavil oglas.
function get_ad($id)
{
    global $conn;
    $id = mysqli_real_escape_string($conn, $id);
    $query = "SELECT oglas.*, user.username, user.email FROM oglas LEFT JOIN user ON user.id = oglas.FK_objavil WHERE oglas.id = $id";
    $res = $conn->query($query);
    $sql = "UPDATE oglas SET stevilo_ogledov= stevilo_ogledov + 1  WHERE id= $id";
    if ($conn->query($sql) === TRUE) {
        if ($obj = $res->fetch_object()) {
            return $obj;
        } else
            echo "Napak pri branju oglasa";
    } else {
        echo "Napak pri večanju števila ogledov!";
        return false;
    }
}
//metoda, ki dobi ostale slike
function getSlike($id)
{
    global $conn;
    $id = mysqli_real_escape_string($conn, $id);
    $query = "SELECT * FROM slike WHERE FK_oglas = $id";
    $res = $conn->query($query);
    $slike = array();
    while ($slika = $res->fetch_object()) {
        array_push($slike, $slika);
    }
    return $slike;
}
//metoda, ki pridobi pod kategorije
function getKategorije($id)
{
    global $conn;
    $id = mysqli_real_escape_string($conn, $id);
    $query = "SELECT * FROM kategorije WHERE FK_oglas = $id";
    $res = $conn->query($query);
    $kategorije = array();
    while ($kat = $res->fetch_object()) {
        array_push($kategorije, $kat);
    }
    return $kategorije;
}

function getKoments($id){
    global $conn;
    $id = mysqli_real_escape_string($conn, $id);
    $query = "SELECT * FROM komentarji WHERE FK_oglas = $id";
    $res = $conn->query($query);
    $komentarji = array();
    while ($kom = $res->fetch_object()) {
        array_push($komentarji, $kom);
    }
    return $komentarji;
}

if (!isset($_GET["id"])) {
    echo "Manjkajoči parametri.";
    die();
}
$id = $_GET["id"];
$oglas = get_ad($id);
$slike = getSlike($id);
$kategorije = getKategorije($id);
$komentarji = getKoments($id);
if ($oglas == null) {
    echo "Oglas ne obstaja.";
    die();
}
//Base64 koda za sliko (hexadecimalni zapis byte-ov iz datoteke)
$img_data = base64_encode($oglas->slika);
?>
    <div style="border: 2px solid black; background-color: lightgray; width: 50%; margin: 0 auto; margin-top: 15px; padding-left: 15px; padding-bottom: 10px;">
        <h4><?php echo $oglas->naslov; ?></h4>
        <p><?php echo $oglas->opis; ?></p>
        <p><?php echo $oglas->kategorija; ?></p>
        <?php
        foreach ($kategorije as $cat) {
            echo "<p> $cat->naziv</p>";
        }
        ?>
        <p>Predstavitevena slika:</p>
        <img src="data:image/jpg;base64, <?php echo $img_data; ?>" width="100"/>
        <?php
        foreach ($slike as $s) {
            $img_data = base64_encode($s->slika);
            echo "<img src='data:image/jpg;base64,$img_data' width='100'/><br>";
            echo "<p> $cat->naziv</p>";
        }
        ?>
        <p>Objavil: <?php echo $oglas->username; ?></p>
        <p>Mail: <?php echo $oglas->email; ?></p>
        <p>Število ogledov: <?php echo $oglas->stevilo_ogledov; ?></p>
        <p>Komentarji:</p>
        <?php
        foreach ($komentarji as $kom) {
            echo "<p> $kom->komentar; $kom->vzdevek</p>";
        }
        ?>
        <a href='index.php'>
            <button>Nazaj</button>
        </a>
        <?php
        //izpis gumbov za manipulacijo z oglasom
        if (isset($_SESSION["USER_ID"])) {
            $i = $oglas->id;
            echo "<a style='padding-left: 20px;' href='editAd.php?id=$i'>";
            echo "<button>Uredi</button>";
            echo "</a>";
            echo "<a style='padding-left: 20px;' href='deleteAd.php?id=$i'>";
            echo "<button>Izbriši</button>";
            echo "</a>";
            echo "<a style='padding-left: 20px;' href='dodajDni.php?id=$i'>";
            echo "<button>Dodaj 30 dni</button>";
            echo "</a>";
            echo "  <a style='padding-left: 20px;' href='dodajKategorijo.php?id=$i'>";
            echo "      <button>Dodaj kategorijo</button>";
            echo "   </a>";
            echo "  <a style='padding-left: 20px;' href='dodajSliko.php?id=$i'>";
            echo "      <button>Dodaj sliko</button>";
            echo "   </a>";
        }
        echo "<br>";
        include_once('api/api.html');
        ?>

    </div>
    <!--    <hr/>-->
<?php

include_once('footer.php');
?>