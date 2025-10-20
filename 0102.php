
<?php  /* vis-alle-Klasser */
/*
/*  Programmet skriver ut alle registrerte Klasser
*/
  include("db-tilkobling.php");  /* tilkobling til database-serveren utf�rt og valg av database foretatt */

  $sqlSetning="SELECT * FROM klassekode;";
  
  $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");
    /* SQL-setning sendt til database-serveren */
	
  $antallRader=mysqli_num_rows($sqlResultat);  /* antall rader i resultatet beregnet */

  print ("<h3>Registrerte Klasser</h3>");
  print ("<table border=1s>");  
  print ("<tr><th align=left>klassenavn</th> <th align=left>klassekode</th> <th align=left>studiumkode</th> </tr>"); 

  for ($r=1;$r<=$antallRader;$r++)
    {
      $rad=mysqli_fetch_array($sqlResultat);  /* ny rad hentet fra sp�rringsresultatet */
      $klassenavn=$rad["klassenavn"];        /* ELLER $Klassenavn=$rad[0]; */
      $klassekode=$rad["klassekode"];    /* ELLER $Klassekode=$rad[1]; */
      $studiumkode=$rad["studiumkode"]; /* ELLER $Studiumkode=$rad [2]; */

      print ("<tr> <td> $klassenavn </td> <td> $klassekode </td> <td> $ktudiumkode </td> </tr>");
    }
  print ("</table>"); 
?>
