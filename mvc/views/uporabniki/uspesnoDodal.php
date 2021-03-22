<!--enostaven pogled za informiranje o uspešnosti dodajanja oglasa -->
<!-- ta se nahaja v spremenljivki $oglas, ki smo jo pripravili v kontrolerju, uporabniku pa damo še povezavo na izpis celotnega oglasa (preko akcije prikazi) -->

<p>Uporabnik je bil uspešno shranjen!</p>
<p>Viden je <a href="?controller=uporabniki&action=prikazi&id=<?php echo $uporabnik->id; ?>">tukaj</a></p>