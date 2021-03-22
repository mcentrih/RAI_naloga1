<p>Seznam vseh uporabnikov</p>
<!-- pogled za pregeld vseh oglasov-->
<!-- na vrhu damu uporabniku gumb, s katerim proži akcijo dodaj, da lahko dodaja nove uporabnike -->
<a href="?controller=uporabniki&action=dodaj" class="btn btn-primary">Dodaj <i class="fas fa-plus"></i></a>
<table class="table table-hover">
    <thead>
      <tr>
        <th>ID</th>
        <th>Email</th>
        <th>Ime</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
 
 <!-- tukaj se sprehodimo čez array oglasov in izpisujemo vrstico posameznega oglasa-->

<?php foreach($uporabniki as $uporabnik) { ?>
  <tr>
  <td><?php echo $uporabnik->id; ?></td>
  <td><?php echo $uporabnik->email; ?></td>
  <td><?php echo $uporabnik->ime; ?></td>
  <td>
    <!-- pri vsakem oglasu dodamo povezavo na akcijo prikaži, z idjem oglasa. Uporabnik lahko tako proži novo akcijo s pritiskom na gumb.-->
    <a href='?controller=uporabniki&action=prikazi&id=<?php echo $uporabnik->id; ?>'>Poglej uporabnika</a>
	</td>
 </tr>
<?php } ?>

    
       
      
    </tbody>
  </table>