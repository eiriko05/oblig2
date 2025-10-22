<?php  /* registrer-Student */ ?>
<h3>Registrer Student</h3>

<form method="post" action="" id="registrerStudentSkjema" name="registrerStudentSkjema">
  Fornavn: <input type="text" id="fornavn" name="fornavn" required /> <br/>
  Etternavn: <input type="text" id="etternavn" name="etternavn" required /> <br/>
  Brukernavn: <input type="text" id="brukernavn" name="brukernavn" required /> <br/>
  Klassekode: <input type="text" id="klassekode" name="klassekode" required /> <br/>
  <input type="submit" value="Registrer Student" id="registrerStudentKnapp" name="registrerStudentKnapp" /> 
  <input type="reset" value="Nullstill" id="nullstill" name="nullstill" /> <br />
</form>

<?php
if (isset($_POST["registrerStudentKnapp"])) {
    $klassekode = $_POST["klassekode"];
    $brukernavn = $_POST["brukernavn"];
    $etternavn  = $_POST["etternavn"];
    $fornavn    = $_POST["fornavn"];

    if (!$klassekode || !$brukernavn || !$etternavn || !$fornavn) {
        print("Både klassekode, brukernavn, etternavn og fornavn må fylles ut");
    } else {
        include("db-tilkobling.php");  // kobler til databasen

        // sjekk om brukernavn allerede finnes
        $sqlSetning = "SELECT * FROM Student WHERE brukernavn='$brukernavn';";
        $sqlResultat = mysqli_query($db, $sqlSetning) or die("Ikke mulig å hente data fra databasen");
        $antallRader = mysqli_num_rows($sqlResultat);

        if ($antallRader != 0) {
            print("Student er registrert fra før");
        } else {
            $sqlSetning = "INSERT INTO Student (klassekode, brukernavn, fornavn, etternavn)
                           VALUES ('$klassekode','$brukernavn','$fornavn','$etternavn');
            mysqli_query($db, $sqlSetning) or die("Ikke mulig å registrere data i databasen");

            print("Følgende student er nå registrert: $fornavn $etternavn ($brukernavn) i klasse $klassekode");
        }
    }
}
?>