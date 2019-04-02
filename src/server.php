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
    $c_r=0;
    $c_st=0;
    $c_i=0;
    $c_md=0;
    $_SESSION["aadhar"]=$_POST["aadhar"];
    $q="select aadharno from registration";
    $result=mysqli_query($conn,$q);
    while($row=mysqli_fetch_assoc($result)){
      if($_POST["aadhar"]==$row["aadharno"]){
        $c_r++;
      }
    };
    if($c_r==0){
      sleep(2);
      header("Location: register.php");
      exit;
    }
    else
    if($c_r==1){
      sleep(2);
      header("Locaation: soil_type.php");
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
    while($row = mysqli_fetch_assoc($result)){
      $size = $row['COUNT(*)'];
    }
    $sno=$size+1;
    $fid=$_POST["fid"];
    $fn=$_POST["fname"];
    $fpn=$_POST["fpname"];
    $fa=$_POST["faddress"];
    $fdn=$_POST["doorno"];
    $fg=$_POST["fgender"];
    $sur=$_POST["snum"];
    $a=$_SESSION["aadhar"];
    //echo $sno." ".$_SESSION["aadhar"]." ".$_POST["fid"]." ".$_POST["fname"]." ".$_POST["fpname"]." ".$_POST["faddress"]." ".$_POST["doorno"]." ".$_POST["fgender"]." ".$_POST["snum"]." ".$_SESSION["aadhar"]." ".$_POST["fgender"];
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
#end of reg section

#code for soil type module
if(isset($_POST['st']))
{
  if($_POST["sfeel"]!=NULL && $_POST["ph"]!=NULL && $_POST["crop"]!=NULL && $_POST["ec"]!=NULL && $_POST["cc"]!=NULL)
  {
    //  $_SESSION["cc"]=$_POST["cc"];
    $crops1=array();    
    foreach($_POST['crop'] as $crops) {
      array_push($crops1,$crops); 
    }
//    echo $crops1[0].",".$crops1[1]."<br>";
    if(count($crops1)==1)
    {
    $_SESSION["crop"]=$crops1[0];
    $q2="INSERT INTO `soiltype`(`aadharno`, `ph`, `ec`, `cc`, `crop_id`) VALUES ('".$_SESSION["aadhar"]."','".$_POST["ph"]."','".$_POST["ec"]."','".$_POST["cc"]."','".$crops1[0]."')";
    mysqli_query($conn,$q2);
    }
    else
    if(count($crops1)==2){
      $crops=explode(',',$_POST["crop"]);
      $crop1=(int)$crops1[0];
      $_SESSION["crop"]=$crops1[0];
      $crop2=(int)$crops1[1];
      $_SESSION["crop1"]=$crops1[1];
      $q16="INSERT INTO `soiltype`(`aadharno`, `ph`, `ec`, `cc`, `crop_id`) VALUES ('".$_SESSION["aadhar"]."','".$_POST["ph"]."','".$_POST["ec"]."','".$_POST["cc"]."','".$crop1."')";
      mysqli_query($conn,$q16);
      $q17="INSERT INTO `soiltype`(`aadharno`, `ph`, `ec`, `cc`, `crop_id`) VALUES ('".$_SESSION["aadhar"]."','".$_POST["ph"]."','".$_POST["ec"]."','".$_POST["cc"]."','".$crop2."')";
      mysqli_query($conn,$q17);
    }
    else
    if(count($crops1)==3){
      $crops=explode(',',$_POST["crop"]);
      $crop1=(int)$crops1[0];
      $_SESSION["crop"]=$crops1[0];
      $crop2=(int)$crops1[1];
      $_SESSION["crop1"]=$crops1[1];
      $crop3=(int)$crops1[2];
      $_SESSION["crop2"]=$crops1[2];
      $q18="INSERT INTO `soiltype`(`aadharno`, `ph`, `ec`, `cc`, `crop_id`) VALUES ('".$_SESSION["aadhar"]."','".$_POST["ph"]."','".$_POST["ec"]."','".$_POST["cc"]."','".$crop1."')";
      mysqli_query($conn,$q18);
      $q19="INSERT INTO `soiltype`(`aadharno`, `ph`, `ec`, `cc`, `crop_id`) VALUES ('".$_SESSION["aadhar"]."','".$_POST["ph"]."','".$_POST["ec"]."','".$_POST["cc"]."','".$crop2."')";
      mysqli_query($conn,$q19);
      $q20="INSERT INTO `soiltype`(`aadharno`, `ph`, `ec`, `cc`, `crop_id`) VALUES ('".$_SESSION["aadhar"]."','".$_POST["ph"]."','".$_POST["ec"]."','".$_POST["cc"]."','".$crop3."')";
      mysqli_query($conn,$q20);
    }
    header("Location: macronutrient.php");
    exit;
    }
}
#end of st section


#code for maconutrient calculations..
if(isset($_POST['macro']))
{
  $crop=array();
  $q9="SELECT crop_id from soiltype where aadharno='".$_SESSION["aadhar"]."'";
  $resu=mysqli_query($conn,$q9);
  while($row5=mysqli_fetch_assoc($resu))
  {
  array_push($crop,$row5["crop_id"]);
  }
  if(count($crop)==1){
    $sql = "SELECT * FROM whole_crops where crop_id='".$crop[0]."'";
  }
  else
  if(count($crop)==2){
    $sql = "SELECT * FROM whole_crops where crop_id='".$crop[0]."' or crop_id='".$crop[1]."'";
  }
  else
  if(count($crop)==3){
    $sql = "SELECT * FROM whole_crops where crop_id='".$crop[0]."' or crop_id='".$crop[1]."' or crop_id='".$crop[2]."'";
  }
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
$q15="SELECT cc from soiltype where aadharno='".$_SESSION["aadhar"]."'";
$result6=mysqli_query($conn,$q15);
$row10=mysqli_fetch_assoc($result6);
$cc=$row10["cc"];
/*
while($y < count($c7))
{
  echo $c1[$y]." ".$c2[$y]." ".$c3[$y]." ".$c4[$y]." ".$c5[$y]." ".$c6[$y]." ".$c7[$y]." ".$c8[$y]." ".$c9[$y]."<br>";
  $y++;
}*/
$o=0;
if($_POST["n"]!=NULL && $_POST["p"]!=NULL && $_POST["k"]!=NULL && $cc=="null")
{
  while($o<=count($crop))
  {
    $nitrogen = $_POST["n"];//From 1.2 to 3.6
    $potash = $_POST["k"];
    $phosp = $_POST["p"];
    //    echo $_POST["n"]." ".$_POST["k"]." ".$_POST["p"]."<br>";

    #converting titre value into nutrients/ac
    $n_per_ac = floor($nitrogen*14*2.5);
    $k_per_ac = $potash * 5;//0.6024096385542169 to 15.06024096385542
    $p_per_ac = $phosp * 1.66;
    //  echo $n_per_ac." ".$k_per_ac." ".$p_per_ac."<br>";

    #initializing 
    $i=0;
    $j=0;
    $m=0;
    $u=0;
    $sp=0;
    $mop=0;


    echo "<br>".count($c1)." ".count($c4)." ".count($c7)."<br>";
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
    if($u==0)
    {
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
    if($sp==0)
    {
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
    if($mop==0)
    {
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
  $o++;
  echo $u." ".$urea." ".$sp." ".$super_phosphate." ".$mop." ".$muriate_of_potash."<br>";
  }
}
/*
$_SESSION["urea"]=$urea;
$_SESSION["su_phos"]=$super_phosphate;
$_SESSION["mop"]=$muriate_of_potash;
$_SESSION["n"]=$nitrogen;
$_SESSION["p"]=$phosp;
$_SESSION["k"]=$potash;
*/
//echo $u." ".$urea." ".$sp." ".$super_phosphate." ".$mop." ".$muriate_of_potash."<br>";
//$q3="INSERT INTO `intermediate`(`aadharno`, `ntr`, `nkgac`, `pmr`, `pkgac`, `kmr`, `kkgac`) VALUES ('".$_SESSION["aadhar"]."','".$nitrogen."','".$n_per_ac."','".$phosp."','".$p_per_ac."','".$potash."','".$k_per_ac."')";
//$res=mysqli_query($conn,$q3);
//}
if($_POST["n"]!=NULL && $_POST["p"]!=NULL && $_POST["k"]!=NULL && ($cc=="moderate" || $cc=="profused"))
{
    $nitrogen = $_POST["n"];
    $potash = $_POST["k"];
    $phosp = $_POST["p"];

  echo "entered cc moderate or profused";
}
/*
//header("Location: micronutrient.php");
//exit;
*/
}

#code for micronutrient calculations..
if(isset($_POST['micro']))
{
  $q14="SELECT crop_id from soiltype where aadharno='".$_SESSION["aadhar"]."'";
  $result2=mysqli_query($conn,$q14);
  $row8=mysqli_fetch_assoc($result2);
  $crop=$row8["crop_id"];
//  echo "<br>".$_SESSION['crop'];
  $q4="SELECT * FROM micro WHERE crop_id='".$crop."'";
  $r=mysqli_query($conn,$q4);
  if ($r->num_rows > 0) {
    while($row = $r->fetch_assoc()) {
      $m1=$row["fe_3_7_ppm"];
      $m2=$row["fe_6_3_ppm"];
      $m3=$row["zn_1_2b_ppm"];
      $m4=$row["zn_1_2a_ppm"];
      $m5=$row["mn_2_0b_ppm"];
      $m6=$row["mn_2_0a_ppm"];
      $m7=$row["cu_1_2b_ppm"];
      $m8=$row["cu_1_2a_ppm"];
      $m9=$row["b_0_5b_ppm"];
      $m10=$row["b_0_5a_ppm"];
      $m11=$row["sod_mal"];  
    }
  } else {
    echo "0 results";
  }  
  if($_POST['fe']!=NULL && $_POST['mn']!=NULL && $_POST['zn']!=NULL && $_POST['cu']!=NULL)
  {
    //echo $_POST['fe']." ".$_POST['mn']." ".$_POST['zn']." ".$_POST['cu']."<br>";
    $fe=$_POST['fe'];
    $mn=$_POST['mn'];
    $cu=$_POST['cu'];
    $zn=$_POST['zn'];
    $cc1="";
    //echo $_SESSION["aadhar"];
    $q10="SELECT cc from soiltype where aadharno='".$_SESSION["aadhar"]."'";
    if($resul=mysqli_query($conn,$q10)){
    while($row6=mysqli_fetch_assoc($resul)){
    $cc1.=$row6["cc"];
  };
}
    //echo "......".$cc1;
    if(($fe <= 3.7 && $cc1=="null") || ($fe <= 6.3 && ($cc1=="moderate" || $cc1=="profused")))
    {
      $f=$m1;
    }
    else
    if(($fe > 3.7 && $cc1=="null") || ($fe <= 6.3 && ($cc1=="moderate" || $cc1=="profused")))
    {
      $f=$m2;
    }
    if($mn <= 2.0)
    {
      $m=$m3;
    }
    else{
      $m=$m4;
    }
    if($cu <=1.2)
    {
      $c=$m5;
    }
    else
    {
      $c=$m6;
    }
    if($zn <= 1.2)
    {
      $z=$m7;
    }
    else
    {
      $z=$m8;
    }
  }
  $q5="INSERT INTO `miningdata`(`aadhar`, `crop_id`, `n`, `p`, `k`, `fe`, `mn`, `zn`, `cu`) VALUES ('".$_SESSION["aadhar"]."','".$_SESSION["crop"]."','".$_SESSION["n"]."','".$_SESSION["p"]."','".$_SESSION["k"]."','".$f."','".$m."','".$c."','".$z."')";
  $re=mysqli_query($conn,$q5);
  $q12="SELECT ph FROM soiltype WHERE aadharno='".$_SESSION["aadhar"]."'";
  if($result1=mysqli_query($conn,$q12)){
    while($row7=mysqli_fetch_assoc($result1)){
      $ph1=$row7["ph"];
    };
  }
  if($ph1<6.5){
    $q13="SELECT sod_mal FROM micro WHERE crop_id='".$crop."'";
    $result3=mysqli_query($conn,$q13);
    while($row9=mysqli_fetch_assoc($result3)){
      $sod=$row9["sod_mal"];
    };
  }
  echo "Urea Needed ->".$_SESSION["urea"]."<br>Super Phosphate Needed ->".$_SESSION["su_phos"]."<br>Muriate Of Potash Needed ->".$_SESSION["mop"]."<br>Ferrous Sulphate Needed ->".$f."<br>Manganese Sulphate Needed ->".$m."<br>Cupprous Sulphate Needed ->".$c."<br>Ziinc Sulphate Needed ->".$z."<br>Sodium Maliphate Needed ->".$sod;
  //$q11="INSERT INTO `final`(`rno`, `aadharno`, `urea`, `ammosul`, `suphos`, `muratepot`, `complex`, `fesul`, `mangsul`, `zincsul`, `cupsul`, `borax`, `sodmali`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11],[value-12],'".$sod."')";

//  echo "data inserted successfully";
  }

#db close
$conn->close();

?>