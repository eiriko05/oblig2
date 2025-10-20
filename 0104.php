<?php  /* registrer-Student */
/*
/*  Programmet lager et html-skjema for å registrere en Student
/*  Programmet registrerer data (Brukernavn Fornavn Etternavn og klassekode) i databasen
*/
?> 

<h3>Registrer Student </h3>

<form method="post" action="" id="registrerStudentSkjema" name="registrerStudentSkjema">
  Klassekode <input type="text" id="Klassekode" name="Klassekode" required /> <br/>
  Brukernavn <input type="text" id="brukernavn" name="brukernavn" required /> <br/>
  Etternavn <input type="text" id="etternavn" name="etternavn" required/> <br/>
  Fornavn <input type="text" id="fornavn" name="fornavn" required/> <br/>
  <input type="submit" value="Registrer Student" id="registrerStudentkodeKnapp" name="registrerStudentkodeKnapp" /> 
  <input type="reset" value="Nullstill" id="nullstill" name="nullstill" /> <br />
</form>

<?php 
  if (isset($_POST ["registrerStudentKnapp"]))
    {
      $Klassekode=$_POST ["Klassekode"];
      $brukernavn=$_POST ["brukernavn"];
      $etternavn=$_POST ["etternavn"];
      $fornavn=$_POST ["fornavn"];
      if (!$Klassekode || !$brukernavn || !$etternavn || !$fornavn )
        {
          print ("B&aring;de Klassekode  brukernavn etternavn og fornavn m&aring; fylles ut");
        }
      else
        {
          include("db-tilkobling.php");  /* tilkobling til database-serveren utført og valg av database foretatt */

          $sqlSetning="SELECT * FROM brukernavn WHERE fornavnv and etternavn='$brukernavn';";
          $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");
          $antallRader=mysqli_num_rows($sqlResultat); 

          if ($antallRader!=0)  /* Student er registrert fra før */
            {
              print ("Student er registrert fra f&oslashr");
            }
          else
            {
              $sqlSetning="INSERT INTO Student VALUES('$Klassekode','$brukernavn','$fornavn','$etternavn');";
              mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; registrere data i databasen");
                /* SQL-setning sendt til database-serveren */

              print ("F&oslash;lgende Student er n&aring; registrert: $fornavn $Klassekode $etternavn $brukernavn"); 
            }
        }
    }
?> 