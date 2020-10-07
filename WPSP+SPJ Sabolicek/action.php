<?php
include "connection.php";
include "functions.php";


$sActionID="";
if(isset($_POST['action_id']))
{
	$sActionID=$_POST['action_id'];
}
if(isset($_POST['action_id']))
{
	$sActionID=$_POST['action_id'];
}

switch ($sActionID) 
{
	case 'add_new_student':
		$sQuery = "INSERT INTO student (ime, prezime, jmbag, korisnicko_ime, zaporka, adresa, postanski_broj, grad, smjer, godina_studiranja, ostvareno_ects, prosjek_ocjena) VALUES (:ime, :prezime, :jmbag, :korisnicko_ime, :zaporka, :adresa, :postanski_broj, :grad, :smjer, :godina_studiranja, :ostvareno_ects, :prosjek_ocjena)";
		$oStatement = $oConnection->prepare($sQuery);
		$oData = array(
		 'ime' => $_POST['ime'],
		 'prezime' => $_POST['prezime'],
		 'jmbag' => $_POST['jmbag'],
		 'korisnicko_ime' => $_POST['korisnicko_ime'],
		 'zaporka' => $_POST['zaporka'],
		 'adresa' => $_POST['adresa'],
		 'postanski_broj' => $_POST['postanski_broj'],
		 'grad' => $_POST['grad'],
		 'smjer' => $_POST['smjer'],
		 'godina_studiranja' => $_POST['godina_studiranja'],
		 'ostvareno_ects' => $_POST['ostvareno_ects'],
		 'prosjek_ocjena' => $_POST['prosjek_ocjena']
		);
		try
		{
			$oStatement=$oConnection->prepare($sQuery);
			$oStatement->execute($oData);
		}
		catch(PDOException $error)
		{
			echo $error;
		}
	break;
	case 'delete_student':
		$sQuery = "DELETE FROM student WHERE id=:id";
		$oStatement=$oConnection->prepare($sQuery);
		$oData = array(
		 'id'=>$_POST['id']
		);
		$oStatement->execute($oData);
	break;
	case 'edit_student':
		$sQuery = "UPDATE student SET id=:id, ime=:ime, prezime=:prezime, jmbag=:jmbag, korisnicko_ime=:korisnicko_ime, zaporka=:zaporka, adresa=:adresa, postanski_broj=:postanski_broj, grad=:grad, smjer=:smjer, godina_studiranja=:godina_studiranja, ostvareno_ects=:ostvareno_ects, prosjek_ocjena=:prosjek_ocjena WHERE id=:id";
		$oStatement = $oConnection->prepare($sQuery);
		$oData = array(
			'id' => $_POST['id'],
			'ime' => $_POST['ime'],
			'prezime' => $_POST['prezime'],
			'jmbag' => $_POST['jmbag'],
			'korisnicko_ime' => $_POST['korisnicko_ime'],
			'zaporka' => $_POST['zaporka'],
			'adresa' => $_POST['adresa'],
			'postanski_broj' => $_POST['postanski_broj'],
			'grad' => $_POST['grad'],
			'smjer' => $_POST['smjer'],
			'godina_studiranja' => $_POST['godina_studiranja'],
			'ostvareno_ects' => $_POST['ostvareno_ects'],
			'prosjek_ocjena' => $_POST['prosjek_ocjena']
		);
		$oStatement->execute($oData);
	break;
	case 'update_reciept':
		$sQuery = "UPDATE racun SET placeno=:placeno WHERE broj_racuna=:broj_racuna";
		$oStatement = $oConnection->prepare($sQuery);
		$oData = array(
			'placeno' => $_POST['placeno'],
			'broj_racuna' => $_POST['broj_racuna'],
		);
		$oStatement->execute($oData);
	break;
	case 'save_new_comment':
		$sQuery = "INSERT INTO komentar (osoba_id, titula, soba_id, sadrzaj) VALUES (:osoba_id, :titula, :soba_id, :sadrzaj)";
		$oStatement = $oConnection->prepare($sQuery);
		$oData = array(
		 'osoba_id' => $_COOKIE["osoba"],
		 'titula' => DajTituluPoID($_COOKIE["osoba"]),
		 'soba_id' => $_POST['soba_id'],
		 'sadrzaj' => $_POST['sadrzaj']
		);
		try
		{
			$oStatement=$oConnection->prepare($sQuery);
			$oStatement->execute($oData);
		}
		catch(PDOException $error)
		{
			echo $error;
		}
		
	break;
	case 'remove_from_room':
		$oPodaci=array();
		$oSobe=array();
		$studJmbag=$_POST['student_jmbag'];
		$sQuery2 = "SELECT * FROM soba_student";
        $oRecord2 = $oConnection->query($sQuery2);

        while ($oRow2 = $oRecord2->fetch(PDO::FETCH_BOTH))
        {
            $oRoomData = new roomData($oRow2['soba_id'], $oRow2['student_jmbag']);
            array_push($oPodaci, $oRoomData);
        }
		$roomID=DajRoomIdPoStudentu($oPodaci, $studJmbag);
		$zauzece=0;
		$sQuery1="SELECT * FROM soba WHERE soba_id=".$roomID;
		$oRecord1=$oConnection->query($sQuery1);
		while ($oRow1 = $oRecord1->fetch(PDO::FETCH_BOTH))
		{
			$zauzece=$oRow1['zauzeto'];
		}

		$zauzece-=1;

		$sQuery = "DELETE FROM soba_student WHERE student_jmbag=:student_jmbag";
		$oData = array(
		 'student_jmbag'=>$_POST['student_jmbag']
		);
		try
		{
			$oStatement=$oConnection->prepare($sQuery);
			$oStatement->execute($oData);
		}
		catch(PDOException $error)
		{
			echo $error;
		}
		$sQuery3 = "UPDATE soba SET zauzeto=:zauzeto WHERE soba_id=".$roomID;
		$oStatement3 = $oConnection->prepare($sQuery2);
		$oData3 = array(
			'zauzeto' => $zauzece
		);
		$oStatement2->execute($oData3);
	break;
	case 'student_to_room':
		$sQuery = "INSERT INTO soba_student (soba_id, student_jmbag) VALUES (:soba_id, :student_jmbag)";
		$oStatement = $oConnection->prepare($sQuery);
		$oData = array(
			'soba_id' => $_POST['soba_id'],
		 	'student_jmbag' => $_POST['student_jmbag']
		);
		try
		{
			$oStatement=$oConnection->prepare($sQuery);
			$oStatement->execute($oData);
		}
		catch(PDOException $error)
		{
			echo $error;
		}
		$roomID=$_POST['soba_id'];
		$zauzece='';
		$sQuery1="SELECT * FROM soba WHERE soba_id=".$roomID;
		$oRecord1=$oConnection->query($sQuery1);
		while ($oRow1 = $oRecord1->fetch(PDO::FETCH_BOTH))
		{
			$zauzece=$oRow1['zauzeto'];
		}
		$zauzece+=1;
		$sQuery2 = "UPDATE soba SET zauzeto=:zauzeto WHERE soba_id=".$roomID;
		$oStatement2 = $oConnection->prepare($sQuery2);
		$oData1 = array(
			'zauzeto' => $zauzece
		);
		$oStatement2->execute($oData1);
	break;
	case 'student_to_from_room':
		$roomFromID='';
		$sQuery3 = "SELECT * FROM soba_student WHERE student_jmbag=".$_POST['student_jmbag'];
		$oRecord3 = $oConnection->query($sQuery3);
		while ($oRow3 = $oRecord3->fetch(PDO::FETCH_BOTH))
        {
           $roomFromID=$oRow3['soba_id'];
		}
		$sQuery4="SELECT * FROM soba WHERE soba_id=".$roomFromID;
		$oRecord4=$oConnection->query($sQuery4);
		$zauzece1='';
		while ($oRow4 = $oRecord4->fetch(PDO::FETCH_BOTH))
		{
			$zauzece1=$oRow4['zauzeto'];
		}
		$zauzece1-=1;
		$sQuery5 = "UPDATE soba SET zauzeto=:zauzeto WHERE soba_id=".$roomFromID;
		$oStatement5 = $oConnection->prepare($sQuery5);
		$oData5 = array(
			'zauzeto' => $zauzece1
		);
		$oStatement5->execute($oData5);

		$sQuery = "UPDATE soba_student SET soba_id=:soba_id WHERE student_jmbag=:student_jmbag";
		$oStatement = $oConnection->prepare($sQuery);
		$oData = array(
			'soba_id' => $_POST['soba_id'],
		 	'student_jmbag' => $_POST['student_jmbag']
		);
		try
		{
			$oStatement=$oConnection->prepare($sQuery);
			$oStatement->execute($oData);
		}
		catch(PDOException $error)
		{
			echo $error;
		}
		$roomID=$_POST['soba_id'];
		$zauzece='';
		$sQuery1="SELECT * FROM soba WHERE soba_id=".$roomID;
		$oRecord1=$oConnection->query($sQuery1);
		while ($oRow1 = $oRecord1->fetch(PDO::FETCH_BOTH))
		{
			$zauzece=$oRow1['zauzeto'];
		}
		$zauzece+=1;
		$sQuery2 = "UPDATE soba SET zauzeto=:zauzeto WHERE soba_id=".$roomID;
		$oStatement2 = $oConnection->prepare($sQuery2);
		$oData1 = array(
			'zauzeto' => $zauzece
		);
		$oStatement2->execute($oData1);
	break;
	case 'issue_reciepts':
		$sQuery = "INSERT INTO racun (soba_id, student) SELECT soba_id, student_jmbag FROM soba_student";
		$oStatement = $oConnection->prepare($sQuery);
		try
		{
			$oStatement=$oConnection->prepare($sQuery);
			$oStatement->execute($oData);
		}
		catch(PDOException $error)
		{
			echo $error;
		}
	break;
}



?>