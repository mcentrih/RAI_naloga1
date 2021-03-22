<?php
include "komentar.php";


//http metoda
$method = $_SERVER['REQUEST_METHOD'];

if (isset($_SERVER['PATH_INFO']))
    $request = explode('/', trim($_SERVER['PATH_INFO'], '/'));
else
    $request = "";


/*
Naš api:
api/komentar/:id/
	PUT -> posodobi
	GET -> vrni komentar
	DELETE -> zbriši komentar

api/komentar
    POST -> dodaj nov komentar
	GET-> vrni vse komentare

api/komentar/JSONP/:callback
	GET -> vrne jsonp rezultat s callback imenom metode

api/proxy
	GET-> proxy na google place search

*/
//povezava na bazo
$db = mysqli_connect("localhost", "root", "", "rai_naloga1");
$db->set_charset("UTF8");

//razpoznamo /komentar
if (isset($request[0]) && ($request[0] == 'komentar')) {

    switch ($method) {
        case 'GET':
            //vrni komentar
            if (isset($request[1]) && $request[1] !== 'JSONP') {
                $komentarId = $request[1];
                $komentar = Komentar::getOne($db, $komentarId);
            } else {
                //vrni vse komentare
                //uporabimo statično funkcijo ::vrniVse
                $komentar = Komentar::getAll($db);
            }
            break;
        case 'PUT':
            //če je podan id, posodobimo komentar
            if (isset($request[1])) {
                $komentarId = $request[1];
                $komentar = Komentar::getOne($db, $komentarId);
                //tukaj so bili oz morajo biti podatki poslani kot json niz
                $input = json_decode(file_get_contents('php://input'), true);
                if (isset($input)) {
                    $komentar->comment = $input['komentar'];
                    $komentar->update($db);
                } else {
                    $komentar = array("info" => "Ni podane vsebine komentara");
                }
            } else
                $komentar = array("info" => "Ni podanega identifikatorja komentar");
            break;
        case 'POST':
            //tukaj so podatki poslani preko url encoded formata
            //najdemo jih v $POST[]
            //če imamo drugo metodo, lahko naredimo
            parse_str(file_get_contents('php://input'), $input);
            if (isset($input)) {
                $komentar = new Komentar($input["komentar"], $input["email"], $input["vzdevek"], $input["FK_ogls"]);
                $komentar->add($db);
            } else {
                $komentar = array("info" => "Ni podane vsebine komentara");
            }

            break;
        case 'DELETE':
            if (isset($request[1])) {
                $komentarId = $request[1];
                if (Komentar::delete($db, $komentarId) == 1) {
                    $komentar = array("info" => "komentar je bil uspešno zbrisan");
                }
            }
            break;
    }

    //del apija, ki se odziva na JSONP zahtevo
    //JSONP/:callback
    if (isset($request[1]) && isset($request[2]) && $request[1] == 'JSONP') {
        $callback = $request[2];
        $komentar = json_encode($komentar);
        echo "$callback($komentar);";
    } else {
        //ta del kode, bi se načeloma lahko ponavljal v vsaki veji switch stavka
        //a ker je enak v vsaki veji smo ga dali na konec, vsaka veja pa nastavi
        //vrednost spremenljivke $komentar

        //nastavimo glave odgovora tako, da brskalniku sporočimo, da mu vračamo json
        header('Content-Type: application/json');
        //omgočimo zahtevo iz različnih domen
        header("Access-Control-Allow-Origin: *");
        //izpišemo komentar, ki smo ga prej ustrezno nastavili
        echo json_encode($komentar);
    }
}

//del apija, ki se odziva na proxy zahtevo
//api/proxy/
if (isset($request[0]) && ($request[0] == 'proxy')) {
    //api/isci/JSONP/callback;

    $arrContextOptions = array("ssl" => array("verify_peer" => false, "verify_peer_name" => false,));
    echo(file_get_contents("https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=46.5475311,15.6357408&radius=500&type=restaurant&keyword=fast&key=AIzaSyCVEC1ERr1a9XG8Etp3e26EHuYc3ZxfFOc", false, stream_context_create($arrContextOptions)));
}
?>