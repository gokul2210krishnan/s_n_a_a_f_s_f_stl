<?php
include "db-connect.php";
?>
<html lang="en">
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="..\web\css\main.css" type="text/css"  />
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<link rel="stylesheet" href="../web/css/index.css" type="text/css">
</head>
<body background="../web/img/img2.jpg">
<header>
<div class="container">
    <div class="col-sm-1" style="display:block;">
    <button class="" onclick="menu_open()">☰</button>
    </div>
    <div class="col-sm-3">
        <h3>Soil Testing Laboratry</h3>
    </div>
    </header>
    <br>
<!--            <div class="container">
            <div class="col-sm-2">
            <label>Reg :</label>
            </div>
            <div class="col-sm-5">
            <input type="text" id="reg" maxlength="20">
            </div>
            </div>
  -->


            <div class="container">
            <div class="col-sm-2">
            <label>Temperature_zone</label>
            </div>
            <div class="col-sm-5">
            <select name="tex">
            <option name="texNull">Not Selected</option>
            <option name="tem1">North Western Zone</option>
            <option name="tem2">Western Zone</option>
            <option name="tem3">Cauvery Delta Zone</option>
            </select>
            </div>
            </div>
    </body>
</html>