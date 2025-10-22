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
  Klassekode <input type="text" id="klassekode" name="klassekode" required /> <br/>
  <input type="submit" value="Registrer Student" id="registrerStudentKnapp" name="registrerStudentKnapp" />
  <input type="reset" value="Nullstill" id="nullstill" name="nullstill" /> <br />
</form>

<?php
if (isset($_POST["registrerStudentKnapp"])) {
  $fornavn=$_POST["fornavn"];
  $etternavn=$_POST["etternavn"];
  $brukernavn=$_POST["brukernavn"];
  $klassekode=$_POST["klassekode"];

  if (!$fornavn || !$etternavn || !$brukernavn || !$klassekode) {
    print("B&aring;de brukernavn, etternavn, brukernavn og klassekode m&aring; fylles ut");
  } else {
    include("db-tilkobling.php"); /* tilkobling til database-serveren utført og valg av database foretatt */
     
    $sqlSetning="SELECT * FROM Student WHERE klassekode='$klassekode';";
          $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");
          $antallRader=mysqli_num_rows($sqlResultat); 


    $sql = "INSERT INTO Student (brukernavn,fornavn,etternavn,klassekode)
            VALUES ('$brukernavn','$fornavn','$etternavn','$klassekode')";

     if ($antallRader!=0)  /* Student er registrert fra før */
            {
              print ("Student er registrert fra f&oslashr");
            }
          else
            {

              print ("F&oslash;lgende Student er n&aring; registrert: $fornavn $etternavn $brukernavn $klassekode"); 
            }
        }
    }
?> 