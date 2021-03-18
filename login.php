<?php
include_once('header.php');

function check_credentials($username, $password)
{
    global $conn;
    $username = mysqli_real_escape_string($conn, $username);
    $pass = sha1($password);
    $query = "SELECT * FROM user WHERE username='$username' AND password='$pass'";
    $res = $conn->query($query);
    if ($user_obj = $res->fetch_object()) {
        return $user_obj->id;
    }
    return -1;
}

$error = "";
if (isset($_POST["poslji"])) {
    //preverjanje podatkov za prijavo
    if (($id = check_credentials($_POST["user"], $_POST["pass"])) >= 0) {
        //prijava uporabnika in preusmeritev
        $_SESSION["USER_ID"] = $id;
        header("Location: index.php");
        die();
    } else {
        echo "Login unsuccessful!";
    }
}
?>
    <div style="border: 5px solid black; background-color: lightgray; width: 50%; margin: 0 auto;">
    <h2 style="text-align: center;">Login</h2>
    <form style="padding-left: 42%;" action="login.php" method="POST">
        <p>Username: </p><input type="text" name="user"/>
        <p>Password: </p><input type="password" name="pass"/><br><br>
        <input type="submit" name="poslji" value="Pošlji" style="width: 100px; height: 30px; margin-left: 30px;"/>
    </form>
    </div>

<?php
include_once('footer.php');
?>