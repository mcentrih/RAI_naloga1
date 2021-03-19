<?php
include_once('header.php');

function publish($title, $des, $img, $cat)
{
    global $conn;
    $title = mysqli_real_escape_string($conn, $title);
    $des = mysqli_real_escape_string($conn, $des);
    $user_id = $_SESSION["USER_ID"];
    $date = date('Y-m-d H:i:s');
    $end_date = date('Y-m-d H:i:s');
    $date = DateTime::createFromFormat('Y-m-d H:i:s', $date);
    $end_date = DateTime::createFromFormat('Y-m-d H:i:s', $end_date);
    $end_date = date_add($end_date, date_interval_create_from_date_string('30 days'));
    $end_date = $end_date->format('Y-m-d H:i:s');
    $date = $date->format('Y-m-d H:i:s');
    $cat = mysqli_real_escape_string($conn, $cat);
    //Preberemo vsebino (byte array) slike
    $img_file = file_get_contents($img["tmp_name"]);
    //Pripravimo byte array za pisanje v bazo (v polje tipa LONGBLOB)
    $img_file = mysqli_real_escape_string($conn, $img_file);
    $query = "INSERT INTO oglas (FK_objavil, naslov, opis, datum_oddaje, datum_zapadlosti, slika, kategorija, stevilo_ogledov)
				VALUES('$user_id','$title', '$des', '$date', '$end_date', '$img_file', '$cat', 0)";
    if ($conn->query($query)) {
        return true;
    } else {
        echo "Napaka pri dodajanju oglasa";
        echo mysqli_error($conn);
        return false;
    }
}

if (isset($_POST["poslji"])) {
    if (publish($_POST["title"], $_POST["des"], $_FILES["img"], $_POST["cat"])) {
        header("Location: index.php");
        die();
    } else {
        echo "Napaka pri objavi oglasa.";
    }
}

?>
    <div style="border: 5px solid black; background-color: lightgray; width: 30%; margin: 0 auto;">
        <h2 style="text-align: center;">Objava oglasa</h2>
        <form style="padding-left: 30%;" action="postAd.php" method="POST" enctype="multipart/form-data">
            <p>Naslov</p><input type="text" name="title"/>
            <p>Opis</p><textarea name="des" rows="10" cols="40"></textarea>
            <p>Kategorija</p>
            <select name="cat" id="category" required>
                <option value="">Izberite kategorijo</option>
                <option value="Kmetijska-mehanizacija">Kmetijska-mehanizacija</option>
                <option value="Avto-moto">Avto-moto</option>
                <option value="Šport">Šport</option>
                <option value="Telefonija">Telefonija</option>
            </select>
            <p>Slika</p><input type="file" name="img" required/><br<br>
            <input type="submit" name="poslji" value="Objavi"
                   style="width: 150px; height: 40px; margin-left: 10%;margin-top: 20px;"/>
        </form>
    </div>
<?php
include_once('footer.php');
?>