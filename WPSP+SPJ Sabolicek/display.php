<?php
include 'connection.php';
include 'functions.php';

$studID=$_COOKIE["osoba"];

$conn= mysqli_connect("localhost","root","","studom");

$oStudenti=array();
$sQuery = "SELECT * FROM student";
$oRecord = $oConnection->query($sQuery);

while ($oRow = $oRecord->fetch(PDO::FETCH_BOTH))
{
    $oStudent = new Student($oRow['id'], $oRow['ime'], $oRow['prezime'], $oRow['jmbag'], $oRow['korisnicko_ime'], $oRow['zaporka'], $oRow['adresa'], $oRow['postanski_broj'], $oRow['grad'], $oRow['smjer'], $oRow['godina_studiranja'], $oRow['ostvareno_ects'], $oRow['prosjek_ocjena']);
    array_push($oStudenti, $oStudent);
}
$jmbag=DajJmbagStudenta($oStudenti, $studID);

//$output = array();
$query = "SELECT * FROM racun WHERE placeno='DA' AND student=".$jmbag;
$result = mysqli_query($conn,$query);
	while ($row = mysqli_fetch_array($result)) {
		$output[]=$row;
	}
echo json_encode($output);
?>