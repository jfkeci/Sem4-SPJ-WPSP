<?php
include 'functions.php';
include 'connection.php';

$sModalID = "";
$studID = "";
$roomID = "";
$sDirectory = "";

if (isset($_GET['modal_id']))
{
    $sModalID = $_GET['modal_id'];
}
if (isset($_GET['reciept_number']))
{
    $brojRacuna = $_GET['reciept_number'];
}
if (isset($_GET['sid']))
{
    $studID = $_GET['sid'];
}

if (isset($_GET['room_id']))
{
    $roomID = $_GET['room_id'];
}
if (isset($_GET['img_dir']))
{
    $sDirectory = $_GET['img_dir'];
}

switch ($sModalID)
{
    case 'add_new_student':
        echo '<div class="modal-header" style="background-color:#00acac">
				<h4 class="modal-title" style="color:white"> Novi Student</h4>
			</div>			
			<div class="modal-body">
				<form class="form-horizontal">
				<div class="form-group">
						<div class="col-md-8">
							<input 	id="inptJmbag" data-parsley-required="true" type="text" placeholder="Jmbag" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-8">
							<input 	id="inptIme" data-parsley-required="true" type="text" placeholder="Ime" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-8">
							<input 	id="inptPrezime" data-parsley-required="true" type="text" placeholder="Prezime" class="form-control" >
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-8">
							<input 	id="inptUsername" data-parsley-required="true" type="text" placeholder="Korisničko ime" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-8">
							<input 	id="inptPassword" data-parsley-required="true" type="text" placeholder="Zaporka" class="form-control" >
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-8">
							<input 	id="inptAdresa" data-parsley-required="true" type="text" placeholder="Adresa" class="form-control" >
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-8">
							<input 	id="inptPB" data-parsley-required="true" type="text" placeholder="Poštanski broj" class="form-control" >
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-8">
							<input 	id="inptGrad" data-parsley-required="true" type="text" placeholder="Grad" class="form-control" >
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3">Smjer: </label>
						<div class="col-md-8">
						<select id="inptSmjer" class="form-control">
						  <option value="Menadžment - Informatički menadžment">Menadžment - Informatički menadžment</option>
						  <option value="Menadžment - Menadžment ruralnog turizma">Menadžment - Menadžment ruralnog turizma</option>
						  <option value="Poduzetništvo - Poduzetništvo">Poduzetništvo - Poduzetništvo</option>
						  <option value="Računalstvo - Programsko inženjerstvo">Računalstvo - Programsko inženjerstvo</option>
						  <option value="Elektrotehnika - Telekomunikacije i informatika">Elektrotehnika - Telekomunikacije i informatika</option>
						  <option value="Menadžment - Destinacijski menadžment">Menadžment - Destinacijski menadžment</option>
						  <option value="Menadžment - Menadžment malih i srenjih poduzeća">Menadžment - Menadžment malih i srenjih poduzeća</option>
						</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3">Godina studiranja: </label>
						<div class="col-md-8">
						<select id="inptGodina" class="form-control">
						  <option value="1">1</option>
						  <option value="2">2</option>
						  <option value="3">3</option>
						  <option value="4">4</option>
						  <option value="5">5</option>
						  <option value="6">6</option>
						</select>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-8">
							<input 	id="inptECTS" data-parsley-required="true" type="text" placeholder="ECTS" class="form-control" >
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-8">
							<input 	id="inptProsjek" data-parsley-required="true" type="text" placeholder="Prosjek" class="form-control" >
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success btn-s" onclick="SaveNewStudent()">Spremi</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Odustani</button>
			</div>';
	break;
	case 'show_student':
		$oStudenti=array();
		$sQuery = "SELECT * FROM student";
        $oRecord = $oConnection->query($sQuery);
        while ($oRow = $oRecord->fetch(PDO::FETCH_BOTH))
        {
            $oStudent = new Student($oRow['id'], $oRow['ime'], $oRow['prezime'], $oRow['jmbag'], $oRow['korisnicko_ime'], $oRow['zaporka'], $oRow['adresa'], $oRow['postanski_broj'], $oRow['grad'], $oRow['smjer'], $oRow['godina_studiranja'], $oRow['ostvareno_ects'], $oRow['prosjek_ocjena']);
            array_push($oStudenti, $oStudent);
		}
		$student=DajStudentaPoJMBAG($oStudenti, $studID);


		echo '<div class="modalStudent">
		<div class="modal-header" style="background-color:#00acac">
				<h4 class="modal-title" style="color:white">Student</h4>
			</div>			
			<div class="container-fluid">
			<table class="table table-hover">
				<h3>Podaci o studentu</h3>
				<thead>
				<tr>
					<th>Ime</th>
					<th>Prezime</th>
					<th>Jmbag</th>
					<th>Grad</th>
					<th>Adresa</th>
				</tr>
				</thead>
				<tbody>
				<tr>
				<td>' . $student->ime . '</td>
				<td>' . $student->prezime . '</td>
				<td>' . $student->jmbag . '</td>
				<td>' . $student->grad . '</td>
				<td>' . $student->adresa . '</td>
				</tr>
				</tbody>
			</table>
			<table class="table table-hover">
				<thead>
				<tr>
					<th>Smjer</th>
					<th>Godina</th>
					<th>ECTS</th>
					<th>Prosjek</th>
				</tr>
				</thead>
				<tbody>
				<tr>
				<td>' . $student->smjer . '</td>
				<td>' . $student->godina_studiranja . '</td>
				<td>' . $student->ostvareno_ects . '</td>
				<td>' . $student->prosjek_ocjena . '</td>
				</tr>
				</tbody>
			</table>
		  </div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">zatvori</button>
			</div></div>';
	break;
	
    case 'edit_student':
        $sQuery2 = "SELECT * FROM student WHERE id=" . $studID;
        $oRecord2 = $oConnection->query($sQuery2);

        while ($oRow = $oRecord2->fetch(PDO::FETCH_BOTH))
        {
            $oStudent = new Student($oRow['id'], $oRow['ime'], $oRow['prezime'], $oRow['jmbag'], $oRow['korisnicko_ime'], $oRow['zaporka'], $oRow['adresa'], $oRow['postanski_broj'], $oRow['grad'], $oRow['smjer'], $oRow['godina_studiranja'], $oRow['ostvareno_ects'], $oRow['prosjek_ocjena']);
        }
        echo '<div class="modal-header" style="background-color:#00acac">
		<h4 class="modal-title" style="color:white"> Ažuriraj Studenta</h4>
	</div>			
	<div class="modal-body">
		<form class="form-horizontal">
		<div class="form-group">
				<div class="col-md-8">
					<input 	disable id="inptJmbag" data-parsley-required="true" type="text" value="' . $oStudent->jmbag . '" class="form-control">
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-8">
					<input 	id="inptIme" data-parsley-required="true" type="text" value="' . $oStudent->ime . '" class="form-control">
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-8">
					<input 	id="inptPrezime" data-parsley-required="true" type="text" value="' . $oStudent->prezime . '" class="form-control" >
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-8">
					<input 	id="inptUsername" data-parsley-required="true" type="text" value="' . $oStudent->student_korisnicko_ime . '" class="form-control">
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-8">
					<input 	id="inptPassword" data-parsley-required="true" type="text" value="' . $oStudent->student_zaporka . '" class="form-control" >
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-8">
					<input 	id="inptAdresa" data-parsley-required="true" type="text" value="' . $oStudent->adresa . '" class="form-control" >
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-8">
					<input 	id="inptPB" data-parsley-required="true" type="text" value="' . $oStudent->postanski_broj . '" class="form-control" >
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-8">
					<input 	id="inptGrad" data-parsley-required="true" type="text" value="' . $oStudent->grad . '" class="form-control" >
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3">Smjer: </label>
				<div class="col-md-8">
				<select class="form-control" id="inptSmjer" value="' . $oStudent->smjer . '">
				  <option value="Menadžment - Informatički menadžment">Menadžment - Informatički menadžment</option>
				  <option value="Menadžment - Menadžment ruralnog turizma">Menadžment - Menadžment ruralnog turizma</option>
				  <option value="Poduzetništvo - Poduzetništvo">Poduzetništvo - Poduzetništvo</option>
				  <option value="Računalstvo - Programsko inženjerstvo">Računalstvo - Programsko inženjerstvo</option>
				  <option value="Elektrotehnika - Telekomunikacije i informatika">Elektrotehnika - Telekomunikacije i informatika</option>
				  <option value="Menadžment - Destinacijski menadžment">Menadžment - Destinacijski menadžment</option>
				  <option value="Menadžment - Menadžment malih i srenjih poduzeća">Menadžment - Menadžment malih i srenjih poduzeća</option>
				</select>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3">Godina studiranja: </label>
				<div class="col-md-8">
				<select class="form-control" id="inptGodina" value="' . $oStudent->godina_studiranja . '">
				  <option value="1">1</option>
				  <option value="2">2</option>
				  <option value="3">3</option>
				  <option value="4">4</option>
				  <option value="5">5</option>
				  <option value="6">6</option>
				</select>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-8">
					<input 	id="inptECTS" data-parsley-required="true" type="text" value="' . $oStudent->ostvareno_ects . '" class="form-control" >
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-8">
					<input 	id="inptProsjek" data-parsley-required="true" type="text" value="' . $oStudent->prosjek_ocjena . '" class="form-control" >
				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-success btn-s" onclick="EditStudent(' . $oStudent->osoba_id . ')">Spremi</button>
		<button type="button" class="btn btn-default" data-dismiss="modal">Odustani</button>
	</div>';
    break;
    case 'delete_student':
        echo '<div class="modal-header" style="background-color:#00acac">
				<h4 class="modal-title" style="color:white"> Obriši Studenta</h4>
			</div>	
			<div class="modal-body">
				<form class="form-horizontal">
				Jeste li sigurni da želite obrisati studenta?
			</div>		
			<div class="modal-footer">
				<button type="button" class="btn btn-success btn-s" onclick="DeleteStudent('.$studID.')">Obriši</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Odustani</button>
			</div>';
	break;
	case 'update_reciept':
        echo '<div class="modal-header" style="background-color:#00acac">
				<h4 class="modal-title" style="color:white">Racun: '.$brojRacuna.'</h4>
			</div>	
			<div class="modal-body">
				<form class="form-horizontal">
				Student je platio račun?
			</div>		
			<div class="modal-footer">
				<button type="button" class="btn btn-success btn-s" onclick="UpdateReciept('.$brojRacuna.')">Azuriraj</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Odustani</button>
			</div>';
	break;
	case 'issue_reciepts':
        echo '<div class="modal-header" style="background-color:#00acac">
				<h4 class="modal-title" style="color:white">Izdavanje računa</h4>
			</div>	
			<div class="modal-body">
				<form class="form-horizontal">
				Jeste li sigurni da zelite izdati račune?
			</div>		
			<div class="modal-footer">
				<button type="button" class="btn btn-success btn-s" onclick="IzdajRacune()">U redu</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Odustani</button>
			</div>';
    break;
    case 'show_room':

        $status = '';
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

        $sQuery = "SELECT * FROM soba WHERE soba_id=" . $roomID;
        $oRecord = $oConnection->query($sQuery);

        $sQuery1 = "SELECT * FROM soba_student WHERE soba_id=" . $roomID;
        $oRecord1 = $oConnection->query($sQuery1);

        $sQuery2 = "SELECT * FROM student";
        $oRecord2 = $oConnection->query($sQuery2);

        $sQuery3 = "SELECT * FROM administrator";
		$oRecord3 = $oConnection->query($sQuery3);
		
		$sQuery4 = "SELECT * FROM komentar WHERE soba_id=" . $roomID;
        $oRecord4 = $oConnection->query($sQuery4);

        while ($oRow = $oRecord->fetch(PDO::FETCH_BOTH))
        {
            $oSoba = new Soba($oRow['soba_id'], $oRow['broj_sobe'], $oRow['kat'], $oRow['tip_sobe'], $oRow['opis']);
            $status = $oRow['zauzeto'];
        }

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

		$oStudentiSoba=StudentiPoSobi($oPodaci, $oStudenti);

        if ($status == 0)
        {
            $tableString = '<div class="container-fluid"><h3>Soba je prazna</h3></div>';
		}
		
        if ($status == 1 || $status == 2)
        {
			foreach($oStudentiSoba as $stud){
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
        }

        $commentsTableString = '';
		$commentString='Komentari';
		$posted='';
        if ($commentStatus == 0)
        {
			$commentString='Nema Komentara';
        }
        
        if ($commentStatus == 1)
        {
			$posted='Objavljeno';
            foreach ($oKomentari as $komentar)
            {
				$sTitula = DajTituluOsobe($komentar->id_osobe);
				$oOsoba=DajOsobuPoID($oStudenti, $oAdministratori, $komentar->id_osobe);
                $commentsTableString .= '<tr>
						<td><b>' . $oOsoba->ime . '  ' .$oOsoba->prezime. ' - ' . $sTitula . '</b><br>' . $komentar->sadržaj_komentara . '</td>
						<td></td>
						<td>' . $komentar->datum_vrijeme_komentara . '</td>
						</tr>';
            }
        }
		$id=$_COOKIE["osoba"];
        $oPrijavljenaOsoba=DajOsobuPoID($oStudenti, $oAdministratori, $id);

		echo '
		<style>
		.tableKomentari {width:100%;}
		</style>
		<div class="modal-header" style="background-color:#00acac">
				<h4 class="modal-title" style="color:white"> Soba ' . $oSoba->broj_sobe . '</h4>
			</div>
			<div id="Container">
        		<center><p><span class="btnPrev btn btn-default glyphicon glyphicon-chevron-left"></span><span class="btnNext btn btn-default glyphicon glyphicon-chevron-right"></span></p></center>
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
					<th>'.$commentString.'</th>
					<th></th>
					<th>'.$posted.'</th>
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
				<input type="hidden" name="soba_id" value="'.$roomID.'"></input>
				<label for="komentarTextArea">Dodaj Komentar</label>
				<textarea name="sadrzaj" class="form-control" id="komentarTextArea" rows="3"></textarea>
				<input class="btn btn-success" role="button" type="submit" value="Dodaj Komentar">
			</div>
			</div>
			</form>
		  
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Zatvori</button>
			</div>
			
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
					"<td><b>' . $oPrijavljenaOsoba->ime . '  ' .$oPrijavljenaOsoba->prezime. ' - ' . DajTituluOsobe($oPrijavljenaOsoba->osoba_id) . '<br></b>"+newComment+"</td>"+
					"<td></td>"+
					"<td>' . DatumVrijeme(3) . '</td>"+
					"</tr>";
				$(".tableKomentari tbody").append(commentstring);
				$("#komentarTextArea").val("");
				}
			}
			</script>';
	break;
	case 'student_out_of_room':
        echo '<div class="modal-header" style="background-color:#00acac">
				<h4 class="modal-title" style="color:white"> Obriši Studenta</h4>
			</div>	
			<div class="modal-body">
				<form class="form-horizontal">
				Jeste li sigurni da želite studenta izbaciti iz sobe?
			</div>		
			<div class="modal-footer">
				<button type="button" class="btn btn-success btn-s" onclick="ExpelStudent(' . $studID . ')">Izbaci</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Odustani</button>
			</div>';
	break;
	case 'student_to_room':
		$oSobe=array();
		$oPodaci=array();
		$oSlobodneSobe=array();
		$tableString='';

		$sig=0;

		$sQuery = "SELECT * FROM soba";
		$oRecord = $oConnection->query($sQuery);

		$sQuery1 = "SELECT * FROM soba_student";
		$oRecord1=$oConnection->query($sQuery1);

		while($oRow1=$oRecord1->fetch(PDO::FETCH_BOTH))
		{	
			$oRoomData=new roomData(
				$oRow1['soba_id'],
				$oRow1['student_jmbag']
			);
			array_push($oPodaci,$oRoomData);		
		}
		while($oRow=$oRecord->fetch(PDO::FETCH_BOTH))
				{			
					$oSoba=new Soba(
						$oRow['soba_id'],
						$oRow['broj_sobe'],
						$oRow['kat'],
						$oRow['tip_sobe'],
						$oRow['opis']
					);
					$Dostupnost=ProvjeraDostupnosti($oRow['tip_sobe'], $oRow['zauzeto']);
					if($Dostupnost==true){
						array_push($oSobe,$oSoba);	
					}
				}
				foreach($oSobe as $soba){
					$tableString .= '<tr>
					<td>' . $soba->broj_sobe . '</td>
					<td>' . DajKat($soba->kat) . '</td>
					<td>' . $soba->tip_sobe . '</td>
					<td>' . $soba->opis . '</td>
					<td><button type="button" class="btn btn-success btn-s" onclick="StudentToRoom(' . $studID . ',' . $soba->soba_id . ')">Dodaj</button></td>
					</tr>';
				}

		echo '<div class="modal-header" style="background-color:#00acac">
				<h4 class="modal-title" style="color:white"> Stavi Studenta U Sobu</h4>
			</div>	
			<div class="modal-body">
				<form class="form-horizontal">
				Odaberite sobu u koju želite staviti studenta.
			</div>
			<div class="container-fluid">
			<table class="table table-hover">
			<h3>Sobe</h3>
			<form class="form-inline my-2 my-lg-0">
               <input style="margin-top:20px;" id="search" class="form-control mr-sm-2" type="text" placeholder="Traži">
            </form>
		   <thead>
			  <tr>
				 <th>Broj Sobe</th>
				 <th>Kat</th>
				 <th>Tip Sobe</th>
				 <th>Opis</th>
				 <th></th>
			  </tr>
		   </thead>
		   <tbody id="sobe">
		   '.$tableString.'
		   </tbody>
			</table>
			 </div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Odustani</button>
			</div>
			<script>
			$(document).ready(function() {
				$("#search").on("keyup", function() {
					var value = $(this).val().toLowerCase();
					$("#sobe tr").filter(function() {
					  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
					});
				});
			});
			</script>';
	break;
	case 'student_to_from_room':
		$oSobe=array();
		$oPodaci=array();
		$oSlobodneSobe=array();
		$tableString='';

		$sig=0;

		$sQuery = "SELECT * FROM soba";
		$oRecord = $oConnection->query($sQuery);

		$sQuery1 = "SELECT * FROM soba_student";
		$oRecord1=$oConnection->query($sQuery1);

		while($oRow1=$oRecord1->fetch(PDO::FETCH_BOTH))
		{	
			$oRoomData=new roomData(
				$oRow1['soba_id'],
				$oRow1['student_jmbag']
			);
			array_push($oPodaci,$oRoomData);		
		}
		while($oRow=$oRecord->fetch(PDO::FETCH_BOTH))
				{			
					$oSoba=new Soba(
						$oRow['soba_id'],
						$oRow['broj_sobe'],
						$oRow['kat'],
						$oRow['tip_sobe'],
						$oRow['opis']
					);
					$Dostupnost=ProvjeraDostupnosti($oRow['tip_sobe'], $oRow['zauzeto']);
					if($Dostupnost==true){
						array_push($oSobe,$oSoba);	
					}
				}
				foreach($oSobe as $soba){
					$tableString .= '<tr>
					<td>' . $soba->broj_sobe . '</td>
					<td>' . DajKat($soba->kat) . '</td>
					<td>' . $soba->tip_sobe . '</td>
					<td>' . $soba->opis . '</td>
					<td><button type="button" class="btn btn-success btn-s" onclick="StudentToFromRoom(' . $studID . ',' . $soba->soba_id . ')">Dodaj</button></td>
					</tr>';
				}

		echo '<div class="modal-header" style="background-color:#00acac">
				<h4 class="modal-title" style="color:white"> Stavi Studenta U Sobu</h4>
			</div>	
			<div class="modal-body">
				<form class="form-horizontal">
				Odaberite sobu u koju želite staviti studenta.
			</div>
			<div class="container-fluid">
			<table class="table table-hover">
			<h3>Sobe</h3>
			<form class="form-inline my-2 my-lg-0">
               <input style="margin-top:20px;" id="search" class="form-control mr-sm-2" type="text" placeholder="Traži">
            </form>
		   <thead>
			  <tr>
				 <th>Broj Sobe</th>
				 <th>Kat</th>
				 <th>Tip Sobe</th>
				 <th>Opis</th>
				 <th></th>
			  </tr>
		   </thead>
		   <tbody id="sobe">
		   '.$tableString.'
		   </tbody>
			</table>
			 </div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Odustani</button>
			</div><script>
			$(document).ready(function() {
				$("#search").on("keyup", function() {
					var value = $(this).val().toLowerCase();
					$("#sobe tr").filter(function() {
					  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
					});
				});
			});
			</script>';
	break;
	case 'show_students_room':
		$oSobe=array();
		$sQuery = "SELECT * FROM soba ORDER BY broj_sobe ASC";
        $oRecord = $oConnection->query($sQuery);

        while ($oRow = $oRecord->fetch(PDO::FETCH_BOTH))
        {
            $oSoba = new Soba($oRow['soba_id'], $oRow['broj_sobe'], $oRow['kat'], $oRow['tip_sobe'], $oRow['opis']);
            array_push($oSobe, $oSoba);
		}
		$soba=SobaPoID($oSobe, $roomID);


		echo '<div class="modalSoba">
		<div class="modal-header" style="background-color:#00acac">
				<h4 class="modal-title" style="color:white">Soba: '.$roomID.'</h4>
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
				<td>' . $soba->broj_sobe . '</td>
				<td>' . $soba->kat . '</td>
				<td>' . $soba->tip_sobe . '</td>
				<td>' . $soba->opis . '</td>
				</tr>
				</tbody>
			</table>
		  </div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Zatvori</button>
			</div></div>';
	break;
}
?>
