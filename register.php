<?php
include_once('header.php');
$username = NULL;
$password = NULL;
$mail = NULL;
$ime = NULL;
$priimek = NULL;
$naslov = NULL;
$posta = NULL;
$tel = NULL;
$spol = NULL;
$starost = NULL;

function check_username($username)
{
    global $conn;
    $username = mysqli_real_escape_string($conn, $username);
    $query = "SELECT * FROM user WHERE username='$username'";
    $res = $conn->query($query);
    return mysqli_num_rows($res) > 0;
}

function register($usern, $pass)
{
    global $conn;
    $username = mysqli_real_escape_string($conn, $usern);
    $password = sha1($pass);        //$_POST["registracijaGeslo"];
    $mail = $_POST["regMail"];
    $ime = $_POST["regName"];
    $priimek = $_POST["regSur"];

    if (isset($_POST["regAddr"])) {
        $naslov = $_POST["regAddr"];
    }
    if (isset($_POST["regPost"])) {
        $posta = $_POST["regPost"];
    }
    if (isset($_POST["regTel"])) {
        $tel = $_POST["regTel"];
    }
    if (isset($_POST["regSpol"])) {
        $spol = $_POST["regSpol"];
    }
    if (isset($_POST["regAge"])) {
        $starost = $_POST['regAge'];
    }

    $query = "INSERT INTO user VALUES(NULL,'$username', '$password',  '$mail', '$ime', '$priimek','$naslov','$posta', '$tel',  '$spol', ' $starost' )";
    if ($conn->query($query)) {
        return true;
    } else {
        echo "Napaka pri dodajanju uporabnika";
        echo mysqli_error($conn);
        return false;
    }
}

if (isset($_POST["poslji"])) {
    if ($_POST["regPass"] != $_POST["regPass2"])
        echo "Gesli se ne ujemata.";
    else if (check_username($_POST["regUser"]))
        echo "Uporabniško ime je že zasedeno.";
    else if (register($_POST["regUser"], $_POST["regPass"])) {
        header("Location: login.php");
        die();
    } else
        echo "Prišlo je do napake med registracijo uporabnika.";
}

?>
    <div style="border: 5px solid black; background-color: lightgray; width: 50%; margin: 0 auto;">
        <h2 style="text-align: center;">Registracija</h2>
        <form style="padding-left: 22%; display: flex" action="register.php" method="POST">
            <div style="flex: 0 0 50%">
                <p>Uporabniško ime: </p><input type="text" name="regUser"/><br>
                <p>Geslo: </p><input type="password" name="regPass"/><br>
                <p>Ponovi geslo: </p><input type="password" name="regPass2"/><br>
                <p>Elektronska posta</p><input type="email" name="regMail"/><br>
                <p>Ime: </p><input type="text" name="regName"/><br>
                <p>Priimek: </p><input type="text" name="regSur"/><br>
            </div>
            <div style="flex: 1;">
                <p>Naslov: </p><input type="text" name="regAddr"><br>
                <p>Posta: </p><input type="text" name="regPost"><br>
                <p>Spol: </p>
                <input type="radio" id="moski" name="regSpol" value="0"/><label for="moski">Moški</label>
                <input type="radio" id="zenska" name="regSpol" value="1"><label for="zenska">Ženska</label><br>
                <p>Telefonska številka: </p><input type="tel" name="regTel"/><br>
                <p>Starost: </p><input type="number" name="regAge"/><br><br>
                <input type="submit" name="poslji" value="Pošlji"
                       style="width: 150px; height: 40px; margin-left: 15px;margin-top: 20px;"/>
            </div>
        </form>
    </div>
<?php
include_once('footer.php');
?>