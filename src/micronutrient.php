<body>
<?php 
    include "header.php";

?>
            <div class="container">
            <form method="POST" action="server.php">

            <div class="container">
            <h3 style="color:white;">Nutrients</h3>
            </div>
            <div class="container">
            <div class="col-sm-2">
            <label>Iron (Fe) [ppm]:</label>
            </div>
            <div class="col-sm-5">
            <input type="text" id="fe" name="fe" maxlength="20" placeholder="<3.7 to >3.7 Or <6.3 to >6.3" required>
            </div>
            </div>
            <div class="container">
            <div class="col-sm-2">
            <label>Manganese (Mn) [ppm] :</label>
            </div>
            <div class="col-sm-5">
            <input type="text" id="mn" name="mn" maxlength="20" placeholder="<2.0 to >2.0" required>
            </div>
            </div>
            <div class="container">
            <div class="col-sm-2">
            <label>Copper (Cu) [ppm]:</label>
            </div>
            <div class="col-sm-5">
            <input type="text" id="cu" name="cu" maxlength="20" placeholder="<1.2 to >1.2" required>
            </div>
            </div>
            <div class="container">
            <div class="col-sm-2">
            <label>Zinc (Zn) [ppm]:</label>
            </div>
            <div class="col-sm-5">
            <input type="text" id="zn" name="zn" maxlength="20" placeholder="<1.2 to >1.2" required>
            </div>
            </div>
            <div class="container">
            <input type="submit" value="submit" name="micro">
    </form>
    <div>
</body>