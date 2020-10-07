<?php
if(!isset($_COOKIE["osoba"]))
{
 header("location:index.php");
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
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
         <a class="navbar-brand" href="index.php">Studom VSMTI</a>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
               <li class="nav-item">
                  <a class="nav-link active" href="sobe.php">Sobe</a>
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
            <button class="tablinks" id="sve" onclick="openFloor('Sve');">Sve Sobe</button>
            <button class="tablinks" onclick="openFloor('Prizemlje');">Prizemlje</button>
            <button class="tablinks" onclick="openFloor('PrviKat');">Prvi Kat</button>
            <button class="tablinks" onclick="openFloor('DrugiKat');">Drugi Kat</button>
            <button class="tablinks" onclick="openFloor('Administracija');">Sve sobe Tablica</button>
         </div>
      </div>
      <div id="Sve" class="tabcontent">
         <div class="album py-5 bg-light">
            <div class="container">
            <h3>Sve Sobe</h3>
               <div class="sobeSve row">
               </div>
            </div>
         </div>
      </div>
      <div id="Prizemlje" class="tabcontent">
         <div class="album py-5 bg-light">
            <div class="container">
            <h3>Prizemlje</h3>
               <div class="sobePrizemlje row">
               </div>
            </div>
         </div>
      </div>
      <div id="PrviKat" class="tabcontent">
         <div class="album py-5 bg-light">
            <div class="container">
            <h3>Prvi Kat</h3>
               <div class="sobePrvi row">
               </div>
            </div>
         </div>
      </div>
      <div id="DrugiKat" class="tabcontent">
         <div class="album py-5 bg-light">
            <div class="container">
            <h3>Drugi Kat</h3>
               <div class="sobeDrugi row">
               </div>
            </div>
         </div>
      </div>
      <div id="Administracija" class="tabcontent">
            <div class="container">
            <h3>Sve Sobe</h3>
            <form class="form-inline my-2 my-lg-0">
                  <input  id="searchRooms" class="form-control mr-sm-2" type="text" placeholder="Search">
               </form>
            <table class="table tableRooms table-hover">
            <thead>
               <tr>
                  <th>Rbr.</th>
                  <th>Broj Sobe</th>
                  <th>Kat</th>
                  <th>Tip Sobe</th>
                  <th>Opis</th>
                  <th></th>
               </tr>
            </thead>
            <tbody id="roomsTable" >
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
      <script type="text/javascript" src="js/globals.js"></script>
      <script type="text/javascript" src="js/sobe.js"></script>
   </body>
</html>