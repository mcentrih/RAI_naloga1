<DOCTYPE html>
  <html>
  <head>
    <meta charset="utf-8">
    <!-- dodamo viewport in kodo za dodajanje bootstrap knjižnice -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <!-- dodamo js za ikone iz fontawesome -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.10/js/all.js" integrity="sha384-slN8GvtUJGnv6ca26v8EzVaR9DC58QEwsIk9q1QXdCU8Yu8ck/tL/5szYlBbqmS+" crossorigin="anonymous"></script>
    
    <body>
      <!-- naša stran bo imela fiksno responsive širino-->
      <div class="container text-center">    

        <!-- ustvarimo navbar meni po bootstrap vzorcu-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">

          <!-- Naslov na meniju -->
          <a class="navbar-brand" href="#">MVC Primer</a>

          <!-- gumb, ki se pojavi, ko se meni zaradi širine zaslona skrije, in omogoča vertikalno razširitev menija -->
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <!-- Vsebina menija -->
          <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <!-- levi meni z opcijami za navigacijo -->
            <ul class="navbar-nav mr-auto">
             
              <!-- primer označevanja aktivnih elementov v meniju, ko je opcija/kontroler izbran -->
              <li class="nav-item <?php if($controller!='uporabniki') echo("active");?>">
                <a class="nav-link" href="index.php">Domov </a>
              </li>
              <!-- primer označevanja aktivnih elementov v meniju, ko je opcija/kontroler izbran -->
              <li class="nav-item <?php if($controller=='uporabniki') echo("active");?>">
                <a class="nav-link" href="?controller=uporabniki&action=index">Uporabniki</a>
              </li>
<!--              <li class="nav-item dropdown">-->
<!--                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
<!--                  Dropdown-->
<!--                </a>-->
                <!-- primer spustnega menija znotraj menija -->
<!--                <div class="dropdown-menu" aria-labelledby="navbarDropdown">-->
<!--                  <a class="dropdown-item" href="#">Nekaj	</a>-->
<!--                  <a class="dropdown-item" href="#">Nekaj drugega</a>-->
<!--                  <div class="dropdown-divider"></div>-->
<!--                  <a class="dropdown-item" href="#">Druga opcija</a>-->
<!--                </div>-->
<!--              </li>-->
              <li class="nav-item">
                <a class="nav-link" href="../index.php">Nazaj na prvo vajo</a>
              </li>
            </ul>
          </div>
        </nav>

        <!-- naredimo mrežo kjer ima sredinski element širino 8, ostala dva pa vzameta preostalo širino  -->
        
        <div class="row content">
<!--          <div class="col-sm">-->
<!--            <p><a href="#">Povezava</a></p>-->
<!--            <p><a href="#">Povezava</a></p>-->
<!--            <p><a href="#">Povezava</a></p>-->
<!--          </div>-->
          <div class="col-sm-8 text-left">

            <!-- tukaj se bo vključevala koda pogledov, ki jih bodo nalagali kontrolerji -->
            <!-- klic akcije iz routes bo na tem mestu zgeneriral html kodo, ki bo zalepnjena v našo predlogo -->
            <?php require_once('routes.php'); ?> 



<!--          </div>-->
<!--          <div class="col-sm">-->
<!--            <div class="card">-->
<!--              <p>Reklame</p>-->
<!--            </div>-->
<!--            <div class="card">-->
<!--              <p>Reklame</p>-->
<!--            </div>-->
<!--          </div>-->
        </div>
      </div>

      <footer class="container text-center">
        <p>MVC primer</p>
      </footer>
      <body>
        </html>