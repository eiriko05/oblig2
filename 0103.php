<?php  
/* slett-Klasse
   Programmet lager et skjema for å velge en klasse som skal slettes  
   Programmet sletter den valgte klassen
*/
?>

<script src="funksjoner.js"></script>

<h3>Slett Klasse</h3>

<?php
include("db-tilkobling.php");  // kobler til databasen

// hent alle klasser dynamisk
$sqlSetning = "SELECT klassekode FROM Klasse ORDER BY klassekode;";
$sqlResultat = mysqli_query($db, $sqlSetning) or die("Ikke mulig å hente klasser");
?>

<form method="post" action="" id="slettklassekodeSkjema" name="slettklassekodeSkjema" onSubmit="return bekreft()">
  <label for="klassekode">Velg klassekode:</label>
  <select id="klassekode" name="klassekode" required>
    <option value="">-- Velg klasse --</option>
    <?php
    while ($rad = mysqli_fetch_assoc($sqlResultat)) {
        $kode = $rad['klassekode'];
        echo "<option value='$kode'>$kode</option>";
    }
    ?>
  </select>
  <br/>
  <input type="submit" value="Slett Klasse" name="slettKlasseKnapp" id="slettKlasseKnapp" />
</form>

<?php
if (isset($_POST["slettKlasseKnapp"])) {
    $klassekode = $_POST["klassekode"];

    if (!$klassekode) {
        print("Du må velge en klasse");
    } else {
        // sjekk om Klassen finnes
        $sqlSetning = "SELECT * FROM Klasse WHERE klassekode='$klassekode';";
        $sqlResultat = mysqli_query($db, $sqlSetning) or die("Ikke mulig å hente data fra databasen");
        $antallRader = mysqli_num_rows($sqlResultat);

        if ($antallRader == 0) {
            print("Klassen finnes ikke");
        } else {
            // sjekk om det finnes studenter i denne klassen
            $sqlSetning = "SELECT COUNT(*) AS antall FROM Student WHERE klassekode='$klassekode';";
            $resultat = mysqli_query($db, $sqlSetning);
            $row = mysqli_fetch_assoc($resultat);

            if ($row['antall'] > 0) {
                print("Kan ikke slette klassen fordi den har registrerte studenter.");
            } else {
                // slett klassen hvis ingen studenter er registrert
                $sqlSetning = "DELETE FROM Klasse WHERE klassekode='$klassekode';";
                mysqli_query($db, $sqlSetning) or die("Ikke mulig å slette klassen");
                print("Klassen $klassekode er slettet.");
            }
        }
    }
}
?>
