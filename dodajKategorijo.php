<?php
include_once('header.php');

if (isset($_POST["dodaj"])) {
    if (isset($_GET["id"])) {
        global $conn;
        $i = $_GET["id"];
        echo $i;
        $cat = $_POST["cat"];
        $query = "INSERT INTO kategorije(naziv, FK_oglas) VALUE ('$cat', $i) ";
        if ($conn->query($query) === TRUE) {
        } else {
            echo "Napaka pri dodajanju kategorije!";
            echo mysqli_error($conn);

            return false;
        }
    }
    header("Location: index.php");
}

?>
    <div style="border: 5px solid black; background-color: lightgray; width: 50%; margin: 0 auto;">
        <h2 style="text-align: center;">Dodajanje kategorije</h2>
        <form  style="padding-left: 30%;" action="dodajKategorijo.php?id=<?php echo $_GET["id"] ?>" method="POST">
            <label>Kategorija</label>
            <select name="cat" id="category" required>
                <option value="">Izberite kategorijo</option>
                <option value="Kmetijska-mehanizacija">Kmetijska-mehanizacija</option>
                <option value="Avto-moto">Avto-moto</option>
                <option value="Šport">Šport</option>
                <option value="Telefonija">Telefonija</option>
            </select>
            <input type="submit" name="dodaj" value="Dodaj"
                   style="margin-left: 10%;margin-top: 20px;"/>
        </form>
    </div>

<?php
include_once('footer.php');
?>