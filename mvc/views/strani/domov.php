<!-- zelo enostaven pogled, ki enostavno izpiše vrednosti spremelnjivk, ki so bile nastavljene v kontrolerju -->
<p>Pozdrav <?php echo $uporabnik->ime;
    echo " ";
    echo $uporabnik->priimek; ?></p>
<?php
if ($uporabnik->admin == 1)
    echo "<p>Admin</p>";
else
    echo "<p>Uporabnik</p>";
?>
<!--<p>Email: --><?php //echo $uporabnik->email;?><!--</p>-->
<!--<p>Adress: --><?php //echo $uporabnik->naslov;?><!--</p>-->
<!--<p>Post number: --><?php //echo $uporabnik->posta;?><!--</p>-->
<!--<p>Phone: --><?php //echo $uporabnik->tel;?><!--</p>-->
<!--<p>Age: --><?php //echo $uporabnik->starost;?><!--</p>-->