<?php
header('Content-type: text/html');
//header('Content-type: application/json; charset=utf-8');
/* trebal bi nekak u student atribut objekta računa spremit
ime i prezime studenta tak da napravim nekakvu varijablu koja 
appenda prezime imenu i tu varijablu spremim pod studenta */

include "functions.php";
include "connection.php";

$sJsonID = "";
$oJson = array();

$student_id = "";
$roomFloor = "";

if (isset($_GET['json_id']))
{
    $sJsonID = $_GET['json_id'];
}
if (isset($_GET['student_id']))
{
    $student_id = $_GET['student_id'];
}
if (isset($_GET['room_floor']))
{
    $roomFloor = $_GET['room_floor'];
}

switch ($sJsonID)
{
    case 'get_all_students':
        $sQuery = "SELECT * FROM student";
        $oRecord = $oConnection->query($sQuery);

        while ($oRow = $oRecord->fetch(PDO::FETCH_BOTH))
        {
            $oStudent = new Student($oRow['id'], $oRow['ime'], $oRow['prezime'], $oRow['jmbag'], $oRow['korisnicko_ime'], $oRow['zaporka'], $oRow['adresa'], $oRow['postanski_broj'], $oRow['grad'], $oRow['smjer'], $oRow['godina_studiranja'], $oRow['ostvareno_ects'], $oRow['prosjek_ocjena']);
            array_push($oJson, $oStudent);
        }
    break;
    case 'get_rooms_by_floor':
        if ($roomFloor == 4)
        {
            $sQuery = "SELECT * FROM soba ORDER BY broj_sobe ASC";
        }
        else
        {
            $sQuery = "SELECT * FROM soba WHERE kat=" . $roomFloor;
        }
        $oRecord = $oConnection->query($sQuery);

        while ($oRow = $oRecord->fetch(PDO::FETCH_BOTH))
        {
            $oSoba = new Soba($oRow['soba_id'], $oRow['broj_sobe'], $oRow['kat'], $oRow['tip_sobe'], $oRow['opis']);
            array_push($oJson, $oSoba);
        }
    break;
    case 'get_all_rooms':
        $sQuery = "SELECT * FROM soba ORDER BY broj_sobe ASC";
        $oRecord = $oConnection->query($sQuery);

        while ($oRow = $oRecord->fetch(PDO::FETCH_BOTH))
        {
            $oSoba = new Soba($oRow['soba_id'], $oRow['broj_sobe'], $oRow['kat'], $oRow['tip_sobe'], $oRow['opis']);
            array_push($oJson, $oSoba);
        }
    break;
    case 'get_room_data':
        $sQuery = "SELECT * FROM soba_student";
        $oRecord = $oConnection->query($sQuery);

        while ($oRow = $oRecord->fetch(PDO::FETCH_BOTH))
        {
            $oRoomData = new roomData($oRow['soba_id'], $oRow['student_jmbag']);
            array_push($oJson, $oRoomData);
        }
    break;

    case 'get_student_by_id':
        $sQuery = "SELECT * FROM student WHERE id=" . $student_id;
        $oRecord = $oConnection->query($sQuery);

        while ($oRow = $oRecord->fetch(PDO::FETCH_BOTH))
        {
            $oStudent = new Student($oRow['id'], $oRow['ime'], $oRow['prezime'], $oRow['jmbag'], $oRow['korisnicko_ime'], $oRow['zaporka'], $oRow['adresa'], $oRow['postanski_broj'], $oRow['grad'], $oRow['smjer'], $oRow['godina_studiranja'], $oRow['ostvareno_ects'], $oRow['prosjek_ocjena']);
            array_push($oJson, $oStudent);
        }
    break;
    case 'get_students_with_room':
        $oStudenti = array();
        $oPodaci = array();
        $sQuery = "SELECT * FROM student";
        $oRecord = $oConnection->query($sQuery);
        $sQuery1 = "SELECT * FROM soba_student";
        $oRecord1 = $oConnection->query($sQuery1);

        while ($oRow = $oRecord->fetch(PDO::FETCH_BOTH))
        {
            $oStudent = new Student($oRow['id'], $oRow['ime'], $oRow['prezime'], $oRow['jmbag'], $oRow['korisnicko_ime'], $oRow['zaporka'], $oRow['adresa'], $oRow['postanski_broj'], $oRow['grad'], $oRow['smjer'], $oRow['godina_studiranja'], $oRow['ostvareno_ects'], $oRow['prosjek_ocjena']);
            array_push($oStudenti, $oStudent);
        }
        while ($oRow1 = $oRecord1->fetch(PDO::FETCH_BOTH))
        {
            $oRoomData = new roomData($oRow1['soba_id'], $oRow1['student_jmbag']);
            array_push($oPodaci, $oRoomData);
        }
        foreach ($oPodaci as $podatak)
        {
            foreach ($oStudenti as $stud)
            {
                if ($podatak->student == $stud->jmbag)
                {
                    $stud->student_korisnicko_ime=$podatak->soba;
                    array_push($oJson, $stud);
                }
            }
        }
    break;
    case 'get_students_without_room':
        $oStudenti = array();
        $oPodaci = array();
        $sig = 0;
        $sQuery = "SELECT * FROM student";
        $oRecord = $oConnection->query($sQuery);
        $sQuery1 = "SELECT * FROM soba_student";
        $oRecord1 = $oConnection->query($sQuery1);
        while ($oRow = $oRecord->fetch(PDO::FETCH_BOTH))
        {
            $oStudent = new Student($oRow['id'], $oRow['ime'], $oRow['prezime'], $oRow['jmbag'], $oRow['korisnicko_ime'], $oRow['zaporka'], $oRow['adresa'], $oRow['postanski_broj'], $oRow['grad'], $oRow['smjer'], $oRow['godina_studiranja'], $oRow['ostvareno_ects'], $oRow['prosjek_ocjena']);
            array_push($oStudenti, $oStudent);
        }
        while ($oRow1 = $oRecord1->fetch(PDO::FETCH_BOTH))
        {
            $oRoomData = new roomData($oRow1['soba_id'], $oRow1['student_jmbag']);
            array_push($oPodaci, $oRoomData);
        }
        foreach ($oStudenti as $stud)
        {
            foreach ($oPodaci as $podatak)
            {
                if ($stud->jmbag == $podatak->student)
                {
                    $sig = 1;
                }
            }
            if ($sig == 0)
            {
                array_push($oJson, $stud);
            }
            $sig = 0;
        }

    break;
    case 'get_all_administrators':
        $sQuery = "SELECT * FROM administrator";
        $oRecord = $oConnection->query($sQuery);

        while ($oRow = $oRecord->fetch(PDO::FETCH_BOTH))
        {
            $oAdmin = new Administrator($oRow['admin_id'], $oRow['ime'], $oRow['prezime'], $oRow['username'], $oRow['password']);
            array_push($oJson, $oAdmin);
        }
    break;
    case 'get_payed_reciepts':
        $sQuery = "SELECT * FROM racun WHERE placeno='DA'";
        $oRecord = $oConnection->query($sQuery);

        while ($oRow = $oRecord->fetch(PDO::FETCH_BOTH))
        {
            $oRacun = new Racun($oRow['broj_racuna'], $oRow['student'], $oRow['soba_id'], $oRow['datum_vrijeme'], $oRow['svota'], $oRow['placeno']);
            array_push($oJson, $oRacun);
        }
    break;
    case 'get_unpayed_reciepts':
        $sQuery = "SELECT * FROM racun WHERE placeno='NE'";
        $oRecord = $oConnection->query($sQuery);

        while ($oRow = $oRecord->fetch(PDO::FETCH_BOTH))
        {
            $oRacun = new Racun($oRow['broj_racuna'], $oRow['student'], $oRow['soba_id'], $oRow['datum_vrijeme'], $oRow['svota'], $oRow['placeno']);
            array_push($oJson, $oRacun);
        }
    case 'get_student_payed_reciepts':
        $studentID = $_COOKIE["osoba"];

        $sQuery2 = "SELECT * FROM student WHERE id=" . $studentID;
        $oRecord2 = $oConnection->query($sQuery2);

        $studJMBAG = 0;

        while ($oRow2 = $oRecord2->fetch(PDO::FETCH_BOTH))
        {
            $studJMBAG = $oRow2['jmbag'];
        }

        $sQuery = "SELECT * FROM racun WHERE placeno='DA' AND student=" . $studJMBAG;
        $oRecord = $oConnection->query($sQuery);
        while ($oRow = $oRecord->fetch(PDO::FETCH_BOTH))
        {
            $oRacun = new Racun($oRow['broj_racuna'], $oRow['student'], $oRow['soba_id'], $oRow['datum_vrijeme'], $oRow['svota'], $oRow['placeno']);
            array_push($oJson, $oRacun);
        }
    break;
    case 'get_student_unpayed_reciepts':
        $studentID = $_COOKIE["osoba"];

        $sQuery2 = "SELECT * FROM student WHERE id=" . $studentID;
        $oRecord2 = $oConnection->query($sQuery2);

        $studJMBAG = 0;

        while ($oRow2 = $oRecord2->fetch(PDO::FETCH_BOTH))
        {
            $studJMBAG = $oRow2['jmbag'];
        }

        $sQuery = "SELECT * FROM racun WHERE placeno='NE' AND student=" . $studJMBAG;
        $oRecord = $oConnection->query($sQuery);
        while ($oRow = $oRecord->fetch(PDO::FETCH_BOTH))
        {
            $oRacun = new Racun($oRow['broj_racuna'], $oRow['student'], $oRow['soba_id'], $oRow['datum_vrijeme'], $oRow['svota'], $oRow['placeno']);
            array_push($oJson, $oRacun);
        }
    break;

}
echo json_encode($oJson);
?>