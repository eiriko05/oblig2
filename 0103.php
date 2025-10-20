
<?php  /* slett-poststed */
/*
/*  Programmet lager et skjema for å velge et poststed som skal slettes  
/*  Programmet sletter det valgte poststedet
*/
?> 

<script src="funksjoner.js"> </script>

<h3>Slett Klassenavn</h3>

<form method="post" action="" id="slettklassekodeSkjema" name="slettklassekodeSkjema" onSubmit="return bekreft()">
  Klassenavn <input type="text" id="klassekode" name="klassekode" required /> <br/>
  <input type="submit" value="Slett klassenavn" name="slettklassenavnKnapp" id="slettklassenavnKnapp" /> 
</form>

<?php
  if (isset($_POST ["slettKlasseKnapp"]))
    {	
      $Klassenavn=$_POST ["klassenavn"];
	  
	  if (!$Klassenavn)
        {
          print ("klassenavn m&aring; fylles ut");
        }
      else
        {
          include("db-tilkobling.php");  /* tilkobling til database-serveren utført og valg av database foretatt */

          $sqlSetning="SELECT * FROM klassenavn WHERE klassekode='$klassenavn';";
          $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");
          $antallRader=mysqli_num_rows($sqlResultat); 

          if ($antallRader==0)  /* Klassekode er ikke registrert */
            {
              print ("klassenavn finnes ikke");
            }
          else
            {	  
              $sqlSetning="DELETE FROM klassenavn WHERE klassekode='$klassenavn';";
              mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; slette data i databasen");
                /* SQL-setning sendt til database-serveren */
		
              print ("F&oslash;lgende Klasse er n&aring; slettet: $klassenavn <br />");
            }
        }
    }
?> 
