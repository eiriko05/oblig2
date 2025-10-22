<?php  /* registrer-Student */
/*
/*  Programmet lager et html-skjema for å registrere en Student
/*  Programmet registrerer data (Brukernavn, Fornavn, Etternavn og Klassekode) i databasen
*/
?>

<h3>Registrer Student</h3>

<form method="post" action="" id="registrerStudentSkjema" name="registrerStudentSkjema">
  Fornavn <input type="text" id="fornavn" name="fornavn" required /> <br/>
  Etternavn <input type="text" id="etternavn" name="etternavn" required /> <br/>
  Brukernavn <input type="text" id="brukernavn" name="brukernavn" required /> <br/>
  Klassekode <input type="text" id="Klassekode" name="Klassekode" required /> <br/>
  <input type="submit" value="Registrer Student" id="registrerStudentKnapp" name="registrerStudentKnapp" />
  <input type="reset" value="Nullstill" id="nullstill" name="nullstill" /> <br />
</form>

<?php
if (isset($_POST["registrerStudentKnapp"])) {
  include("db-tilkobling.php");  // Tilkobling til database

  $Klassekode = mysqli_real_escape_string($db, $_POST["Klassekode"]);
  $brukernavn = mysqli_real_escape_string($db, $_POST["brukernavn"]);
  $etternavn = mysqli_real_escape_string($db, $_POST["etternavn"]);
  $fornavn = mysqli_real_escape_string($db, $_POST["fornavn"]);

  if (!$Klassekode || !$brukernavn || !$etternavn || !$fornavn) {
    echo "Både Klassekode, brukernavn, etternavn og fornavn må fylles ut.";
  } else {
    // Sjekk om brukernavn allerede finnes
    $sqlSetning = "SELECT * FROM Student WHERE brukernavn = '$brukernavn';";
    $sqlResultat = mysqli_query($db, $sqlSetning) or die("Ikke mulig å hente data fra databasen");
    $antallRader = mysqli_num_rows($sqlResultat);

    if ($antallRader != 0) {
      echo "Student er registrert fra før.";
    } else {
      // Sett inn ny Student
      $sqlSetning = "INSERT INTO Student (klassekode, brukernavn, fornavn, etternavn)
                     VALUES ('$Klassekode', '$brukernavn', '$fornavn', '$etternavn');";
      mysqli_query($db, $sqlSetning) or die("Ikke mulig å registrere data i databasen");

      echo "Følgende student er nå registrert: " .
           htmlspecialchars($fornavn) . " " .
           htmlspecialchars($etternavn) . " (" .
           htmlspecialchars($brukernavn) . "), klassekode: " .
           htmlspecialchars($Klassekode);
    }
  }
}
?>