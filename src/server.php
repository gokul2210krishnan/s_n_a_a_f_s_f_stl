<?php
#session started..
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}


#db connections
include "db-connect.php";

#code for verifying aadhar
if(isset($_POST["aadh"]))
{
  if($_POST["aadhar"]!=NULL){
        $count=0;
        $_SESSION["aadhar"]=$_POST["aadhar"];
        $q="select aadharno from registration";
        $result=mysqli_query($conn,$q);
        while($row=mysqli_fetch_assoc($result)){
          if($_POST["aadhar"]==$row["aadharno"]){
            $count++;
          }
        };
  if($count==1){
          sleep(2);
          header("Location: macronutrient.php");
          exit;
        }
        else{
          sleep(2);
          header("Location: register.php");
          exit;
        }
  }
}

#code for registering framer
if(isset($_POST["reg"]))
{
  if($_POST["fid"]!=NULL && $_POST["fname"]!=NULL && $_POST["fpname"]!=NULL && $_POST["faddress"]!=NULL && $_POST["snum"]!=NULL && $_POST["aadhar"]!=NULL && $_POST["fgender"]!=NULL && $_POST["doorno"]!=NULL)
  {
    $result = mysqli_query($conn,"SELECT COUNT(*) FROM registration");
    $row = mysqli_fetch_assoc($result);
    $size = $row['COUNT(*)'];
    $sno=$size+1;
    $fid=$_POST["fid"];
    $fn=$_POST["fname"];
    $fpn=$_POST["fpname"];
    $fa=$_POST["faddress"];
    $fdn=$_POST["doorno"];
    $fg=$_POST["fgender"];
    $sur=$_POST["snum"];
    $a=$_SESSION["aadhar"];
    echo $sno." ".$_SESSION["aadhar"]." ".$_POST["fid"]." ".$_POST["fname"]." ".$_POST["fpname"]." ".$_POST["faddress"]." ".$_POST["doorno"]." ".$_POST["fgender"]." ".$_POST["snum"]." ".$_SESSION["aadhar"]." ".$_POST["fgender"];
    $q="INSERT INTO registration(`sno`, `fid`, `fname`, `fpname`, `fgender`, `surveyno`, `doorno`, `address`, `aadharno`) VALUES ('".$sno."','".$fid."','".$fn."','".$fpn."','".$fg."','".$sur."','".$fdn."','".$fa."','".$a."')";
    $result = mysqli_query($conn,$q);
    if ( false===$result ) {
    printf("error");
    }
    else
    { 
      header("Location: soil_type.php");
      exit;
    }
  }
}
if(isset($_POST['st']))
{
  if($_POST["sfeel"]!=NULL && $_POST["ph"]!=NULL && $_POST["crop"]!=NULL && $_POST["ec"]!=NULL && $_POST["cc"]!=NULL)
  {
    $_SESSION["crop"]=$_POST["crop"];
    $q2="INSERT INTO `soiltype`(`aadharno`, `ph`, `ec`, `cc`) VALUES ('".$_SESSION["aadhar"]."','".$_POST["ph"]."','".$_POST["ec"]."','".$_POST["cc"]."')";
    mysqli_query($conn,$q2);
    header("Location: macronutrient.php");
    exit;
  }
}

