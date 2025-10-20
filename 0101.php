<?php  /* registrer-Klasse */
/*
/*  Programmet lager et html-skjema for å registrere en Klassekode
/*  Programmet registrerer data (Klassenavn Klassekode og Studiumkode) i databasen
*/
?> 

<h3>Registrer klasse </h3>

<form method="post" action="" id="registrerKlasseSkjema" name="registrerKlasseSkjema">
  Klassenavn <input type="text" id="klassenavn" name="klassenavn" required /> <br/>
  Studiumkode <input type="text" id="studiumkode" name="studiumkode" required/> <br/>
  Klassekode <input type="text" id="klassekode" name="klassekode" required /> <br/>
  <input type="submit" value="Registrer Klasse" id="registrerKlasseKnapp" name="registrerKlasseKnapp" /> 
  <input type="reset" value="Nullstill" id="nullstill" name="nullstill" /> <br />
</form>

<?php 
  if (isset($_POST ["registrerKlasseKnapp"]))
    {
      $klassenavn=$_POST ["klassenavn"];
      $studiumkode=$_POST ["studiumkode"];
      $klassekode=$_POST ["klassekode"];

      if (!$klassekode || !$klassenavn || !$studiumkode)
        {
          print ("B&aring;de klassekode  klassenavn og studiumkode m&aring; fylles ut");
        }
      else
        {
          include("db-tilkobling.php");  /* tilkobling til database-serveren utført og valg av database foretatt */

          $sqlSetning="SELECT * FROM Klasse WHERE klassekode='$klassenavn';";
          $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");
          $antallRader=mysqli_num_rows($sqlResultat); 

          if ($antallRader!=0)  /* Klasse er registrert fra før */
            {
              print ("klassekode er registrert fra f&oslashr");
            }
          else
            {
              $sqlSetning="INSERT INTO Klasse VALUES('$klassenavn','$studiumkode','$klassekode');";
              mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; registrere data i databasen");
                /* SQL-setning sendt til database-serveren */

              print ("F&oslash;lgende Klasse er n&aring; registrert: $klassenavn $studiumkode $klassekode"); 
            }
        }
    }
?> 