<body>
<?php 
    include "header.php";

?>
<div class="container">
<form method="post" action="server.php">

<!--
     onsubmit="stverify()"
        <script type="text/javascript">
    function stverify(){
    }
    </script>
 -->
            <div class="container">
            <div class="col-sm-4">
            <label>Holding feel of soil : </label>
            </div>
            <div class="col-sm-5">
            <select name="sfeel">
            <option name="sfeel" value="Sandy clay loam">Granules present & Clay texture</option>
            <option name="sfeel" value="Clay loam">No Granules Present & Clay texture</option>
            </select>
            </div>
            </div>
            <div class="container">
            <div class="col-sm-4">
            <label>pH of soil : </label>
            </div>
            <div class="col-sm-5">
            <input type="text" maxlength="20" name="ph" placeholder="Enter the acquired pH value"/>
            </div>
            </div>
            <div class="container">
            <div class="col-sm-2">
            <label>EC (dSm<sup>-1</sup>):</label>
            </div>
            <div class="col-sm-5">
            <input type="text" id="ec" name="ec" maxlength="20" placeholder="" required>
            </div>
            </div>
            <div class="container">
            <div class="container">
            <h3 style="color:white;">Crops</h3>
            </div>
            </div>
            <div class="container">
                    <label style="text-align:left;">Select crops preffered:
                    </label>
                </div>
                <div class="container">
                <div class="col-sm-1">
                <div class="checkbox">
                    <label style="color:white;"><input type="checkbox" name="crop" value="1"> Rice</label>
                    </label></div>
                </div>
                <div class="col-sm-1">
                <div class="checkbox">
                <label style="color:white;"><input type="checkbox" name="crop" value="2"> Maize
                </label></div>
                </div>
                <div class="col-sm-2">
                <div class="checkbox">
                <label style="color:white;"><input type="checkbox" name="crop" value="3"> Cholam
                </label></div>
                </div>
                <div class="col-sm-2">
                <div class="checkbox">
                <label style="color:white;"><input type="checkbox" name="crop" value="4"> Ragi
                </label></div>
                </div>                
                <div class="col-sm-2">
                <div class="checkbox">
                <label style="color:white;"><input type="checkbox" name="crop" value="5"> Cumbu
                </label></div>
                </div>
                <div class="col-sm-1">
                <div class="checkbox">
                <label style="color:white;"><input type="checkbox" name="crop" value="6"> Groundnut
                </label></div>
                </div>
                <div class="col-sm-2">
                <div class="checkbox">
                <label style="color:white;"><input type="checkbox" name="crop" value="7"> Coconut(Tall)
                </label></div>
                </div>
                <div class="col-sm-2">
                <div class="checkbox">
                <label style="color:white;"><input type="checkbox" name="crop" value="8"> Coconut(Hybrid)
                </label></div>
                </div>                
                <div class="col-sm-2">
                <div class="checkbox">
                <label style="color:white;"><input type="checkbox" name="crop" value="10"> Cotton
                </label></div>
                </div>                
                <div class="col-sm-2">
                <div class="checkbox">
                <label style="color:white;"><input type="checkbox" name="crop" value="11"> Cotton(Hybrid)
                </label></div>
                </div>                
                <div class="col-sm-2">
                <div class="checkbox">
                <label style="color:white;"><input type="checkbox" name="crop" value="12"> Sugarcane(mill)
                </label></div>
                </div>                
                <div class="col-sm-2">
                <div class="checkbox">
                <label style="color:white;"><input type="checkbox" name="crop" value="13"> Sugarcane(Jaggery)
                </label></div>
                </div>                
                <div class="col-sm-2">
                <div class="checkbox">
                <label style="color:white;"><input type="checkbox" name="crop" value="14"> Banana(RNR)
                </label></div>
                </div>                
                <div class="col-sm-2">
                    <div class="checkbox">
                    <label style="color:white;"><input type="checkbox" name="crop" value="15"> Banana(PNR)
                    </label></div>
                </div>                
                <div class="col-sm-2">
                <div class="checkbox">
                <label style="color:white;"><input type="checkbox" name="crop" value="16"> Banana(Red)
                </label></div>
                </div>
                <div class="col-sm-2">
                <div class="checkbox">
                <label style="color:white;"><input type="checkbox" name="crop" value="17"> Chillis
                </label></div>
                </div>
                <div class="col-sm-2">
                <div class="checkbox">
                <label style="color:white;">
                    <input type="checkbox" name="crop" value="18"> Topiaco</label>
                    </div>
                </div>
                </div>
            <div class="container">
            <div class="col-sm-3">
                    <label style="text-align:left;">Calcium Carbonate (Barehand Test):
                    </label>
                </div>
                <div class="col-sm-1">
                    <input type="radio" name="cc" value="null" checked> Null
                </div>
                <div class="col-sm-2">
                    <input type="radio" name="cc"value="moderate"> Moderate
                </div>
                <div class="col-sm-2">
                    <input type="radio" name="cc"value="profused"> Profused
                </div>
            </div>
            <div class="container">
            <input type="submit" value="submit" name="st">
    </form>
    </div>
</body>