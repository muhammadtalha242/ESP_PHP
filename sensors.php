<?php
include("php/dbconnect.php");
include("php/checklogin.php");
$errormsg = '';
$action = "add";

$iomode = '';
$pincount = '';
$name = '';
$type = '';
$id= '';
if(isset($_POST['save']))
{

$name = mysqli_real_escape_string($conn,$_POST['name']);
$type = mysqli_real_escape_string($conn,$_POST['type']);
$pincount = mysqli_real_escape_string($conn,$_POST['pincount']);
$iomode = mysqli_real_escape_string($conn,$_POST['iomode']);

 if($_POST['action']=="add")
 {
	// $res = $conn->query("SELECT Count ON ID FROM sensors");
  	$sql = $conn->query("INSERT INTO `sensors`( `name`, `type`, `pins_required`, `iomode`) VALUES ('$name','$type','$pincount','$iomode')");
    
	  echo '<script type="text/javascript">window.location="sensors.php?act=1";</script>';
 
 }else
  if($_POST['action']=="update")
 {
    $id = mysqli_real_escape_string($conn,$_POST['id']);	
    $sql = $conn->query("UPDATE  `sensors`  SET  `name`  = '$name', `type`  = '$type', `pins_required`  = '$pincount', `iomode` = '$iomode' WHERE `ID` = '$id'");
    echo '<script type="text/javascript">window.location="sensors.php?act=2";</script>';
 }



}




if(isset($_GET['action']) && $_GET['action']=="delete"){

$conn->query("UPDATE  sensors set delete_status = '1'  WHERE ID='".$_GET['id']."'");
header("location: sensors.php?act=3");

}


$action = "add";
if(isset($_GET['action']) && $_GET['action']=="edit" ){
$id = isset($_GET['id'])?mysqli_real_escape_string($conn,$_GET['id']):'';

$sqlEdit = $conn->query("SELECT * FROM sensors WHERE ID='$id'");
if($sqlEdit->num_rows)
{
$rowsEdit = $sqlEdit->fetch_assoc();
extract($rowsEdit);
$action = "update";
}else
{
$_GET['action']="";
}

}


if(isset($_REQUEST['act']) && @$_REQUEST['act']=="1")
{
$errormsg = "<div class='alert alert-success'><strong>Success!</strong> Sensor Add successfully</div>";
}else if(isset($_REQUEST['act']) && @$_REQUEST['act']=="2")
{
$errormsg = "<div class='alert alert-success'><strong>Success!</strong> Sensor Edit successfully</div>";
}
else if(isset($_REQUEST['act']) && @$_REQUEST['act']=="3")
{
$errormsg = "<div class='alert alert-success'><strong>Success!</strong> Sensor Delete successfully</div>";
}

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Egnion Yomi IOT</title>

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

    <script src="js/jquery-1.10.2.js"></script>



</head>
<?php
include("php/header.php");
?>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-head-line">Sensors
                    <?php
						echo (isset($_GET['action']) && @$_GET['action']=="add" || @$_GET['action']=="edit")?
						' <a href="sensors.php" class="btn btn-primary btn-sm pull-right">Back <i class="glyphicon glyphicon-arrow-right"></i></a>':'<a href="sensors.php?action=add" class="btn btn-primary btn-sm pull-right"><i class="glyphicon glyphicon-plus"></i> Add </a>';
						?>
                </h1>

                <?php

