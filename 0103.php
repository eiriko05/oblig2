
<?php  /* slett-poststed */
/*
/*  Programmet lager et skjema for å velge et poststed som skal slettes  
/*  Programmet sletter det valgte poststedet
*/
?> 

<script src="funksjoner.js"> </script>

<h3>Slett Klassekode</h3>

<form method="post" action="" id="slettKlassekodeSkjema" name="slettKlassekodeSkjema" onSubmit="return bekreft()">
  Klassenavn <input type="text" id="Klassenavn" name="Klassenavn" required /> <br/>
  <input type="submit" value="Slett Klassekode" name="slettKlassekodeKnapp" id="slettKlassekodeKnapp" /> 
</form>

<?php
  if (isset($_POST ["slettKlassekodeKnapp"]))
    {	
      $postnr=$_POST ["Klassenavn"];
	  
	  if (!$Klassenavn)
        {
          print ("Klassenavn m&aring; fylles ut");
        }
      else
        {
          include("db-tilkobling.php");  /* tilkobling til database-serveren utført og valg av database foretatt */

          $sqlSetning="SELECT * FROM Klassekode WHERE Klassenavn='$Klassenavn';";
          $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");
          $antallRader=mysqli_num_rows($sqlResultat); 

          if ($antallRader==0)  /* Klassekode er ikke registrert */
            {
              print ("Klassekode finnes ikke");
            }
          else
            {	  
              $sqlSetning="DELETE FROM Klassekode WHERE Klassenavn='$Klassenavn';";
              mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; slette data i databasen");
                /* SQL-setning sendt til database-serveren */
		
              print ("F&oslash;lgende Klassekode er n&aring; slettet: $Klassenavn <br />");
            }
        }
    }
?> 
