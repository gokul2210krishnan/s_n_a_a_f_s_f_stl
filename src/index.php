<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../web/css/index.css" type="text/css">
    <style>
        
    </style>
</head>
<body>
    <div class="container">
    <div class="menu-sidebar menu-bar-block menu-border-right" style="display:none" id="mySidebar">
  <button onclick="menu_close()" class="w3-bar-item w3-large">Close &times;</button>
  <a href="#" class="w3-bar-item w3-button">Link 1</a>
  <a href="#" class="w3-bar-item w3-button">Link 2</a>
  <a href="#" class="w3-bar-item w3-button">Link 3</a>
</div>
    </div>
<header>
<div class="container">
    <div class="col-sm-1" style="display:block;">    
    <button class="" onclick="menu_open()">☰</button>
    </div>
    <div class="col-sm-3">
        <h3>Soil Testing Laboratry</h3>
    </div>
    </header>
    <div class="container">
    <h1>Welcome to soil testing lab</h1>
    <p><a href="aadhar.php">Press here to get into calculation</a></p>
    </div>
    <script>
function menu_open() {
  document.getElementById("mySidebar").style.display = "block";
}

function menu_close() {
  document.getElementById("mySidebar").style.display = "none";
}
</script>
</body>
</html>