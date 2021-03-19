<?php
include_once('header.php');

function update($title, $des, $img, $cat)
{
    if (isset($_GET["id"])) {
        global $conn;
        $title = mysqli_real_escape_string($conn, $title);
        $des = mysqli_real_escape_string($conn, $des);
        $cat = mysqli_real_escape_string($conn, $cat);
        $i = $_GET["id"];
        $img_file = file_get_contents($img["tmp_name"]);
        $img_file = mysqli_real_escape_string($conn, $img_file);
        $query = "UPDATE oglas SET naslov = '$title', opis = '$des', datum_oddaje = CURRENT_DATE, datum_zapadlosti = (ADDDATE(CURDATE(),30)), slika = '$img_file', kategorija = '$cat', stevilo_ogledov = 0 WHERE id = $i";
        if ($conn->query($query) === TRUE) {
            return true;
        } else {
            echo "Napaka pri spreminjanju oglasa!";
            echo mysqli_error($conn);
            return false;
        }
    }
}


if (isset($_POST["poslji"])) {
    if (update($_POST["title"], $_POST["des"], $_FILES["img"], $_POST["cat"])) {
        header("Location: index.php");
        die();
    } else {
        echo "Napaka pri spremembi.";
    }
}

?>
    <div style="border: 5px solid black; background-color: lightgray; width: 30%; margin: 0 auto;">
        <h2 style="text-align: center;">Urejanje oglasa</h2>
        <form style="padding-left: 30%;" action="editAd.php?id=<?php echo $_GET["id"] ?>" method="POST" enctype="multipart/form-data">
            <p>Naslov</p><input type="text" name="title"/>
            <p>Opis</p><textarea name="des" rows="10" cols="40"></textarea>
            <p>Kategorija</p>
            <select name="cat" id="category">
                <option value="">Izberite kategorijo</option>
                <option value="Kmetijska-mehanizacija">Kmetijska-mehanizacija</option>
                <option value="Avto-moto">Avto-moto</option>
                <option value="Šport">Šport</option>
                <option value="Telefonija">Telefonija</option>
            </select>
            <p>Slika</p><input type="file" name="img"/><br<br>
            <input type="submit" name="poslji" value="Shrani"
                   style="width: 150px; height: 40px; margin-left: 10%;margin-top: 20px;"/>
        </form>
    </div>
<?php
include_once('footer.php');
?>