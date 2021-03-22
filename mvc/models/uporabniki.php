<?php

class Uporabnik
{
    public $id;
    public $username;
    public $password;
    public $admin;
    public $email;
    public $ime;
    public $priimek;
    public $naslov;
    public $posta;
    public $tel;
    public $spol;
    public $starost;

    public function __construct($id, $username, $password, $admin, $email, $ime, $priimek, $naslov, $posta, $tel, $spol, $starost)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->admin = $admin;
        $this->email = $email;
        $this->ime = $ime;
        $this->priimek = $priimek;
        $this->naslov = $naslov;
        $this->posta = $posta;
        $this->tel = $tel;
        $this->spol = $spol;
        $this->starost = $starost;
    }

    public static function getAll()
    {
        $list = [];
        $db = Db::getInstance();
        $result = mysqli_query($db, 'SELECT * FROM user');
        while ($row = mysqli_fetch_assoc($result)) {
            $list[] = new Uporabnik($row['id'], $row['username'], $row['password'], $row['admin'], $row['email'], $row['ime'], $row['priimek'], $row['naslov'], $row['posta'], $row['telefonska'], $row['spol'], $row['starost']);
        }
        return $list;
    }

    public static function getByID($id)
    {
        $id = intval($id);
        $db = Db::getInstance();
        $result = mysqli_query($db, "SELECT * FROM user where id=$id");
        $row = mysqli_fetch_assoc($result);
        return new Uporabnik($row['id'], $row['username'], $row['password'], $row['admin'], $row['email'], $row['ime'], $row['priimek'], $row['naslov'], $row['posta'], $row['telefonska'], $row['spol'], $row['starost']);
    }

    public static function add($username, $password, $admin, $email, $ime, $priimek, $naslov, $posta, $tel, $starost, $spol)
    {
        $db = Db::getInstance();
        $pass = md5($password);
        if ($stmt = mysqli_prepare($db, "Insert into user (username, password, admin, email, ime, priimek, naslov, posta, telefonska, spol, starost) Values ('$username','$password','$admin','$email','$ime','$priimek','$naslov','$posta','$tel','$spol','$starost')")) {
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
        $id = mysqli_insert_id($db);
        return Uporabnik::getByID($id);
    }

    public static function change($username, $password, $admin, $email, $ime, $priimek, $naslov, $posta, $tel, $starost, $spol)
    {
        $db = Db::getInstance();
        $id = $_GET['id'];
        if (strlen($password) > 0) {
            $pass = md5($password);
            if ($stmt = mysqli_prepare($db, "UPDATE user SET email='$email',ime='$ime', admin='$admin',priimek='$priimek',
                                  naslov='$naslov',posta='$posta',telefonska='$tel',starost='$starost',spol='$spol',username='$username',password='$pass' WHERE id = '$id'")) {
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
            }
        } else {
            if ($stmt = mysqli_prepare($db, "UPDATE user SET email='$email',ime='$ime', admin='$admin',priimek='$priimek',
                                  naslov='$naslov',posta='$posta',telefonska='$tel',starost='$starost',spol='$spol',username='$username' WHERE id = '$id'")) {
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
            }
        }
        return Uporabnik::getByID($id);
    }
}

?>