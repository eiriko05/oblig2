<?php  /* registrer-Student */
/*
/*  Programmet lager et html-skjema for å registrere en Student
/*  Programmet registrerer data (Brukernavn Fornavn Etternavn og klassekode) i databasen
*/
?> 

<h3>Registrer klasse </h3>

<form method="post" action="" id="registrerKlasseSkjema" name="registrerKlasseSkjema">
  Klassekode <input type="text" id="Klassekode" name="Klassekode" required /> <br/>
  brukernavn <input type="text" id="brukernavn" name="brukernavn" required /> <br/>
  etternavn <input type="text" id="etternavn" name="etternavn" required/> <br/>
  fornavn <input type="text" id="fornavn" name="fornavn" required/> <br/>
  <input type="submit" value="Registrer klassekode" id="registrerKlassekodeKnapp" name="registrerKlassekodeKnapp" /> 
  <input type="reset" value="Nullstill" id="nullstill" name="nullstill" /> <br />
</form>

<?php 
  if (isset($_POST ["registrerStudentKnapp"]))
    {
      $Klassekode=$_POST ["Klassekode"];
      $brukernavn=$_POST ["brukernavn"];
      $etternavn=$_POST ["etternavn"];
      $fornavn=$_POST ["fornavn"]
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

          if ($antallRader!=0)  /* Klassekode er registrert fra før */
            {
              print ("Klassekode er registrert fra f&oslashr");
            }
          else
            {
              $sqlSetning="INSERT INTO Klassekode VALUES('$Klassekode','$Klassenavn','$Studiumkode');";
              mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; registrere data i databasen");
                /* SQL-setning sendt til database-serveren */

              print ("F&oslash;lgende Klassekode er n&aring; registrert: $Klassenavn $Klassekode $Studiumkode"); 
            }
        }
    }
?> 