<?php

class Komentar
{
    //public lastnosti
    public $id;
    public $komentar;
    public $datum;
    public $email;
    public $vzdevek;
    public $FK_oglas;

    /**
     * Komentar constructor.
     * @param $id
     * @param $komentar
     * @param $datum
     * @param $email
     * @param $vzdevek
     * @param $FK_oglas
     */
    public function __construct($id, $komentar, $datum, $email, $vzdevek, $FK_oglas)
    {
        if ($datum == 0) {
            $this->$datum = date("Y/m/d");
        } else {
            $this->$datum = $datum;
            $this->id = $id;
            $this->komentar = $komentar;
            $this->datum = $datum;
            $this->email = $email;
            $this->vzdevek = $vzdevek;
            $this->FK_oglas = $FK_oglas;
        }
    }

    public
    function add($db)
    {
        $komentar = $this->komentar;
        $email = $this->email;
        $username = $this->username;
        $FK_ogls = $this->FK_oglas;

        $qs = "insert into komentarji (komentar, vzdevek, email, datum, FK_oglas) values('$komentar',CURRENT_DATE(),'$email', '$username', '$FK_ogls');";
        $result = mysqli_query($db, $qs);

        if (mysqli_error($db)) {
            var_dump(mysqli_error($db));
            exit();
        }
        $this->id = mysqli_insert_id($db);
    }

    public
    function update($db)
    {
        $komentar = $this->komentar;
        $id = $this->id;

        $qs = "Update komentarji set komentar='$komentar',datum=CURRENT_DATE() where id=$id;";
        echo $qs;
        $result = mysqli_query($db, $qs);

        if (mysqli_error($db)) {
            var_dump(mysqli_error($db));
            exit();
        }

    }

    //statična funkcija, ki jo lahko kličemo brez primerka razreda
    public
    static function getAll($db)
    {
        $qs = "Select * from komentarji";
        $result = mysqli_query($db, $qs);

        if (mysqli_error($db)) {
            var_dump(mysqli_error($db));
            exit();
        }
        $komentarji = array();
        //zgradimo polje oglasov in ga vrnemo
        while ($row = mysqli_fetch_assoc($result)) {
            $komentar = new Komentar($row["komentar"], $row["email"], $row["vzdevek"], $row["FK_ogls"], $row["id"], $row["datum"]);
            $komentarji[] = $komentar;
        }

        return $komentarji;
    }

    //statična funkcija, ki jo lahko kličemo brez primerka razreda
    public
    static function getOne($db, $id)
    {
        $qs = "Select * from komentarji where id=$id";
        $result = mysqli_query($db, $qs);

        if (mysqli_error($db)) {
            var_dump(mysqli_error($db));
            exit();
        }

        //ustvarimo nov objekt oglas
        $row = mysqli_fetch_assoc($result);
        $komentar = new Komentar($row["komentar"], $row["email"], $row["vzdevek"], $row["FK_ogls"], $row["id"], $row["datum"]);


        return $komentar;
    }

    public
    static function delete($db, $id)
    {
        $qs = "DELETE from komentarji where id=$id";
        $result = mysqli_query($db, $qs);

        if (mysqli_error($db)) {
            var_dump(mysqli_error($db));
            exit();
        }

        return 1;
    }

}


?>