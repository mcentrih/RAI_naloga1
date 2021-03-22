<?php
$uporabnik = Uporabnik::getByID($_SESSION["USER_ID"])
?>
<p>Uredi uporabnika</p>
<form action="?controller=uporabniki&action=urediUporabnika&id=<?php echo $uporabnik->id; ?>" method="post">
<div class="form-group">
    <label>Username*</label><input class="form-control" required type="text" value="<?php echo $uporabnik->username; ?>" name="username" /> <br/>
    <label>Admin</label><input class="form-control" required type="number" value="<?php echo $uporabnik->admin; ?>" name="admin" /> <br/>
    <label>Email*</label><input class="form-control" required type="Email" value="<?php echo $uporabnik->email; ?>" name="email" /> <br/>
    <label>Name*</label><input class="form-control" required type="text" value="<?php echo $uporabnik->ime; ?>" name="ime" /> <br/>
    <label>Surename*</label><input class="form-control" required type="text" value="<?php echo $uporabnik->priimek; ?>" name="priimek" /> <br/>
    <label>Address</label><input class="form-control" type="text" value="<?php echo $uporabnik->naslov; ?>" name="naslov" /> <br/>
    <label>Post number</label><input class="form-control" type="text" value="<?php echo $uporabnik->posta; ?>" name="posta" /> <br/>
    <label>Phone number</label><input class="form-control" type="text" value="<?php echo $uporabnik->tel; ?>" name="tel" /> <br/>
    <label>Age</label><input class="form-control" value="<?php echo $uporabnik->starost; ?>" type="number" name="starost" /> <br/>
    <label>Gender</label> <br/>
    <input class="form-control" checked="checked" type="radio" id="male" name="spol" value="m">
        <label for="male">Male</label><br>
    <input class="form-control" type="radio" id="female" name="spol" value="f">
        <label for="female">Female</label><br>
    <label>Password*</label><input class="form-control" type="password" name="password" /> <br/>
    <input class="form-control" type="submit" name="uredi" value="Shrani spremembe" class="btn btn-primary"/> <br/>
</div>
</form>