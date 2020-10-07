<?php
include ("connection.php");

if (isset($_COOKIE["osoba"]))
{
    header("location:sobe.php");
}

$poruka = '';
$passStatus = 0;
$userStatus = 0;


$oAdministratori=array();
$oStudenti=array();

if (isset($_POST["login"]))
{
    if (empty($_POST["username"]) || empty($_POST["user_password"]))
    {
        $poruka = "<div class='alert alert-danger'>Morate popuniti oba polja</div>";
    }
    else
    {
        $sQuery = "SELECT * FROM administrator";
        $sQuery2 = "SELECT * FROM student";

        $oRecord = $oConnection->query($sQuery);
        $oRecord2 = $oConnection->query($sQuery2);

        while ($oRow = $oRecord->fetch(PDO::FETCH_BOTH))
        {
            $oAdmin=new Administrator(
				$oRow['admin_id'],
				$oRow['ime'],
				$oRow['prezime'],
				$oRow['username'],
				$oRow['password']
			);
			array_push($oAdministratori,$oAdmin);
        }
        while ($oRow2 = $oRecord2->fetch(PDO::FETCH_BOTH))
        {
            $oStudent=new Student(
				$oRow2['id'],
				$oRow2['ime'],
				$oRow2['prezime'],
				$oRow2['jmbag'],
				$oRow2['korisnicko_ime'],
				$oRow2['zaporka'],
				$oRow2['adresa'],
				$oRow2['postanski_broj'],
				$oRow2['grad'],
				$oRow2['smjer'],
				$oRow2['godina_studiranja'],
				$oRow2['ostvareno_ects'],
				$oRow2['prosjek_ocjena']
			);
			array_push($oStudenti,$oStudent);
        }
        foreach($oAdministratori as $admin){
            if ($_POST["username"] == $admin->username)
            {
                $userStatus = 1;
            }
            if ($_POST["user_password"] == $admin->password)
            {
                $passStatus = 1;
            }
            if ($userStatus == 1)
            {
                if($passStatus==1){
                    setcookie("osoba", $admin->osoba_id, time() + 3600);
                    $passStatus = 0;
                    $userStatus = 0;
                    header("location:sobeAdministracija.php");
                break;
                }
            }
        }
        foreach($oStudenti as $student){
            if ($_POST['username'] == $student->student_korisnicko_ime)
            {
                $userStatus = 1;
            }
            if ($_POST['user_password'] == $student->student_zaporka)
            {
                $passStatus = 1;
            }
            if ($userStatus == 1)
            {
                if($passStatus==1){
                    setcookie("osoba", $student->osoba_id, time() + 3600);
                    $passStatus = 0;
                    $userStatus = 0;
                    header("location:sobe.php");
                break;
                }
            }
        }

        if ($userStatus == 0)
        {
            $poruka = "<div class='alert alert-danger'>Pogrešno korisničko ime</div>";
        }
        if ($passStatus == 0)
        {
            $poruka = "<div class='alert alert-danger'>Pogrešna zaporka</div>";
        }
        if ($passStatus == 0 && $userStatus == 0)
        {
            $poruka = "<div class='alert alert-danger'>Pogrešni podaci</div>";
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
            <div class="panel-heading">Login</div>
            <div class="panel-body">
               <span><?php echo $poruka; ?></span>
               <form method="post">
                  <div class="form-group">
                     <label>Korisničko ime</label>
                     <input type="text" name="username" id="username" class="form-control" />
                  </div>
                  <div class="form-group">
                     <label>Password</label>
                     <input type="password" name="user_password" id="user_password" class="form-control" />
                  </div>
                  <div class="form-group">
                     <input type="submit" name="login" id="login" class="btn btn-info" value="Login" />
                  </div>
               </form>
            </div>
         </div>
      </div>
   </body>
</html>
