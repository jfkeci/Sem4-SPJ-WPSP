<?php

function GetRoomById($roomID, $aRooms)
{
    $oSoba = array();
    foreach ($aRooms as $soba)
    {
        if ($soba->soba_id == $roomID)
        {
            $oSoba = $soba;
        }
    }
    return $oSoba;
}

function DajKat($kat)
{
    $sKat = "";
    if ($kat == 3)
    {
        $sKat = "Prizemlje";
    }
    if ($kat == 2)
    {
        $sKat = "Drugi kat";
    }
    if ($kat == 1)
    {
        $sKat = "Prvi kat";
    }
    return $sKat;
}

function StudentiPoSobi($oPodaci, $oStudenti)
{
    $aStudenti = array();
    foreach ($oPodaci as $podatak)
    {
        foreach ($oStudenti as $stud)
        {
            if ($podatak->student == $stud->jmbag)
            {
                array_push($aStudenti, $stud);
            }
        }
    }
    return $aStudenti;
}

function StudentPoSobi($oPodaci, $oStudent)
{
    foreach ($oPodaci as $podatak)
    {
        if ($podatak->student == $oStudent->jmbag)
        {
            return $podatak->soba;
        }
    }
}

function DajOsobuPoID($aStudenti, $aAdministratori, $id)
{
    $oOsoba = new Osoba();

    foreach ($aStudenti as $student)
    {
        if ($student->osoba_id == $id)
        {
            $oOsoba->osoba_id = $student->osoba_id;
            $oOsoba->ime = $student->ime;
            $oOsoba->prezime = $student->prezime;;
        }
    }
    foreach ($aAdministratori as $admin)
    {
        if ($admin->osoba_id == $id)
        {
            $oOsoba->osoba_id = $admin->osoba_id;
            $oOsoba->ime = $admin->ime;
            $oOsoba->prezime = $admin->prezime;
        }
    }
    return $oOsoba;
}

function DajStudentaPoID($aStudenti, $id)
{
    foreach ($aStudenti as $student)
    {
        if ($student->osoba_id == $id)
        {
            return $student;
        }
    }
}
function DajStudentaPoJMBAG($aStudenti, $jmbag)
{
    foreach ($aStudenti as $student)
    {
        if ($student->jmbag == $jmbag)
        {
            return $student;
        }
    }
}
function ProvjeraSobe($oStudenti, $oPodaci, $id)
{
    $hasRoom = false;
    foreach ($oStudenti as $stud)
    {
        if ($stud->osoba_id == $id)
        {
            foreach ($oPodaci as $podatak)
            {
                if ($podatak->student == $stud->jmbag)
                {
                    $hasRoom = true;
                }
            }
        }
    }
    return $hasRoom;
}

function DajTituluOsobe($id)
{
    if ($id < 100)
    {
        return 'Admin';
    }
    else
    {
        return 'Student';
    }
}
function DajTituluPoID($id)
{
    if ($id < 100)
    {
        return 1;
    }
    else
    {
        return 2;
    }
}

function DatumVrijeme($n)
{
    $d = strtotime("now");
    if ($n == 2)
    {
        return date("Y-m-d H:i", $d);
    }
    if ($n == 3)
    {
        return date("Y-m-d H:i:s", $d);
    }
}

function GetDirectory($tip, $opis)
{
    $imgString = '';
    if ($opis == 'Dijeljena kupaonica' && $tip == 'Dvokrevetna')
    {
        $imgString = 'dvokrevetnab';
    }
    if ($opis == 'Zasebna kupaonica' && $tip == 'Dvokrevetna')
    {
        $imgString = 'dvokrevetnaa';
    }
    if ($opis == 'Zasebna kupaonica' && $tip == 'Jednokrevetna')
    {
        $imgString = 'jednokrevetna';
    }
    return $imgString;
}

function DajRoomIdPoStudentu($oPodaci, $jmbag){
    foreach($oPodaci as $podatak){
        if($podatak->student==$jmbag){
            return $podatak->soba;
        }
    }
}

function ProvjeraDostupnosti($tipSobe, $zauzeto){
    $slobodnoMjesto=false;
    if($tipSobe == 'Jednokrevetna' && $zauzeto== 0){
        return true;
    }
    if($tipSobe == 'Jednokrevetna' && $zauzeto==1){
        return false;
    }
    if($tipSobe == 'Dvokrevetna' && $zauzeto==0 || $zauzeto==1){
        return true;
    }
    if($tipSobe == 'Dvokrevetna' && $zauzeto==2){
        return false;
    }
}

function DajJmbagStudenta($oStudenti, $id){
    foreach($oStudenti as $student){
        if($student->osoba_id==$id){
            return $student->jmbag;
        }
    }
}
function SobaPoID($oSobe, $rid){
    foreach($oSobe as $soba){
        if($soba->soba_id==$rid){
            return $soba;
        }
    }
}
?>
