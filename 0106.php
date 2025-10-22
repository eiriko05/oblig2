<?php  
/* slett-Klasse
   Programmet lager et skjema for å velge en Student som skal slettes 
   Programmet sletter den valgte Studenten
*/
?>  

<script src="funksjoner.js"></script>

<h3>Slett Student</h3>

<form method="post" action="" id="slettbrukernavnSkjema" name="slettbrukernavnSkjema" onSubmit="return bekreft()">
  Brukernavn <input type="text" id="brukernavn" name="brukernavn" required /> <br/>
  <input type="submit" value="Slett Klasse" name="slettKlasseKnapp" id="slettKlasseKnapp" /> 
</form>

<?php
if (isset($_POST["slettStudentKnapp"])) {
    $brukernavn = $_POST["brukernavn"];

    if (!$brukernavn) {
        print("Student må fylles ut");
    } else {
        include("db-tilkobling.php");  // kobler til databasen

        // sjekk om Studenten finnes
        $sqlSetning = "SELECT * FROM Student WHERE brukernavn='$brukernavn';";
        $sqlResultat = mysqli_query($db, $sqlSetning) or die("Ikke mulig å hente data fra databasen");
        $antallRader = mysqli_num_rows($sqlResultat);

        if ($antallRader == 0) {
            print("Student finnes ikke");
        } else {
            // slett Klassen
            $sqlSetning = "DELETE FROM Student WHERE brukernavn='$brukernavn';";
            mysqli_query($db, $sqlSetning) or die("Ikke mulig å slette data i databasen");

            print("Følgende Student er nå slettet: $klassekode <br />");
        }
    }
}
?>