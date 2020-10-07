<?php
include 'connection.php';
include 'functions.php';

if(!isset($_COOKIE["osoba"]))
{
 header("location:login.php");
}

$commentStatus = '';

$tableString = '<div class="container-fluid">
   		<table class="table table-hover">
   		<h3>Student</h3>
   		<thead>
   			<tr>
   				<th>Ime</th>
   				<th>Prezime</th>
   				<th>Smjer</th>
   				<th>Godina Studiranja</th>
   			</tr>
   		</thead>
   		<tbody>';

$oKomentari = array();
$oStudenti = array();
$oAdministratori = array();
$oPodaci = array();
$oPodaciSoba = array();
$studentID = $_COOKIE["osoba"];

$sQuery1 = "SELECT * FROM soba_student";
$oRecord1 = $oConnection->query($sQuery1);

$sQuery2 = "SELECT * FROM student";
$oRecord2 = $oConnection->query($sQuery2);

$sQuery3 = "SELECT * FROM administrator";
$oRecord3 = $oConnection->query($sQuery3);

while ($oRow1 = $oRecord1->fetch(PDO::FETCH_BOTH))
{
    $oRoomData = new roomData($oRow1['soba_id'], $oRow1['student_jmbag']);
    array_push($oPodaci, $oRoomData);
}

while ($oRow2 = $oRecord2->fetch(PDO::FETCH_BOTH))
{
    $oStudent = new Student($oRow2['id'], $oRow2['ime'], $oRow2['prezime'], $oRow2['jmbag'], $oRow2['korisnicko_ime'], $oRow2['zaporka'], $oRow2['adresa'], $oRow2['postanski_broj'], $oRow2['grad'], $oRow2['smjer'], $oRow2['godina_studiranja'], $oRow2['ostvareno_ects'], $oRow2['prosjek_ocjena']);
    array_push($oStudenti, $oStudent);
}

while ($oRow3 = $oRecord3->fetch(PDO::FETCH_BOTH))
{
    $oAdmin = new Administrator($oRow3['admin_id'], $oRow3['ime'], $oRow3['prezime'], $oRow3['username'], $oRow3['password']);
    array_push($oAdministratori, $oAdmin);
}

$oPrijavljeniStudent = DajStudentaPoID($oStudenti, $studentID);
$roomID = StudentPoSobi($oPodaci, $oPrijavljeniStudent);

foreach ($oPodaci as $podatak)
{
    if ($podatak->soba == $roomID)
    {
        array_push($oPodaciSoba, $podatak);
    }
}

$oStudentiSoba = StudentiPoSobi($oPodaciSoba, $oStudenti);
$hasRoom = ProvjeraSobe($oStudenti, $oPodaciSoba, $oPrijavljeniStudent->osoba_id);

