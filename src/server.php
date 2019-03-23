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
        $q60="select aadharno from soiltype";
        $result20=mysqli_query($conn,$q60);
        while($row20=mysqli_fetch_assoc($result20)){
          if($_POST["aadhar"]==$row20["aadharno"]){
            $c_st++;
          }
        };
        $q7="select aadharno from intermediate";
        $result3=mysqli_query($conn,$q7);
        while($row3=mysqli_fetch_assoc($result3)){
          if($_POST["aadhar"]==$row3["aadharno"]){
            $c_i++;
          }
        };
        $q8="select aadhar from miningdata";
        $result5=mysqli_query($conn,$q8);
        while($row4=mysqli_fetch_assoc($result5)){
          if($_POST["aadhar"]==$row4["aadharno"]){
            $c_md++;
          }
        };
        //echo $c_r." ".$c_st." ".$c_i." ".$c_md."<br>";
        if($c_r >= 1 && $c_st == $c_r && $c_i == $c_st && $c_md < $c_i)
        {
          sleep(2);
        //  echo "1 1 1 0";
          header("Location: micronutrient.php");
          exit;
        }
        else
        if($c_r >= 1 && $c_st == $c_r && $c_i < $c_st)
        {
          sleep(2);
        //  echo "1 1 0 0";
          header("Location: macronutrient.php");
          exit;
        }
        else
        if($c_r==1 && $c_st < $c_r)
        {
          sleep(2);
        //  echo "1 0 0 0";
          header("Location: soil_type.php");
          exit;
        }
        else
        if($c_r==0){
          sleep(2);
        //  echo "0 0 0 0";
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

    $_SESSION["cc"]=$_POST["cc"];
    $q2="INSERT INTO `soiltype`(`aadharno`, `ph`, `ec`, `cc`, `crop_id`) VALUES ('".$_SESSION["aadhar"]."','".$_POST["ph"]."','".$_POST["ec"]."','".$_POST["cc"]."','".$_POST["crop"]."')";
    mysqli_query($conn,$q2);
    header("Location: macronutrient.php");
    exit;
    }
}

#code for maconutrient calculations..
if(isset($_POST['macro']))
{
  $q9="SELECT crop_id from soiltype where aadharno='".$_SESSION["aadhar"]."'";
  $resu=mysqli_query($conn,$q9);
  $row5=mysqli_fetch_assoc($resu);
  $crop=$row5["crop_id"];
$sql = "SELECT * FROM whole_crops where crop_id='".$crop."'";
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
$_SESSION["urea"]=$urea;
$_SESSION["su_phos"]=$super_phosphate;
$_SESSION["mop"]=$muriate_of_potash;
$_SESSION["n"]=$nitrogen;
$_SESSION["p"]=$phosp;
$_SESSION["k"]=$potash;
//echo $u." ".$urea." ".$sp." ".$super_phosphate." ".$mop." ".$muriate_of_potash."<br>";
$q3="INSERT INTO `intermediate`(`aadharno`, `ntr`, `nkgac`, `pmr`, `pkgac`, `kmr`, `kkgac`) VALUES ('".$_SESSION["aadhar"]."','".$nitrogen."','".$n_per_ac."','".$phosp."','".$p_per_ac."','".$potash."','".$k_per_ac."')";
$res=mysqli_query($conn,$q3);

header("Location: micronutrient.php");
exit;

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