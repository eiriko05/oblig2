
<?php  /* vis-alle-Klasser */
/*
/*  Programmet skriver ut alle registrerte Klasser
*/
  include("db-tilkobling.php");  /* tilkobling til database-serveren utf�rt og valg av database foretatt */

  $sqlSetning="SELECT * FROM Klassekode;";
  
  $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");
    /* SQL-setning sendt til database-serveren */
	
  $antallRader=mysqli_num_rows($sqlResultat);  /* antall rader i resultatet beregnet */

  print ("<h3>Registrerte Klassekode</h3>");
  print ("<table border=1s>");  
  print ("<tr><th align=left>Klassenavn</th> <th align=left>Klassekode</th> <th align=left>Studiumkode</th> </tr>"); 

  for ($r=1;$r<=$antallRader;$r++)
    {
      $rad=mysqli_fetch_array($sqlResultat);  /* ny rad hentet fra sp�rringsresultatet */
      $Klassenavn=$rad["klassenavn"];        /* ELLER $Klassenavn=$rad[0]; */
      $Klassekode=$rad["klassekode"];    /* ELLER $Klassekode=$rad[1]; */
      $Studiumkode=$rad["studiumkode"]; /* ELLER  $Studiumkode=$rad [2]; */

      print ("<tr> <td> $Klassenavn </td> <td> $Klassekode </td> </td>$Studiumkode </td> </tr>");
    }
  print ("</table>"); 
?>
