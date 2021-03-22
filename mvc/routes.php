<?php

//usmerjevalnik
//v tem trenutku imata spremenljivki $controller in $action že določene vrednosti
//saj so se prenesle iz index.php


//funkcija, ki kliče kontrolerje in hkrati vključuje njihovo kodo in kodo modela
function call($controller, $action) {
  
  //vključimo kodo kontrolerja in modela, ki ga zahteva uporabnik
  //pomembno je poimenovanje datotek, map in razredov v njih, da lahko to delamo dinamično
  require_once('controllers/' . $controller . '_controller.php');
  require_once('models/' . 'uporabniki.php');
  
  //ustvarimo kontroler
  $o=$controller."_controller";
  $controller=new $o;
	//pokličemo akcijo na kontrolerju
  //akcija bo naložila/vrnila pogled torej na tem mestu izpisala html kodo
  $controller->{ $action }();
  
}


if (!$logged) {
  call('strani', 'napaka');
  }
  else {
    call('strani', 'domov');
  }
  
  //preverimo, če uporabnik kliče kontorler, ki sploh obstaja, torej je v našem seznamu dovoljenih klicev
if (array_key_exists($controller, $controllers)) {
  
    //preverimo, če ta kontroler sploh ima želeno akcijo
  if (in_array($action, $controllers[$controller])) {
        //če jo ima, jo z call pokličemo, drugače kličemo akcijo napaka na kontolerju stran
    call($controller, $action);
  }
  else {
    call('strani', 'napaka');
  }
} else {
  call('strani', 'napaka');
}

?>