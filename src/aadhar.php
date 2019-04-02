<body>
<?php 
    include "header.php";
?>
<div class="form">
<div class="container">
            <form method="POST" action="server.php" onsubmit="aadharverify()">
            <div class="col-sm-2">
            <label>Aadhar No</label>
            </div>
            <div class="col-sm-5">
         <input name="aadhar" id="aadhar" type="text" maxlength="100"  required>
            </div>
            </div>
            </div></div>
            <div class="container">
            <input type="submit" value="submit" name="aadh">
            
    </form>
    </div>

<script>
function aadharverify(){
 var a=document.getElementById("aadhar").value;
 if(a.length!=12){
     alert("Aadhar UID should contain 12 digits");
 }
}
</script>