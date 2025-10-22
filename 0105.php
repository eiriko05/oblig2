
<?php  /* vis-alle-Studenter */
/*
/*  Programmet skriver ut alle registrerte Studenter
*/
  include("db-tilkobling.php");  /* tilkobling til database-serveren utf�rt og valg av database foretatt */

  $sqlSetning="SELECT * FROM Student;";
  
  $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");
    /* SQL-setning sendt til database-serveren */
	
  $antallRader=mysqli_num_rows($sqlResultat);  /* antall rader i resultatet beregnet */

  print ("<h3>Registrerte Studenter</h3>");
  print ("<table border=1s>");  
  print ("<tr><th align=left>fornavn</th> <th align=left>etternavn</th> <th align=left>brukernavn</th> <th align=left>klassekode</th> </tr>"); 

  for ($r=1;$r<=$antallRader;$r++)
    {
      $rad=mysqli_fetch_array($sqlResultat);  /* ny rad hentet fra sp�rringsresultatet */
      $fornavn=$rad["fornavn"];        /* ELLER $Fornavn=$rad[0]; */
      $etternavn=$rad["etternavn"]; /* ELLER $Etternavn=$rad [1]; */
      $brukernavn=$rad[" brukernavn"];    /* ELLER $Brukernavn=$rad[2]; */
      $klassekode=$rad["klassekode"];      /*ELLER $Klassekode=$rad[3] */
      print ("<tr> <td> $fornavn </td> <td> $etternavn </td> <td> $brukernavn <td> $klassekode <td> </td> </tr>");
    }
  print ("</table>"); 
?>
