<?php

class uporabniki_controller
{
    public function index()
    {
        $uporabniki = Uporabnik::getAll();
        require_once('views/uporabniki/index.php');
    }

    public function prikazi()
    {
//        if (preveriUporabnika()) {
//            echo "Preverjen uporabnik";
//        }
        if (!isset($_GET['id'])) {
            return call('strani', 'napaka');
        }
        Uporabnik::getByID($_GET['id']);
        require_once('views/uporabniki/prikazi.php');
    }

    public function dodaj()
    {
        require_once('views/uporabniki/dodaj.php');
    }

    public function uspesnoDodal()
    {
        $uporabnik = Uporabnik::add($_POST["username"], $_POST["password"], $_POST["admin"], $_POST["email"], $_POST["ime"], $_POST["priimek"],
            $_POST["naslov"], $_POST["posta"], $_POST["tel"], $_POST["starost"], $_POST["spol"]);
        require_once('views/uporabniki/uspesnoDodal.php');
    }

    public function uredi()
    {
        if (!isset($_GET['id'])) {
            return call('strani', 'napaka');
        }
        $uporabnik = Uporabnik::getByID($_GET['id']);
        require_once('views/uporabniki/uredi.php');
    }

    public function urediUporabnika()
    {
        $uporabnik = Uporabnik::change($_POST["username"], $_POST["password"], $_POST["admin"], $_POST["email"], $_POST["ime"], $_POST["priimek"],
            $_POST["naslov"], $_POST["posta"], $_POST["tel"], $_POST["starost"], $_POST["spol"]);
        require_once('views/uporabniki/uspesnoDodal.php');
    }
}

?>