echo $errormsg;
?>
            </div>
        </div>



        <?php 
		 if(isset($_GET['action']) && @$_GET['action']=="add" || @$_GET['action']=="edit")
		 {
		?>

        <script type="text/javascript" src="js/validation/jquery.validate.min.js"></script>
        <div class="row">

            <div class="col-sm-8 col-sm-offset-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <?php echo ($action=="add")? "Add Sensor": "Edit Sensor"; ?>
                    </div>
                    <form action="sensors.php" method="post" id="signupForm1" class="form-horizontal">
                        <div class="panel-body">

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="Old">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="<?php echo $name;?>" />
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-sm-2 control-label"> Type </label>
                                <div class="col-sm-10">
                                    <select type='NEW' class="form-control" id="type" name="type">
                                        <option value="">--- Select ---</option>
                                        <option value=<?php echo $type = 0;?>>Analog</option>
                                        <option value=<?php echo $type = 1;?>>Digital</option>
                                        <option value=<?php echo $type = -1;?>>Communication</option>
                                    </select>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="Confirm">Pins Required</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="pincount"
                                        name="pincount"><?php echo $pincount;?></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">I/O Mode</label>
                                <div class="col-sm-10">
                                    <select iomode='NEW' class="form-control" id="iomode" name="iomode">
                                        <option value="">--- Select ---</option>
                                        <option value=<?php echo $iomode = 0;?>>Output</option>
                                        <option value=<?php echo $iomode = 1;?>>Input</option>
                                        <option value=<?php echo $iomode = -1;?>>I/O</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-8 col-sm-offset-2">
                                    <input type="hidden" name="id" value="<?php echo $id;?>">
                                    <input type="hidden" name="action" value="<?php echo $action;?>">
                                    <button type="submit" name="save" class="btn btn-primary">Save </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script type="text/javascript">
        $(document).ready(function() {
            if ($("#signupForm1").length > 0) {
                $("#signupForm1").validate({
                    rules: {
                        name: "required",
                        type: "required",
                        pincount: "required",
                        iomode: "required"
                    },
                    messages: {
                        name: "Please enter sensor name.",
                        pincount: "Please enter number of pins required.",
                        type: "Please select the sensor type.",
                        iomode: "Please select the I/O mode."
                    },
                    errorElement: "em",
                    errorPlacement: function(error, element) {
                        // Add the `help-block` class to the error element
                        error.addClass("help-block");
                        // Add `has-feedback` class to the parent div.form-group
                        // in order to add icons to inputs
                        element.parents(".col-sm-10").addClass("has-feedback");
                        if (element.prop("type") === "checkbox") {
                            error.insertAfter(element.parent("label"));
                        } else {
                            error.insertAfter(element);
                        }
                        // Add the span element, if doesn't exists, and apply the icon classes to it.
                        if (!element.next("span")[0]) {
                            $("<span class='glyphicon glyphicon-remove form-control-feedback'></span>")
                                .insertAfter(element);
                        }
                    },
                    success: function(label, element) {
                        // Add the span element, if doesn't exists, and apply the icon classes to it.
                        if (!$(element).next("span")[0]) {
                            $("<span class='glyphicon glyphicon-ok form-control-feedback'></span>")
                                .insertAfter($(element));
                        }
                    },
                    highlight: function(element, errorClass, validClass) {
                        $(element).parents(".col-sm-10").addClass("has-error").removeClass(
                            "has-success");
                        $(element).next("span").addClass("glyphicon-remove").removeClass(
                            "glyphicon-ok");
                    },
                    unhighlight: function(element, errorClass, validClass) {
                        $(element).parents(".col-sm-10").addClass("has-success").removeClass(
                            "has-error");
                        $(element).next("span").addClass("glyphicon-ok").removeClass(
                            "glyphicon-remove");
                    }
                });
            }
        });
        </script>

        <?php
		}else{
		?>
        <link href="css/datatable/datatable.css" rel="stylesheet" />
        <div class="panel panel-default">
            <div class="panel-heading">
                Manage Sensors
            </div>
            <div class="panel-body">
                <div class="table-sorting table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="tSortable22">
                        <thead>
                            <tr>
                                <th>Sr No.</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Pins Required</th>
                                <th>I/O Mode</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
									$sql = "SELECT * FROM sensors WHERE delete_status=0";
									$q = $conn->query($sql);
									$i=1;
									while($r = $q->fetch_assoc())
									{
										$temp = $r['type'];
										$temp2 = ($temp==0) ? 'Analog' : (($temp==1) ? 'Digital' : 'Communication');
										$temp = $r['iomode'];
										$temp3 = ($temp==0) ? 'Output' : (($temp==1) ? 'Input' : 'I/O');
									echo '<tr>
                                            <td>'.$i.'</td>
                                            <td>'.$r['name'].'</td>
                                            <td>'.$temp2.'</td>
                                            <td>'.$r['pins_required'].'</td>
											<td>'.$temp3.'</td>
											<td>
											<a href="sensors.php?action=edit&id='.$r['ID'].'" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-edit"></span></a>										
											<a onclick="return confirm(\'Are you sure you want to delete this record\');" href="sensors.php?action=delete&id='.$r['ID'].'" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span></a></td>
											</tr>';
										$i++;
									}
									?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <script src="js/dataTable/jquery.dataTables.min.js"></script>
        <script>
        $(document).ready(function() {
            $('#tSortable22').dataTable({
                "bPaginate": true,
                "bLengthChange": false,
                "bFilter": true,
                "bInfo": false,
                "bAutoWidth": true
            });

        });
        </script>

        <?php
		}
		?>
    </div>
    <!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->
</div>
<!-- /. WRAPPER  -->
<!-- BOOTSTRAP SCRIPTS -->
<script src="js/bootstrap.js"></script>
<!-- METISMENU SCRIPTS -->
<script src="js/jquery.metisMenu.js"></script>
<!-- CUSTOM SCRIPTS -->
<script src="js/custom1.js"></script>


</body>

</html>