#code for maconutrient calculations..
if(isset($_POST['macro']))
{
$sql = "SELECT * FROM whole_crops where crop_id='".$_SESSION["crop"]."'";
$results = mysqli_query($conn,$sql);
$ka=array();
$pa=array();
$na=array();
$c1=array();
$c2=array();
$c3=array();
$c4=array();
$c5=array();
$c6=array();
$c7=array();
$c8=array();
$c9=array();

if (mysqli_num_rows($results)) {
    while($row = mysqli_fetch_assoc($results)) {
        array_push($c1,$row["n_per_ac"]);
        array_push($c2,$row["n_kgs_per_ac"]);
        array_push($c3,$row["urea_kgs_per_ac"]);
        array_push($c4,$row["p_per_ac"]);
        array_push($c5,$row["p2o5_kgs_per_ac"]);
        array_push($c6,$row["sp_kgs_per_ac"]);
        array_push($c7,$row["k_per_ac"]);
        array_push($c8,$row["k2o_kgs_per_ac"]);
        array_push($c9,$row["potash_kgs_per_ac"]);
    }
} else {
    echo "0 results";
}
$y=0;
/*
while($y < count($c7))
{
  echo $c1[$y]." ".$c2[$y]." ".$c3[$y]." ".$c4[$y]." ".$c5[$y]." ".$c6[$y]." ".$c7[$y]." ".$c8[$y]." ".$c9[$y]."<br>";
  $y++;
}*/
if($_POST["n"]!=NULL && $_POST["p"]!=NULL && $_POST["k"]!=NULL)
{
    $nitrogen = $_POST["n"];
    $potash = $_POST["k"];
    $phosp = $_POST["p"];
//    echo $_POST["n"]." ".$_POST["k"]." ".$_POST["p"]."<br>";

    #converting titre value into nutrients/ac
    $n_per_ac = $nitrogen * 14 *2.5;
    $k_per_ac = $potash * 5;
    $p_per_ac = $phosp * 1.66;
  //  echo $n_per_ac." ".$k_per_ac." ".$p_per_ac."<br>";

    #initializing 
    $i=0;
    $j=0;
    $m=0;
    $u=0;
    $sp=0;
    $mop=0;

    #for n_per_ac with values
    while($i<count($c1))
    {
        if($n_per_ac == $c1[$i])
        {
            $u=$c1[$i];
            $urea=$c3[$i];
        }
        $i++;
    };
    while($j<count($c4))
    {
        if($p_per_ac == $c4[$j])
        {
            $sp=$c4[$j];
            $super_phosphate=$c6[$j];
        }
        $j++;
    };
    while($m < count($c7))
    {
        if($k_per_ac == $c7[$m])
        {
            $mop=$c7[$m];
            $muriate_of_potash=$c9[$m];
          }
        $m++;
    };

    #for n_per_ac without values i,e 0(zero)
    if($u==0){
    $i=0;
    while($i<count($c1))
    {
        if($n_per_ac > $c1[$i])
        {
          $u=$c1[$i];
          $urea=$c3[$i];
          $i=count($c1)-1;
        }
        $i++;
    };
  }
    if($sp==0){
      $j=0;
    while($j<count($c4))
    {
      if($p_per_ac < $c4[$j])
        {
          $sp=$c4[$j];
            $super_phosphate=$c6[$j];
            $j=count($c4)-1;
          }
        $j++;
    };
  }
    if($mop==0){
      $l=0;    
    while($l<count($c7))
    {
        if($k_per_ac > $c7[$l])
          {
              $mop=$c7[$l];
              $muriate_of_potash=$c9[$l];
              $l=count($c7)-1;
            }
        $l++;
    };
  }

}
$_SESSION["n"]=$nitrogen;
$_SESSION["p"]=$posph;
$_SESSION["k"]=$potash;
//echo $u." ".$urea." ".$sp." ".$super_phosphate." ".$mop." ".$muriate_of_potash."<br>";
$q3="INSERT INTO `intermediate`(`aadharno`, `ntr`, `nkgac`, `pmr`, `pkgac`, `kmr`, `kkgac`) VALUES ('".$nitrogen."','".$n_per_ac."','".$posph."','".$p_per_ac."','".$potash."','".$k_per_ac."')";
$res=mysqli_query($conn,$q3);
if(!$res){
header("Location: micronutrient.php");
exit;
}
}

#code for micronutrient calculations..
if(isset($_POST['micro']))
{
  echo "<br>".$_SESSION['crop'];
  if($_POST['fe']!=NULL && $_POST['mn']!=NULL && $_POST['zn']!=NULL && $_POST['cu']!=NULL)
  {
    echo $_POST['fe']." ".$_POST['mn']." ".$_POST['zn']." ".$_POST['cu']."<br>";

  }
/*  
$sql = "SELECT * FROM rice_developed_soil_readings";
$result = $conn->query($sql);
$i=0;
$j=0;
$k=0;
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $m1=$row["fe_3_7b_n"];
    $m2=$row["fe_3_7a_n"];
    $m3=$row["fe_6_3b_p"];
    $m4=$row["fe_6_3b_p"];
    $m5=$row["mn_2_0b"];
    $m6=$row["mn_2_0a"];
    $m7=$row["zn_1_2b"];
    $m8=$row["zn_1_2b"];
    $m9=$row["ca_1_2b"];
    $m10=$row["ca_1_2a"];  
  }
} else {
  echo "0 results";
}
if($_POST['fe']!=NULL && $_POST['mn']!=NULL && $_POST['cn']!=NULL && $_POST['zn']!=NULL)
{
  $fe=$_POST['fe'];
  $mn=$_POST['mn'];
  $cn=$_POST['cn'];
  $zn=$_POST['zn'];
  if($fe <= 3.7)
  {
    echo $m1;
  }
  else
  if($fe >= 3.7)
  {
    echo $m2;
  }
  else
  if($fe <= 6.3)
  {
    echo $m3;
  }
  else
  if($fe <= 6.3)
  {
    echo $m4;
  }
  if($mn <= 2.0)
  {
    echo $m5;
  }
  else{
    echo $m6;
  }
  if($cn <=1.2)
  {
    echo $m7;
  }
  else
  {
    echo $m8;
  }
  if($zn <= 1.2)
  {
    echo $m9;
  }
  else
  {
    echo $m10;
  }
}*/
//include "index.php";
}


#db close
$conn->close();

?>