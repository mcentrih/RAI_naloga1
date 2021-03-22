<?php
//primer uporabe apija iz php kode
//z file_get_contents lahko naredimo preprosto get zahtevo na poljuben naslov
//funkcija vrne niz, deluje enako kot da bi brali datoteke

$post=json_decode(file_get_contents("https://jsonplaceholder.typicode.com/posts/1"));
var_dump($post);




//če želimo z file_get_contents narediti druge zahteve je potrebno narediti sledeče:


//ustvarimo podatke, ki bi jih radi poslali
$postdata = http_build_query(
    array(
        'title' => 'Nov post',
        'body' => 'Ni vsebine',
        'userId' => 1
    )
);

//definiramo način pošiljanja (podobno kot to naredimo v metodi $.ajax)
$opts = array('http' =>
    array(
        'method'  => 'POST',
        'header'  => 'Content-type: application/x-www-form-urlencoded',
        'content' => $postdata
    )
);

//ustvarimo context, ki bo funkciji file_get_contents povedal, kako naj naredi zahtevo
$context  = stream_context_create($opts);

//pokličemo funkcijo , kjer podamo naslov in context v katerem naj se izvede zahteva na ta naslov
//drugi parameter mora biti false, saj predstavlja vključevanje obstoječe poti, kjer se nahaja naša datoteka v sam naslov zahteve
//če bi ga dali na true, bi delali zahtevo na naslov v obliki c:\uwamp\www\https://jsonplaceholder.typicode.com/posts
$result = file_get_contents('https://jsonplaceholder.typicode.com/posts', false, $context);

//vrnemo rezultate zahteve
var_dump(json_decode($result));


?>