<?php  
/* slett-Student
   Programmet lager et skjema for å velge en Student som skal slettes 
   Programmet sletter den valgte Studenten
*/
?>  

<script src="funksjoner.js"></script>

<h3>Slett Student</h3>

<form method="post" action="" id="slettbrukernavnSkjema" name="slettbrukernavnSkjema" onSubmit="return bekreft()">
  Brukernavn <input type="text" id="brukernavn" name="brukernavn" required /> <br/>
  <input type="submit" value="Slett Student" name="slettStudentKnapp" id="slettStudentKnapp" /> 
</form>

<?php
if (isset($_POST["slettStudentKnapp"])) 
 {
    $brukernavn = $_POST["brukernavn"];

    if (!$brukernavn) 
{
        print("Student må fylles ut");
} else 
{
        include("db-tilkobling.php");  // kobler til databasen

        // sjekk om Studenten finnes
        $sqlSetning = "SELECT * FROM Student WHERE brukernavn='$brukernavn';";
        $sqlResultat = mysqli_query($db, $sqlSetning) or die("Ikke mulig å hente data fra databasen");
        $antallRader = mysqli_num_rows($sqlResultat);


       if ($antallRader == 0) 
 {
    print("Klasse finnes ikke");
 } else 
 {
    // Sjekk om det finnes studenter i denne klassen
    $sqlSetning = "SELECT COUNT(*) AS antall FROM Student WHERE klassekode='$klassekode';";
    $resultat = mysqli_query($db, $sqlSetning);
    $row = mysqli_fetch_assoc($resultat);

    if ($row['antall'] > 0) 
    {
        print("Kan ikke slette klassen fordi den har registrerte studenter.");
    } else 
    {
        // Slett klassen hvis ingen studenter er registrert
        $sqlSetning = "DELETE FROM Klasse WHERE klassekode='$klassekode';";
        mysqli_query($db, $sqlSetning) or die("Ikke mulig å slette klassen");
        print("Klassen $klassekode er slettet.");
    }
 } 
}
    }
?>