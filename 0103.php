<?php  
/* slett-Klasse
   Programmet lager et skjema for å velge en klasse som skal slettes  
   Programmet sletter den valgte klassen
*/
?>  

<script src="funksjoner.js"></script>

<h3>Slett Klasse</h3>

<form method="post" action="" id="slettklassekodeSkjema" name="slettklassekodeSkjema" onSubmit="return bekreft()">
  Klassekode: <input type="text" id="klassekode" name="klassekode" required /> <br/>
  <input type="submit" value="Slett Klasse" name="slettKlasseKnapp" id="slettKlasseKnapp" /> 
</form>

<?php
if (isset($_POST["slettKlasseKnapp"])) 
{
    $klassekode = $_POST["klassekode"];

    if (!$klassekode) 
    {
        print("Klasse må fylles ut");
    } else 
    {
        include("db-tilkobling.php");  // kobler til databasen

        // sjekk om Klassen finnes
        $sqlSetning = "SELECT * FROM Klasse WHERE klassekode='$klassekode';";
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