if ($hasRoom == true)
{

    $sQuery = "SELECT * FROM soba WHERE soba_id=" . $roomID;
    $oRecord = $oConnection->query($sQuery);

    $sQuery4 = "SELECT * FROM komentar WHERE soba_id=" . $roomID;
    $oRecord4 = $oConnection->query($sQuery4);

    while ($oRow = $oRecord->fetch(PDO::FETCH_BOTH))
    {
        $oSoba = new Soba($oRow['soba_id'], $oRow['broj_sobe'], $oRow['kat'], $oRow['tip_sobe'], $oRow['opis']);
    }
    while ($oRow4 = $oRecord4->fetch(PDO::FETCH_BOTH))
    {
        $hasComments = true;
        if ($hasComments)
        {
            $oKomentar = new Komentar($oRow4['komentar_id'], $oRow4['osoba_id'], $oRow4['titula'], $oRow4['soba_id'], $oRow4['datum_vrijeme'], $oRow4['sadrzaj']);
            array_push($oKomentari, $oKomentar);
            $commentStatus = 1;
        }
    }
    $sDirectory = GetDirectory($oSoba->tip_sobe, $oSoba->opis);

    foreach ($oStudentiSoba as $stud)
    {
        $tableString .= '<tr>
   						<td>' . $stud->ime . '</td>
   						<td>' . $stud->prezime . '</td>
   						<td>' . $stud->smjer . '</td>
   						<td>' . $stud->godina_studiranja . '</td>
   						</tr>';
    }
    $tableString .= '</tbody>
   			</table>
   			</div>';

    $commentsTableString = '';
    $commentString = 'Komentari';
    $posted = '';
    if ($commentStatus == 0)
    {
        $commentString = 'Nema Komentara';
    }

    if ($commentStatus == 1)
    {
        $posted = 'Objavljeno';
        foreach ($oKomentari as $komentar)
        {
            $sTitula = DajTituluOsobe($komentar->id_osobe);
            $oOsoba = DajOsobuPoID($oStudenti, $oAdministratori, $komentar->id_osobe);
            $commentsTableString .= '<tr>
   						<td><b>' . $oOsoba->ime . '  ' . $oOsoba->prezime . ' - ' . $sTitula . '</b><br>' . $komentar->sadržaj_komentara . '</td>
   						<td></td>
   						<td>' . $komentar->datum_vrijeme_komentara . '</td>
   						</tr>';
        }
    }
    $id = $_COOKIE["osoba"];
    $oPrijavljenaOsoba = DajOsobuPoID($oStudenti, $oAdministratori, $id);

    echo '<!DOCTYPE html>
<html>
   <head>
      <title>Studom</title>
      <meta charset="utf‐8">
      <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <link rel="stylesheet" type="text/css" href="css/sobe.css">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
         <a class="navbar-brand" href="index.php">Studom VSMTI</a>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                  <a class="nav-link" href="sobe.php">Sobe</a>
               </li>
               <li class="nav-item active">
                  <a class="nav-link" href="studentSoba.php">Vaša Soba</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="racuni.php">Racuni</a>
               </li>
               <li class="nav-item">
                  <a class="btn btn-outline-success my-2 my-sm-0" href="odjava.php">Odjava</a>
               </li>
            </ul>
         </div>
      </nav>
      <div class="jumbotron">
         <h1>
            <center>STUDOM</center>
         </h1>
      </div>
   </head>
   <body>
      <div class="container">
         <div  class="container">
            <h4> Soba ' . $oSoba->broj_sobe . '</h4>
         </div>
         <div id="Container">
            <center>
               <p><span class="btnPrev btn btn-default glyphicon glyphicon-chevron-left"></span><span class="btnNext btn btn-default glyphicon glyphicon-chevron-right"></span></p>
            </center>
         </div>
         <div id="sliderContainer">
            <img class="slika" src="img/' . $sDirectory . '/slika1.jpg" width="100%">
         </div>
         <div class="container-fluid">
            <table class="table table-hover">
               <h3>Podaci o sobi</h3>
               <thead>
                  <tr>
                     <th>Broj Sobe</th>
                     <th>Kat</th>
                     <th>Tip Sobe</th>
                     <th>Opis</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td>' . $oSoba->broj_sobe . '</td>
                     <td>' . DajKat($oSoba->kat) . '</td>
                     <td>' . $oSoba->tip_sobe . '</td>
                     <td>' . $oSoba->opis . '</td>
                  </tr>
               </tbody>
            </table>
         </div>
         ' . $tableString . '
         <div class="container-fluid">
            <table class="tableKomentari table-hover">
               <thead>
                  <tr>
                     <th>' . $commentString . '</th>
                     <th></th>
                     <th>' . $posted . '</th>
                  </tr>
               </thead>
               <tbody>
                  ' . $commentsTableString . '
               </tbody>
            </table>
         </div>
         <form class="comments" onsubmit="SaveNewComment();AppendNewComment();return false">
            <div class="container-fluid">
               <br>
               <div class="form-group">
                  <input type="hidden" name="soba_id" value="' . $roomID . '"></input>
                  <label for="komentarTextArea">Dodaj Komentar</label>
                  <textarea name="sadrzaj" class="form-control" id="komentarTextArea" rows="3"></textarea>
                  <input class="btn btn-success" role="button" type="submit" value="Dodaj Komentar">
               </div>
            </div>
         </form>
         <script>
            var image = $(".slika");
            var aSlike = ["img/' . $sDirectory . '/slika1.jpg", "img/' . $sDirectory . '/slika2.jpg", "img/' . $sDirectory . '/slika3.jpg", "img/' . $sDirectory . '/kupaona.jpg", "img/' . $sDirectory . '/nacrt.jpg"];
            $( document ).ready(function() {
            	var next = "";
            	var prev = "";
            	var index=0;
            	
            $(".btnNext").click(function(){
            	index+=1;
            	if(index==aSlike.length){
            		index=0;
            	}
            	showSlide(index);
            });
            
            $(".btnPrev").click(function(){
            	index-=1;
            	if(index==-1){
            		index=aSlike.length-1;
            	}
            	showSlide(index);
            });
            });
            function showSlide(n){
            	image.attr("src", aSlike[n]);
            }
            
            function AppendNewComment(){
            	var newComment=$("#komentarTextArea").val();
            	if($("#komentarTextArea").val()==""){
            
            	}
            	else{
            		var commentstring="<tr>"+
            		"<td><b>' . $oPrijavljenaOsoba->ime . '  ' . $oPrijavljenaOsoba->prezime . ' - ' . DajTituluOsobe($oPrijavljenaOsoba->osoba_id) . '<br></b>"+newComment+"</td>"+
            		"<td></td>"+
            		"<td>' . DatumVrijeme(2) . '</td>"+
            		"</tr>";
            	$(".tableKomentari tbody").append(commentstring);
            	$("#komentarTextArea").val("");
            	}
            }
         </script>
         <script src="js/globals.js"></script>
         <script src="js/sobe.js"></script>
      </div>
   </body>
</html>';
}
else
{
    echo '<!DOCTYPE html>
<html>
   <head>
      <title>Studom</title>
      <meta charset="utf‐8">
      <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <link rel="stylesheet" type="text/css" href="css/sobe.css">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
         <a class="navbar-brand" href="index.php">Studom VSMTI</a>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
               <li class="nav-item active">
                  <a class="nav-link" href="studentSoba.php">Vaša Soba</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="racuni.php">Racuni</a>
               </li>
               <li class="nav-item">
                  <a class="btn btn-outline-success my-2 my-sm-0" href="odjava.php">Odjava</a>
               </li>
            </ul>
         </div>
      </nav>
      <div class="jumbotron">
         <h1>
            <center>STUDOM</center>
         </h1>
         <center><h3>Jos vam nije dodjeljena soba</h3></center>
      </div>
   </head>
   <body>

</body>
</html>';
}
?>
