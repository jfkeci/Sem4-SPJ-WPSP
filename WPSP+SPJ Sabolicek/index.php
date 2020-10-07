<?php
$navbarString='';


if(isset($_COOKIE["osoba"]))
{
   $osobaID=$_COOKIE["osoba"];
   if($osobaID>=100)
   {
      $navbarString='<nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand active" href="index.php">Studom VSMTI</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
         <ul class="navbar-nav mr-auto">
            <li class="nav-item">
               <a class="nav-link" href="sobe.php">Sobe</a>
            </li>
            <li class="nav-item">
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
      </nav>';
   }

   if($osobaID<100)
   {
      $navbarString='<nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="index.php">Studom VSMTI</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
         <ul class="navbar-nav mr-auto">
            <li class="nav-item">
               <a class="nav-link" href="sobeAdministracija.php">Sobe</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="studenti.php">Studenti Administracija</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="studenti_sobe.php">Studenti po sobama</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="racuniAdministracija.php">Racuni</a>
            </li>
            <li class="nav-item">
            <a class="btn btn-outline-success my-2 my-sm-0" href="odjava.php">Odjava</a>
            </li>
         </ul>
      </div>
      </nav>';
   }
}
else
{
   $navbarString='<nav class="navbar navbar-expand-lg navbar-light bg-light">
   <a class="navbar-brand" href="index.php">Studom VSMTI</a>
   <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
   <span class="navbar-toggler-icon"></span>
   </button>
   <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
         <li class="nav-item active">
         <a href="login.php" class="btn btn-success" role="button">Prijava</a>
         </li>
         <li class="nav-item active">
         <a style="margin-left:30px;" href="register.php" class="btn btn-primary" role="button">Registracija</a>
         </li>
      </ul>
      
   </div>
</nav>';
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
      <link rel="stylesheet" type="text/css" href="css/sobe.css">
      <?php echo $navbarString; ?>
      <div class="jumbotron">
         <h1>
            <center>STUDOM</center>
         </h1>
      </div>
   </head>
   <body>
      <div class="container">
         <div class="tab">
            <button class="tablinks" onclick="SwitchTabs('o_nama');">O nama</button>
            <button class="tablinks" onclick="SwitchTabs('kontakt');">Kontakt</button>
         </div>
      </div>
      <div id="o_nama" class="tabcontent">
         <div class="album py-5 bg-light">
            <div class="container">
               <h3>O nama</h3>
               <div class="o_nama row">
                  <div class="row hpadding">
                     <div class="col-md-8">
                        <div class="IN_ArticleText">
                           <img class="card-img-top" style="display: block;" src="img/studom.jpg" data-holder-rendered="true">
                           <br>
                           <p style="text-align: justify;">Studentski dom Virovitica otvoren je 30. kolovoza 2017. godine. Kapacitet Doma, ukupne veličine 2.287,87 m<sup>2</sup> je 108 ležajeva. Investitor projekta je Visoka škola za menadžment u turizmu i informatici u Virovitici, a financiranje se temelji na Ugovoru o dodjeli bespovratnih sredstava za projekte financirane iz Europskih strukturnih i investicijskih fondova.</p>
                           <p style="text-align: justify;">Korisnicima Studentskog doma Virovitica smještaj je omogućen u jednokrevetnim i dvokrevetnim sobama. Na raspolaganju su boravak za zajedničko druženje korisnika, informatička učionica te besplatni WiFi u svim prostorijama. Studentski dom Virovitica opremljen je profesionalnim perilicama i sušilicama rublja te uređajima za glačanje.</p>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <br>
                        <div style="line-height:140%;">
                           <h2>Informacije</h2>
                           <a href="http://studom.vsmti.hr/o-projektu/13/">O projektu</a>
                           <hr style="margin:10px 0;">
                           <a href="http://studom.vsmti.hr/prehrana/6/">Prehrana</a>
                           <hr style="margin:10px 0;">
                           <a href="http://studom.vsmti.hr/pravilnik-o-domskom-redu-i-uvjetima-boravka-studenata/2/">Pravilnik o domskom redu i uvjetima boravka studenata</a>
                           <hr style="margin:10px 0;">
                           <a href="http://studom.vsmti.hr/o-domu/1/">O domu</a>
                           <hr style="margin:10px 0;">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div id="kontakt" class="tabcontent">
         <div class="album py-5 bg-light">
            <div class="container">
               <div class="kontakt row">
               <div class="col-md-8">
                     <b style="font-size:120%;">Studentski dom Virovitica</b><br>
                     Matije Gupca 78/4<br>
                     33000 Virovitica<br>
                     <span class="glyphicon glyphicon-earphone" aria-hidden="true"></span> 033 628 817<br>
                     <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> <script type="text/javascript">startMailer('cstudoma','bvsmti.hrb');</script><a href="mailto:studom@vsmti.hr">studom@vsmti.hr</a><br>
                     <br>
                     <hr>
               </div>
            </div>
         </div>
      </div>
      <script src="js/index.js"></script>
   </body>
</html>