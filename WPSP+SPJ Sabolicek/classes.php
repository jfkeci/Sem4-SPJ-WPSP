<?php

class Configuration
{
	public $host="localhost";
	public $dbName="studom";
	public $username="root";
	public $password="";	
}

class Osoba{
    public $osoba_id="N/A";
	public $ime="N/A";
	public $prezime="N/A";
}

class Student extends Osoba{
    public $jmbag="N/A";
    public $student_korisnicko_ime="N/A";
    public $student_zaporka="N/A";
	public $adresa="N/A";
	public $postanski_broj="N/A";
	public $grad="N/A";
	public $smjer="N/A";
	public $godina_studiranja="N/A";
    public $ostvareno_ects="N/A";
	public $prosjek_ocjena="N/A";
	public function __construct($id=null,$im=null,$pr=null,$jm=null,$ski=null,$sz=null,$adr=null,$pb=null,$gr=null,$sm=null,$gs=null,$oe=null,$po=null){
		if($id) $this->osoba_id=$id;
		if($im) $this->ime=$im;
		if($pr) $this->prezime=$pr;
		if($jm) $this->jmbag=$jm;
		if($ski) $this->student_korisnicko_ime=$ski;
		if($sz) $this->student_zaporka=$sz;
		if($adr) $this->adresa=$adr;
		if($pb) $this->postanski_broj=$pb;
		if($gr) $this->grad=$gr;
		if($sm) $this->smjer=$sm;
		if($gs) $this->godina_studiranja=$gs;
		if($oe) $this->ostvareno_ects=$oe;
		if($po) $this->prosjek_ocjena=$po;
	}
}

class Administrator extends Osoba{
    public $username="N/A";
	public $password="N/A";
	public function __construct($id=null,$im=null,$pr=null,$un=null,$pass=null){
		if($id) $this->osoba_id=$id;
		if($im) $this->ime=$im;
		if($pr) $this->prezime=$pr;
		if($un) $this->username=$un;
		if($pass) $this->password=$pass;
	}
}  

class Soba{
    public $soba_id="N/A";
	public $broj_sobe="N/A";
	public $kat="N/A";
    public $tip_sobe="N/A";
	public $opis="N/A";

	public function __construct($sId=null,$bs=null,$k=null,$ts=null,$o=null)
	{
		if($sId) $this->soba_id=$sId;
		if($bs) $this->broj_sobe=$bs;
		if($k) $this->kat=$k;
        if($ts) $this->tip_sobe=$ts;
        if($o) $this->opis=$o;
	}
}

class Komentar{
    public $komentar_id="N/A";
    public $id_osobe="N/A";
    public $titula="N/A";
    public $id_sobe="N/A";
    public $datum_vrijeme_komentara="N/A";
    public $sadržaj_komentara="N/A";

    public function __construct($kId=null,$oId=null,$t=null,$sId=null,$dvk=null,$s=null)
	{
		if($kId) $this->komentar_id=$kId;
		if($oId) $this->id_osobe=$oId;
		if($t) $this->titula=$t;
        if($sId) $this->id_sobe=$sId;
        if($dvk) $this->datum_vrijeme_komentara=$dvk;
		if($s) $this->sadržaj_komentara=$s;
	}
}

class Racun{
    public $broj_racuna="N/A";
    public $student_id="N/A";
    public $soba_id="N/A";
    public $datum_vrijeme="N/A";
    public $svota_racuna="N/A";
	public $placeno="N/A";
	
    public function __construct($br=null,$stId=null,$soId=null,$dv=null,$sr=null,$p=null)
	{
		if($br) $this->broj_racuna=$br;
		if($stId) $this->student_id=$stId;
		if($soId) $this->soba_id=$soId;
        if($dv) $this->datum_vrijeme=$dv;
        if($sr) $this->svota_racuna=$sr;
		if($p) $this->placeno=$p;
	}	
}

class PrijavaDom{
    public $prijava_id="N/A";
    public $student_jmbag="N/A";
	public $vrijeme_datum_prijave="N/A";

	public function __construct($pi=null,$sj=null,$vdp=null){
		if($pi) $this->prijava_id=$pi;
		if($sj) $this->student_jmbag=$sj;
		if($vdp) $this->vrijeme_datum_prijave=$vdp;
	}
}

class roomData{
	public $soba="N/A";
    public $student="N/A";

	public function __construct($so=null,$st=null){
		if($so) $this->soba=$so;
		if($st) $this->student=$st;

	}
}

?>