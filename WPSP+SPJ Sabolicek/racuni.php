<?php

if(!isset($_COOKIE["osoba"]))
{
 header("location:index.php");
}

?>
<!DOCTYPE html>
<html lang="hr" ng-app="MyApp">
   <head>
      <title>Studom</title>
      <meta charset="utf‐8">
      <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.3.4-build.3588/angular.js"></script>
	   <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.3.4-build.3588/angular.min.js"></script>	
      <link rel="stylesheet" type="text/css" href="css/sobe.css">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
         <a class="navbar-brand" href="index.php">Studom VSMTI</a>
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
                  <a class="nav-link active" href="racuni.php">Racuni</a>
               </li>
               <li class="nav-item">
               <a class="btn btn-outline-success my-2 my-sm-0" href="odjava.php">Odjava</a>
               </li>
            </ul>
         </div>
      </nav>
      <div class="jumbotron">
         <h1>
            <center>STUDOM</center>
         </h1>
      </div>
   </head>
   <body>
   <div class="container">
         <div class="tab">
            <button class="tablinks" onclick="SwitchTabs('racuni_placeni');">Placeni</button>
            <button class="tablinks" onclick="SwitchTabs('racuni_neplaceni');">Neplaceni</button>
         </div>
      </div>
      <div id="racuni_placeni" class="tabcontent">
         <div class="container-fluid" ng-controller="placeniRacuni">
            <div class="container-fluid">
               <table id="placeni" class="table table-hover">
                  <thead>
                     <tr>
                        <th>Rbr.</th>
                        <th>Broj Racuna</th>
                        <th>Soba</th>
                        <th>Datum i Vrijeme Izdavanja</th>
                        <th>Svota</th>
                        <th>Placeno</th>
                     </tr>
                  </thead>
                  <tbody ng-repeat="racun in oData">
                        <td>{{$index}}</td>
                        <td>{{racun.broj_racuna}}</td>
                        <td>{{racun.soba_id}}</td>
                        <td>{{racun.datum_vrijeme}}</td>
                        <td>{{racun.svota}}</td>
                        <td>{{racun.placeno}}</td>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
      <div id="racuni_neplaceni" class="tabcontent">
         <div class="container-fluid">
            <div class="container-fluid">
               <table id="neplaceni" class="table table-hover">
                  <thead>
                     <tr>
                        <th>Rbr.</th>
                        <th>Broj Racuna</th>
                        <th>Soba</th>
                        <th>Datum i Vrijeme Izdavanja</th>
                        <th>Svota</th>
                        <th>Placeno</th>
                     </tr>
                  </thead>
                  <tbody>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
      <div class="modal" id="modals" tabindex="-1" role="dialog">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
            </div>
         </div>
      </div>
      <script src="js/racuni.js"></script>
      <script src="js/globals.js"></script>
</body>
</html>