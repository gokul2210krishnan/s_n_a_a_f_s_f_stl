<?php 
session_start();
            include "db-connect.php";
            ?>
<body>
<?php 
    include "header.php";
?>
<div class="form">
<div class="container">
            <form method="POST" action="server.php" onsubmit="regverify()">
            <div class="col-sm-2">
            <label>Aadhar No</label>
            </div>
            <div class="col-sm-5">
            <input name="aadhar" id="aadhar" type="text"  value="<?php echo $_SESSION["aadhar"]; ?>" maxlength="100">
            </div>
            </div>
            <div class="container">
            <div class="col-sm-2">
                <label>Farmer Id:</label>
                </div>
                <div class="col-sm-5">
                <input name="fid" type="text" maxlength="100" required>
            </div>
            </div>
            <div class="container">
            <div class="col-sm-2">
            <label>Farmer Name:</label>
            </div>
            <div class="col-sm-5">
            <input name="fname" type="text"  maxlength="100" required></label>
            </div>
            </div>
            <div class="container">
            <div class="col-sm-2">
            <label>Farmer Parents Name:</label>
            </div>
            <div class="col-sm-5">
            <input name="fpname" type="text"  maxlength="100" required></label>
            </div>
            </div>
            <div class="container">
            <div class="col-sm-2">
            <label>Farmer Gender:</label>
            </div>
            <div class="col-sm-1">
            </label><input name="fgender" type="radio"  value="male">Male</label>
            </div>
            <div class="col-sm-1">
            </label><input name="fgender" type="radio"  value="female">Female</label>
            </div>
            <div class="col-sm-2">
            </label><input name="fgender" type="radio"  value="transgender">Transgender</label>
            </div>
            </div>
            <div class="container">
            <div class="col-sm-2">
            <label>Survey number:</label>
            </div>
            <div class="col-sm-5">
            <input name="snum" type="text" required>
            </div>
            </div>
            <div class="container">
            <div class="col-sm-2">
            <label>Door No:</label>
            </div>
            <div class="col-sm-5">
            <input name="doorno" type="text" maxlength="5" required>
            </div>
            </div>
            <div class="container">
            <div class="col-sm-2">
            <label>Address:</label>
            </div>
            <div class="col-sm-5">
            <input name="faddress" type="text" maxlength="100" required>
            </div>
            </div>
            <div class="container">
            <input type="submit" value="submit" name="reg">
    </form>
    </div>
    <script type="text/javascript">
    function regverify(){

    }
    </script>
</body>
</html>