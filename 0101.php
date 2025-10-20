<?php  /* registrer-Klasse */
/*
/*  Programmet lager et html-skjema for å registrere en Klassekode
/*  Programmet registrerer data (Klassenavn Klassekode og Studiumkode) i databasen
*/
?> 

<h3>Registrer klasse </h3>

<form method="post" action="" id="registrerKlasseSkjema" name="registrerKlasseSkjema">
  Klassekode <input type="text" id="Klassekode" name="Klassekode" required /> <br/>
  Klassenavn <input type="text" id="Klassenavn" name="Klassenavn" required /> <br/>
  Studiumkode <input type="text" id="Studiumkode" name="Studiumkode" rewuired/> <br/>
  <input type="submit" value="Registrer klassekode" id="registrerKlassekodeKnapp" name="registrerKlassekodeKnapp" /> 
  <input type="reset" value="Nullstill" id="nullstill" name="nullstill" /> <br />
</form>

<?php 
  if (isset($_POST ["registrerKlassekodeKnapp"]))
    {
      $Klassekode=$_POST ["Klassekode"];
      $Klassenavn=$_POST ["Klassenavn"];
      $Studiumkode=$_POST ["Studiumkode"];

      if (!$Klassekode || !$Klassenavn || !$Studiumkode)
        {
          print ("B&aring;de Klassekode og Klassenavn og Studiumkode m&aring; fylles ut");
        }
      else
        {
          include("db-tilkobling.php");  /* tilkobling til database-serveren utført og valg av database foretatt */

          $sqlSetning="SELECT * FROM Klassekode WHERE Klassenavn='$Klassenavn';";
          $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");
          $antallRader=mysqli_num_rows($sqlResultat); 

          if ($antallRader!=0)  /* Klassekode er registrert fra før */
            {
              print ("Klassekode er registrert fra f&oslashr");
            }
          else
            {
              $sqlSetning="INSERT INTO Klassekode VALUES('$Klassekode','$Kalassenavn' 'Studiumkode');";
              mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; registrere data i databasen");
                /* SQL-setning sendt til database-serveren */

              print ("F&oslash;lgende poststed er n&aring; registrert: $Klassenavn $Klassekode $Studiumkode"); 
            }
        }
    }
?> 