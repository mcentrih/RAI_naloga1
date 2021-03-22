<!--enostaven pogled za prikaz enega oglasa -->
<!-- ta se nahaja v spremenljivki $oglas, ki smo jo pripravili v kontrolerju -->

<?php
$uporabnik = Uporabnik::getByID($_GET["id"]);
?>

<div class="panel panel-default">
    <div class="panel-heading"><h2><?php echo $uporabnik->ime; ?></h2><span
                class="label label-primary"><?php echo $uporabnik->priimek; ?></span></div>
    <div class="panel-body"><?php echo $uporabnik->admin; ?></div>
    <div class="panel-body"><?php echo $uporabnik->email; ?></div>
    <a href="?controller=uporabniki&action=uredi&id=<?php echo $uporabnik->id; ?>">Uredi</a>
</div>