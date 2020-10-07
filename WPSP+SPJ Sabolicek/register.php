<?php
include ("connection.php");

$poruka = '';
$jmbagStatus = 0;
$usernameStatus = 0;

$aJmbag=array();
$aUsername=array();

if (isset($_POST["register"]))
{
    if (empty($_POST["ime"]) || empty($_POST["prezime"]) || empty($_POST["jmbag"]) || empty($_POST["korisnicko_ime"]) || empty($_POST["zaporka"]) || empty($_POST["adresa"]) || empty($_POST["postanski_broj"]) || empty($_POST["grad"]) || empty($_POST["ostvareno_ects"]) || empty($_POST["prosjek_ocjena"]))
    {
        $poruka = "<div class='alert alert-danger'>Morate popuniti sva polja</div>";
    }
    else
    {
        $sQuery = "SELECT * FROM administrator";
        $sQuery2 = "SELECT * FROM student";

        $oRecord = $oConnection->query($sQuery);
        $oRecord2 = $oConnection->query($sQuery2);

        while ($oRow = $oRecord->fetch(PDO::FETCH_BOTH))
        {
			array_push($aUsername, $oRow['username']);
        }
        while ($oRow2 = $oRecord2->fetch(PDO::FETCH_BOTH))
        {
		    array_push($aJmbag, $oRow2['jmbag']);
			array_push($aUsername, $oRow2['korisnicko_ime']);
        }
        foreach($aJmbag as $jmbag){
            if($_POST['jmbag']==$jmbag){
                $jmbagStatus=1;
            }
            foreach($aUsername as $username){
                if($_POST['korisnicko_ime']==$username){
                    $usernameStatus=1;
                }
            }
        }
        if($jmbagStatus==1){
            $poruka = "<div class='alert alert-danger'>Unijeli ste JMBAG koji već postoji</div>";    
        }
        if($usernameStatus==1){
            $poruka = "<div class='alert alert-danger'>Unijeli ste korisničko ime koje se već koristi</div>";
        }
        if($jmbagStatus==1 && $usernameStatus==1){
            $poruka = "<div class='alert alert-danger'>Unijeli ste korisničko ime i JMBAG koje se već koristi</div>";
        }
        if($jmbagStatus==0 && $usernameStatus==0){
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
            header("location:login.php");
		}
		catch(PDOException $error)
		{
			echo $error;
		}
        }
    }
}
?>

<!DOCTYPE html>
<html>
   <head>
      <title>Studom</title>
      <meta charset="utf‐8">
      <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
         <a class="navbar-brand" href="index.php">Studom VSMTI</a>
      </nav>
      <div class="jumbotron">
         <h1>
            <center>STUDOM</center>
         </h1>
      </div>
   </head>
   <body>
      <div class="container">
         <div class="panel panel-default">
            <div class="panel-heading">Register</div>
            <div class="panel-body">
               <span><?php echo $poruka; ?></span>
               <form method="post">
                  <div class="form-group">
                     <label>Jmbag</label>
                     <input type="text" name="jmbag" id="jmbag" placeholder="Jmbag"  class="form-control" />
                  </div>
                  <div class="form-group">
                     <label>Ime</label>
                     <input type="text" name="ime" id="ime" placeholder="Ime"  class="form-control" />
                  </div>
                  <div class="form-group">
                     <label>Prezime</label>
                     <input type="text" name="prezime" id="prezime" placeholder="Prezime"  class="form-control" />
                  </div>
                  <div class="form-group">
                     <label>Korisničko ime</label>
                     <input type="text" name="korisnicko_ime" id="korisnicko_ime" placeholder="Korisničko ime"  class="form-control" />
                  </div>
                  <div class="form-group">
                     <label>Zaporka</label>
                     <input type="password" name="zaporka" id="zaporka" placeholder="Zaporka"  class="form-control" />
                  </div>
                  <div class="form-group">
                     <label>Adresa</label>
                     <input type="text" name="adresa" id="adresa" placeholder="Adresa"  class="form-control" />
                  </div>
                  <div class="form-group">
                     <label>Poštanski broj</label>
                     <input type="text" name="postanski_broj" id="postanski_broj" placeholder="Poštanski broj"  class="form-control" />
                  </div>
                  <div class="form-group">
                     <label>Grad</label>
                     <input type="text" name="grad" id="grad" placeholder="Grad"  class="form-control" />
                  </div>
                  <div class="form-group">
                     <label>Smjer</label>
                     <div class="col-md-8">
                        <select class="form-control" id="smjer" name="smjer">
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
                     <label>Godina Studiranja</label>
                     <div class="col-md-8">
                        <select class="form-control" id="godina_studiranja" name="godina_studiranja">
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
                     <label>ECTS</label>
                     <input type="text" name="ostvareno_ects" id="ostvareno_ects" placeholder="ECTS"  class="form-control" />
                  </div>
                  <div class="form-group">
                     <label>Prosjek</label>
                     <input type="text" name="prosjek_ocjena" id="prosjek_ocjena" placeholder="Prosjek"  class="form-control" />
                  </div>
                  <div class="form-group">
                     <input type="submit" name="register" id="register" class="btn btn-info" value="Register" />
                  </div>
               </form>
            </div>
         </div>
      </div>
      <script src="js/sobe.js"></script>
   </body>
</html>
