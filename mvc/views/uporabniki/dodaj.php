<p>Dodaj novega uporabnika</p>
<!-- pogled za dodajanje novega oglasa.-->
<!-- Gre za enostavno formo, ki podatke pošilja na kotroler oglasi, z akcijo shrani-->
<form action="?controller=uporabniki&action=uspesnoDodal" method="post">
    <div class="form-group">
        <label>Username*</label><input class="form-control" required type="text" name="username" /> <br/>
        <label>Email*</label><input class="form-control" required type="Email" name="email" /> <br/>
        <label>Name*</label><input class="form-control" required type="text" name="name" /> <br/>
        <label>Surename*</label><input class="form-control" required type="text" name="surename" /> <br/>
        <label>Address</label><input class="form-control" type="text" name="address" /> <br/>
        <label>Post number</label><input class="form-control" type="text" pattern="\d*" name="postnum" /> <br/>
        <label>Phone number</label><input class="form-control" type="text" pattern="\d*" name="phone" /> <br/>
        <label>Age</label><input class="form-control" type="number" name="age" /> <br/>
        <label>Gender</label> <br/>
        <input class="form-control" checked type="radio" id="male" name="gender" value="m">
            <label for="male">Male</label><br>
        <input class="form-control" type="radio" id="female" name="gender" value="f">
            <label for="female">Female</label><br>
        <label>Password*</label><input class="form-control" required type="password" name="password" /> <br/>
        <label>Repeat password*</label><input class="form-control" required type="password" name="repeat_password" /> <br/>
        <input class="form-control" type="submit" name="dodaj" value="Dodaj" class="btn btn-primary"/> <br/>
    <!-- po pritisku submit gumba, se bo klicala akcija shrani, torej moremo v telesu metode shrani, v našem kontrolerju, ustrezno prebrati podatke ($_POST)-->
    </div>
</form>