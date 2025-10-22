
<?php  /* slett-Klasse */
/*
/*  Programmet lager et skjema for å velge en Klasse som skal slettes  
/*  Programmet sletter den valgte Klassen
*/
?> 

<script src="funksjoner.js"> </script>

<h3>Slett Klasse</h3>

<form method="post" action="" id="slettklassekodeSkjema" name="slettklassekodeSkjema" onSubmit="return bekreft()">
  Klasse <input type="text" id="klassekode" name="klassekode" required /> <br/>
  <input type="submit" value="Slett Klasse" name="slettKlasseKnapp" id="slettKlasseKnapp" /> 
</form>

<?php
  if (isset($_POST ["slettKlasseKnapp"]))
    {	
      $Klassenavn=$_POST ["Klasse"];
	  
	  if (!$Klassenavn)
        {
          print ("Klasse m&aring; fylles ut");
        }
      else
        {
          include("db-tilkobling.php");  /* tilkobling til database-serveren utført og valg av database foretatt */

          $sqlSetning="SELECT * FROM Klasse WHERE klassekode='$klassenavn';";
          $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");
          $antallRader=mysqli_num_rows($sqlResultat); 

          if ($antallRader==0)  /* Klassekode er ikke registrert */
            {
              print ("Klasse finnes ikke");
            }
          else
            {	  
              $sqlSetning="DELETE FROM Klasse WHERE klassenavn='$klassenavn';";
              mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; slette data i databasen");
                /* SQL-setning sendt til database-serveren */
		
              print ("F&oslash;lgende Klasse er n&aring; slettet: $Klasse <br />");
            }
        }
    }
?> 
