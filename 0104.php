<?php  
/* registrer-Student
   Programmet lager et skjema for å registrere en Student
   Studenten knyttes til en eksisterende klasse via en dynamisk listeboks (kun klassekode)
*/
?>

<h3>Registrer Student</h3>

<?php
include("db-tilkobling.php");  // kobler til databasen

// hent alle klassekoder dynamisk
$sqlSetning = "SELECT klassekode FROM Klasse ORDER BY klassekode;";
$sqlResultat = mysqli_query($db, $sqlSetning) or die("Ikke mulig å hente klassekoder");
?>

<form method="post" action="" id="registrerStudentSkjema" name="registrerStudentSkjema">
  Fornavn: <input type="text" id="fornavn" name="fornavn" required /> <br/>
  Etternavn: <input type="text" id="etternavn" name="etternavn" required /> <br/>
  Brukernavn: <input type="text" id="brukernavn" name="brukernavn" required /> <br/>

  <label for="klassekode">Velg klassekode:</label>
  <select id="klassekode" name="klassekode" required>
    <option value="">-- Velg klassekode --</option>
    <?php
    while ($rad = mysqli_fetch_assoc($sqlResultat)) {
        $kode = $rad['klassekode'];
        echo "<option value='$kode'>$kode</option>";
    }
    ?>
  </select>
  <br/>

  <input type="submit" value="Registrer Student" id="registrerStudentKnapp" name="registrerStudentKnapp" /> 
  <input type="reset" value="Nullstill" id="nullstill" name="nullstill" /> <br />
</form>

<?php
if (isset($_POST["registrerStudentKnapp"])) {
    $fornavn    = $_POST["fornavn"];
    $etternavn  = $_POST["etternavn"];
    $brukernavn = $_POST["brukernavn"];
    $klassekode = $_POST["klassekode"];

    if (!$fornavn || !$etternavn || !$brukernavn || !$klassekode) {
        print("Både fornavn, etternavn, brukernavn og klassekode må fylles ut");
    } else {
        // sjekk om studenten finnes fra før
        $sqlSetning = "SELECT * FROM Student WHERE brukernavn='$brukernavn';";
        $sqlResultat = mysqli_query($db, $sqlSetning) or die("Ikke mulig å hente data fra databasen");
        $antallRader = mysqli_num_rows($sqlResultat);

        if ($antallRader != 0) {
            print("Student er registrert fra før");
        } else {
            // registrer ny student
            $sqlSetning = "INSERT INTO Student (fornavn, etternavn, brukernavn, klassekode) 
                           VALUES ('$fornavn','$etternavn','$brukernavn','$klassekode');";
            mysqli_query($db, $sqlSetning) or die("Ikke mulig å registrere data i databasen");

            print("Følgende student er nå registrert: $fornavn $etternavn ($brukernavn) i klassekode $klassekode");
        }
    }
}
?>