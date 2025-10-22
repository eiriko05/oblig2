<?php  
/* registrer-Klasse
   Programmet lager et skjema for å registrere en Klasse
   Klassenavn og studiumkode skrives inn manuelt,
   mens klassekode velges fra en dynamisk listeboks
*/
?>

<h3>Registrer klasse</h3>

<?php
include("db-tilkobling.php");  // kobler til databasen

// hent alle gyldige klassekodr fra en egen tabell (Klassekoder)
$sqlSetning = "SELECT klassekode FROM Klassekode ORDER BY klassekode;";
$sqlResultat = mysqli_query($db, $sqlSetning) or die("Ikke mulig å hente klassekoder");
?>

<form method="post" action="" id="registrerKlasseSkjema" name="registrerKlasseSkjema">
  Klassenavn: <input type="text" id="klassenavn" name="klassenavn" required /> <br/>
  Studiumkode: <input type="text" id="studiumkode" name="studiumkode" required /> <br/>

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

  <input type="submit" value="Registrer Klasse" id="registrerKlasseKnapp" name="registrerKlasseKnapp" /> 
  <input type="reset" value="Nullstill" id="nullstill" name="nullstill" /> <br />
</form>

<?php  
if (isset($_POST["registrerKlasseKnapp"])) {
    $klassenavn = $_POST["klassenavn"];
    $studiumkode = $_POST["studiumkode"];
    $klassekode = $_POST["klassekode"];

    if (!$klassekode || !$klassenavn || !$studiumkode) {
        print("Både klassekode, klassenavn og studiumkode må fylles ut");
    } else {
        // sjekk om klassen finnes fra før
        $sqlSetning = "SELECT * FROM Klasse WHERE klassekode='$klassekode';";
        $sqlResultat = mysqli_query($db, $sqlSetning) or die("Ikke mulig å hente data fra databasen");
        $antallRader = mysqli_num_rows($sqlResultat);

        if ($antallRader != 0) {
            print("Klassekode er registrert fra før");
        } else {
            // registrer ny klasse
            $sqlSetning = "INSERT INTO Klasse (klassenavn, studiumkode, klassekode) 
                           VALUES ('$klassenavn', '$studiumkode', '$klassekode');";
            mysqli_query($db, $sqlSetning) or die("Ikke mulig å registrere data i databasen");

            print("Følgende klasse er nå registrert: $klassenavn ($klassekode) i studium $studiumkode");
        } 
    }
}
?>