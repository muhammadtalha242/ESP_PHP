<?php
include("php/dbconnect.php");
include("php/checklogin.php");
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <style>


    </style>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Egnion Yomi</title>

    <!-- BOOTSTRAP STYLES-->
    <link href="css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="css/font-awesome.css" rel="stylesheet" />
    <!--CUSTOM BASIC STYLES-->
    <link href="css/basic.css" rel="stylesheet" />
    <!--CUSTOM MAIN STYLES-->
    <link href="css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />


</head>
<?php
include("php/header.php");
?>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-head-line">DASHBOARD</h1>
                <h2 style="text-align:center;"> Welcome to <strong>Egnion Yomi</strong> </h2>

            </div>
        </div>
        <!-- /. ROW  -->
        <div class="row" style="
                                display: -ms-flexbox!important;
                                display:flex!important;
                                -ms-flex-pack:center!important;
                                justify-content:center!important;">

            <div class=" col-md-4">
                <div class="main-box mb-pink">
                    <a href="esp.php">
                        <i class="fa fa-users fa-5x"></i>
                        <h5>ESP_Node</h5>
                    </a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="main-box mb-red">
                    <a href="sensors.php">
                        <i class="fa fa-cogs fa-5x"></i>
                        <h5>Sensors</h5>
                    </a>
                </div>
            </div>
        </div>
        <!-- /. ROW  -->


    </div>
    <!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->
</div>
<!-- /. WRAPPER  -->


<script src="js/jquery-1.10.2.js"></script>
<!-- BOOTSTRAP SCRIPTS -->
<script src="js/bootstrap.js"></script>
<!-- METISMENU SCRIPTS -->
<script src="js/jquery.metisMenu.js"></script>
<!-- CUSTOM SCRIPTS -->
<script src="js/custom1.js"></script>
</body>

</html>