<?php  
/* slett-Student
   Programmet lager et skjema for å velge en Student som skal slettes 
   Programmet sletter den valgte Studenten
*/
?>

<script src="funksjoner.js"></script>

<h3>Slett Student</h3>

<?php
include("db-tilkobling.php");  // kobler til databasen

// hent alle studenter dynamisk
$sqlSetning = "SELECT brukernavn, fornavn, etternavn FROM Student ORDER BY brukernavn;";
$sqlResultat = mysqli_query($db, $sqlSetning) or die("Ikke mulig å hente studenter");
?>

<form method="post" action="" id="slettbrukernavnSkjema" name="slettbrukernavnSkjema" onSubmit="return bekreft()">
  <label for="brukernavn">Velg student:</label>
  <select id="brukernavn" name="brukernavn" required>
    <option value="">-- Velg student --</option>
    <?php
    while ($rad = mysqli_fetch_assoc($sqlResultat)) {
        $brukernavn = $rad['brukernavn'];
        $navn = $rad['fornavn'] . " " . $rad['etternavn'];
        echo "<option value='$brukernavn'>$brukernavn – $navn</option>";
    }
    ?>
  </select>
  <br/>
  <input type="submit" value="Slett Student" name="slettStudentKnapp" id="slettStudentKnapp" />
</form>

<?php
if (isset($_POST["slettStudentKnapp"])) {
    $brukernavn = $_POST["brukernavn"];

    if (!$brukernavn) {
        print("Du må velge en student");
    } else {
        // sjekk om Studenten finnes
        $sqlSetning = "SELECT * FROM Student WHERE brukernavn='$brukernavn';";
        $sqlResultat = mysqli_query($db, $sqlSetning) or die("Ikke mulig å hente data fra databasen");
        $antallRader = mysqli_num_rows($sqlResultat);

        if ($antallRader == 0) {
            print("Student finnes ikke");
        } else {
            // slett Student
            $sqlSetning = "DELETE FROM Student WHERE brukernavn='$brukernavn';";
            mysqli_query($db, $sqlSetning) or die("Ikke mulig å slette data i databasen");

            print("Følgende student er nå slettet: $brukernavn <br />");
        }
    }
}
?>