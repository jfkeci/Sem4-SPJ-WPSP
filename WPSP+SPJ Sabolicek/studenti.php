<?php

if(!isset($_COOKIE["osoba"]))
{
 header("location:index.php");
}

?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Studom</title>
      <meta charset="utf‐8">
      <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
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
                  <a class="nav-link active" href="studenti.php">Studenti Administracija</a>
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
      </nav>
   </head>
   <body>
   <div class="jumbotron">
            <center>
               <h1>Studom</h1>
            </center>
         </div>
      <div class="container-fluid">
      <div class="container-fluid">
         <a href="javascript:GetModal('modals.php?modal_id=add_new_student');" class="btn btn-success" role="button">Dodaj Studenta</a>
         <div class="container-fluid">
            <form class="form-inline my-2 my-lg-0">
               <input style="margin-top:20px;" id="searchInput" class="form-control mr-sm-2" type="text" placeholder="Traži">
            </form>
         </div>
         <table class="table table-hover">
            <thead>
               <tr>
                  <th>Rbr.</th>
                  <th>Ime</th>
                  <th>Prezime</th>
                  <th>Jmbag</th>
                  <th>Adresa</th>
                  <th>Poštanski Broj</th>
                  <th>Grad</th>
                  <th>Smjer</th>
                  <th>Godina Studiranja</th>
                  <th>Ostvareno ECTS</th>
                  <th>Prosjek ocjena</th>
                  <th></th>
                  <th></th>
               </tr>
            </thead>
            <tbody id="tableStudents">
            </tbody>
         </table>
      </div>
      </div>
      <div class="modal" id="modals" tabindex="-1" role="dialog">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
            </div>
         </div>
      </div>
      <script src="js/studenti.js"></script>
      <script src="js/globals.js"></script>
   </body>
</html>