<?php
include_once('header.php');

// metoda za branje oglasov in prikazovanje ce smo prijavljeni vseh ce ne pa samo tiste ki jim ni potekel datum
function get_oglasi()
{
    global $conn;
    if (isset($_SESSION["USER_ID"]))
        $query = "SELECT * FROM oglas ORDER BY datum_oddaje ASC";
    else
        $query = "SELECT * FROM oglas WHERE datum_zapadlosti > CURDATE()";
    $res = $conn->query($query);
    $oglasi = array();
    while ($oglas = $res->fetch_object()) {
        array_push($oglasi, $oglas);
    }
    return $oglasi;
}

//Preberi oglase iz baze
$oglasi = get_oglasi();
if (isset($_POST["isci"])) {
    $oglasi = get_oglasi_iskanje();
}
//podobna metoda kot zgoraj samo da ima dodane filtre
function get_oglasi_iskanje()
{
    global $conn;
    $i = $_POST["iskanje"];
    $k = "";
    $p = false;
    if ($_POST["cat"] != "Izberite kategorijo" && $_POST["cat"] != "")
        $k = $_POST["cat"];
    if (isset($_POST["zap"]))
        $p = true;
    if ($p == true)
        $query = "SELECT * FROM oglas WHERE naslov LIKE '%$i%' AND kategorija LIKE '%$k%' ORDER BY datum_oddaje DESC";
    else
        $query = "SELECT * FROM oglas WHERE naslov LIKE '%$i%' AND kategorija LIKE '%$k%' AND datum_zapadlosti > CURDATE() ORDER BY datum_oddaje DESC";

    $res = $conn->query($query);
    $oglasi = array();
    while ($oglas = $res->fetch_object()) {
        array_push($oglasi, $oglas);
    }
    return $oglasi;
}

//filtriranje in iskalnik
?>
    <div style="border: 2px solid black; background-color: lightgray; width: 80%; margin: 0 auto; margin-top: 15px; padding-left: 15px; padding-bottom: 0px; padding-top: 10px;">
        <form method="POST" action="index.php">
            <label style="padding-left: 10%;">Iskanje: </label><input type="text" name="iskanje" style="width: 500px;"/>
            <input type="submit" name="isci" value="Išči" style="width: 50px"/>
            <label style="padding-left: 20%;">Prikaži zapadle: </label><input type="checkbox" name="zap" value="1"/>
            <label>Kategorija</label>
            <select name="cat" id="category">
                <option value="">Izberite kategorijo</option>
                <option value="Nepremičnine">Kmetijska-mehanizacija</option>
                <option value="Avto-moto">Avto-moto</option>
                <option value="Šport">Šport</option>
                <option value="Telefonija">Telefonija</option>
            </select>
        </form>
    </div>
<?php
foreach ($oglasi as $oglas) {
    //izpis vseh oglasov
    $img_data = base64_encode($oglas->slika);

    ?>
    <div style="border: 2px solid black; background-color: lightgray; width: 50%; margin: 0 auto; margin-top: 15px; padding-left: 15px; padding-bottom: 10px;">
        <div>
            <h4><?php echo $oglas->naslov; ?></h4>
            <img src="data:image/jpg;base64, <?php echo $img_data; ?>" width="400"/><br><br>
            <a href="advert.php?id=<?php echo $oglas->id; ?>">
                <button>Preberi več</button>
            </a>
        </div>
    </div>
    <!--    <hr/>-->
    <?php
}


include_once('footer.php');
?>