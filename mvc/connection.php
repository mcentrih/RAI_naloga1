<?php

//razred, ki ima statično spremenljivko, s povezavo na bazo
  class Db {
    private static $instance = NULL;

//funkcija nastavi vrednost te spremeljivke na povezavo z našo bazo, v kolikor še ta vrednost ni nastavljena
//če je že nastavljena, pa jo samo vrne
//na tak način v vsaki zahtevi uporabnika opravimo največ en klic funkcije mysqli_connect, povezavo pa čimvečkrat pouporabimo
    public static function getInstance() {
      if (!isset(self::$instance)) {
       
        self::$instance = mysqli_connect("localhost", "root", "", "rai_naloga1");
      }
      return self::$instance;
    }
  }
?>