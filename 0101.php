<?php  
/* registrer-Student
   Programmet lager et skjema for å registrere en Student
   Studenten knyttes til en eksisterende klasse via en dynamisk listeboks
*/
?>

<h3>Registrer student</h3>

<?php
include("db-tilkobling.php");  // kobler til databasen

// hent alle klasser dynamisk
$sqlSetning = "SELECT klassekode, klassenavn FROM Klasse ORDER BY klassekode;";
$sqlResultat = mysqli_query($db, $sqlSetning) or die("Ikke mulig å hente klasser");
?>

<form method="post" action="" id="registrerStudentSkjema" name="registrerStudentSkjema">
  Brukernavn: <input type="text" id="brukernavn" name="brukernavn" required /> <br/>
  Fornavn: <input type="text" id="fornavn" name="fornavn" required /> <br/>
  Etternavn: <input type="text" id="etternavn" name="etternavn" required /> <br/>

  <label for="klassekode">Velg klasse:</label>
  <select id="klassekode" name="klassekode" required>
    <option value="">-- Velg klasse --</option>
    <?php
    while ($rad = mysqli_fetch_assoc($sqlResultat)) {
        $kode = $rad['klassekode'];
        $navn = $rad['klassenavn'];
        echo "<option value='$kode'>$kode – $navn</option>";
    }
    ?>
  </select>
  <br/>

  <input type="submit" value="Registrer Student" id="registrerStudentKnapp" name="registrerStudentKnapp" /> 
  <input type="reset" value="Nullstill" id="nullstill" name="nullstill" /> <br />
</form>

<?php  
if (isset($_POST["registrerStudentKnapp"])) {
    $brukernavn = $_POST["brukernavn"];
    $fornavn = $_POST["fornavn"];
    $etternavn = $_POST["etternavn"];
    $klassekode = $_POST["klassekode"];

    if (!$brukernavn || !$fornavn || !$etternavn || !$klassekode) {
        print("Alle felt må fylles ut");
    } else {
        // sjekk om studenten finnes fra før
        $sqlSetning = "SELECT * FROM Student WHERE brukernavn='$brukernavn';";
        $sqlResultat = mysqli_query($db, $sqlSetning) or die("Ikke mulig å hente data fra databasen");
        $antallRader = mysqli_num_rows($sqlResultat);

        if ($antallRader != 0) {
            print("Student med brukernavn $brukernavn finnes allerede");
        } else {
            // registrer ny student
            $sqlSetning = "INSERT INTO Student (brukernavn, fornavn, etternavn, klassekode) 
                           VALUES ('$brukernavn', '$fornavn', '$etternavn', '$klassekode');";
            mysqli_query($db, $sqlSetning) or die("Ikke mulig å registrere data i databasen");

            print("Student $fornavn $etternavn ($brukernavn) er nå registrert i klasse $klassekode");
        } 
    }
}
?>