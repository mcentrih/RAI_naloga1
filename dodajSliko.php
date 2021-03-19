<?php
include_once('header.php');

if (isset($_POST["dodaj"])) {
    if (isset($_GET["id"])) {
        global $conn;
        $i = $_GET["id"];
        echo $i;
        $img = $_FILES["img"];
        $img_file = file_get_contents($img["tmp_name"]);
        $img_file = mysqli_real_escape_string($conn, $img_file);
        $query = "INSERT INTO slike(slika, FK_oglas) VALUE ('$img_file', $i) ";
        if ($conn->query($query) === TRUE) {
        } else {
            echo "Napaka pri dodajanju slike!";
            echo mysqli_error($conn);

            return false;
        }
    }
    header("Location: index.php");
}

?>
    <div style="border: 5px solid black; background-color: lightgray; width: 50%; margin: 0 auto;">
        <h2 style="text-align: center;">Dodajanje kategorije</h2>
        <form  style="padding-left: 30%;" action="dodajSliko.php?id=<?php echo $_GET["id"] ?>" method="POST" enctype="multipart/form-data">
            <label>Slika</label><input type="file" name="img" style="padding-left: 20px;" required/><br<br>
            <input type="submit" name="dodaj" value="Dodaj"
                   style="margin-left: 10%;margin-top: 20px;"/>
        </form>
    </div>

<?php
include_once('footer.php');
?>