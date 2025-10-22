<?php  /* registrer-Student */
/*
/*  Programmet lager et html-skjema for å registrere en Student
/*  Programmet registrerer data (Brukernavn Fornavn Etternavn og klassekode) i databasen
*/
?>

<h3>Registrer Student </h3>

<form method="post" action="" id="registrerStudentSkjema" name="registrerStudentSkjema">
  Fornavn <input type="text" id="fornavn" name="fornavn" required/> <br/>
  Etternavn <input type="text" id="etternavn" name="etternavn" required/> <br/>
  Brukernavn <input type="text" id="brukernavn" name="brukernavn" required /> <br/>
  Klassekode <input type="text" id="Klassekode" name="Klassekode" required /> <br/>
  <input type="submit" value="Registrer Student" id="registrerStudentKnapp" name="registrerStudentKnapp" />
  <input type="reset" value="Nullstill" id="nullstill" name="nullstill" /> <br />
</form>

<?php
if (isset($_POST["registrerStudentKnapp"])) {
  $Klassekode = $_POST["Klassekode"];
  $brukernavn = $_POST["brukernavn"];
  $etternavn = $_POST["etternavn"];
  $fornavn = $_POST["fornavn"];

  if (!$Klassekode || !$brukernavn || !$etternavn || !$fornavn) {
    print ("B&aring;de Klassekode, brukernavn, etternavn og fornavn m&aring; fylles ut");
  } else {
    include("db-tilkobling.php");