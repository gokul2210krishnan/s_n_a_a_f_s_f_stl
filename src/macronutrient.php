<body>
<?php 
    include "header.php";
/*    include "db-connect.php";
    session_start();
    $q="SELECT crop_name FROM crop_types WHERE crop_id = SELECT crop_id FROM soiltype WHERE aadharno='".$_SESSION["aadhar"]."'";
    $r=mysqli_query($conn,$q);
    $row=mysqli_fetch_assoc($r);
    $crop_name=$row["crop_name"];*/
?>            <div class="container">
<form method="POST" action="server.php">

<div class="container">
<h3 style="color:white;">Nutrients</h3>
</div>

          <div class="container">
            <div class="col-sm-2">
            <label>Nitrogen (N) [ml] :</label>
            </div>
            <div class="col-sm-5">
            <input type="text" name="n" id="n" placeholder="From 1.2 to 3.6" maxlength="20" required>
            </div>
            </div>
            <div class="container">
            <div class="col-sm-2">
            <label>Phosporous (P) [ppm] :</label>
            </div>
            <div class="col-sm-5">
            <input type="text" name="p" id="p" placeholder="From 1.2 to 16.26" maxlength="20" required>
            </div>
            </div>
            <div class="container">
            <div class="col-sm-2">
            <label>Potassium (K) [ppm] :</label>
            </div>
            <div class="col-sm-5">
            <input type="text" id="k" name="k" placeholder="From 10 to 40" maxlength="20" required>
            </div>
            </div>
            <div class="container">
            <input type="submit" value="submit" name="macro">
    </form>
    <div>
</body>