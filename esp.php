<script src="js/canvasjs.min.js"></script>

<?php

//DEBUGGER

function debug_to_console($data)
{
	$output = $data;
	if (is_array($output)) {
		$output = implode(',', $output);
	}

	echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
};

include("php/dbconnect.php");
include("php/checklogin.php");
$errormsg = '';
$action = "add";
$tablerow = "";
$id = "";
$esp_name = '';
$esp_id = 2;
$connected = 0;
$SensorLabel = "";

//Unused
// $sname='';
$emailid = '';
$joindate = '';
$remark = '';
$contact = '';
$balance = 0;
$fees = '';
$about = '';
$branch = '';
$p_r = '';
$labelenter = '';
$pinselect = '';

if (isset($_POST['save'])) {

	$esp_name = mysqli_real_escape_string($conn, $_POST['esp_name']);



	if ($_POST['action'] == "add") {


		$q1 = $conn->query("INSERT INTO esp32 (eps_id,esp_name,connected) VALUES ('$esp_id','$esp_name','$connected')");

		echo '<script type="text/javascript">window.location="esp.php?act=1";</script>';
	} else
  if ($_POST['action'] == "update") {
		$id = mysqli_real_escape_string($conn, $_POST['id']);
		$sql = $conn->query("UPDATE  esp32  SET  esp_name  = '$esp_name' Where `ID`=$id");
		echo '<script type="text/javascript">window.location="esp.php?act=2";</script>';
	}
}




if (isset($_GET['action']) && $_GET['action'] == "delete") {

	$conn->query("UPDATE  esp32 set delete_status = '1'  WHERE id='" . $_GET['id'] . "'");
	header("location: esp.php?act=3");
}


$action = "add";
if (isset($_GET['action']) && $_GET['action'] == "edit") {
	$id = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : '';

	$sqlEdit = $conn->query("SELECT * FROM esp32 WHERE id='" . $id . "'");
	if ($sqlEdit->num_rows) {
		$rowsEdit = $sqlEdit->fetch_assoc();
		extract($rowsEdit);
		$action = "update";
	} else {
		$_GET['action'] = "";
	}
}


if (isset($_REQUEST['act']) && @$_REQUEST['act'] == "1") {
	$errormsg = "<div class='alert alert-success'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Success!</strong> ESP Add successfully</div>";
} else if (isset($_REQUEST['act']) && @$_REQUEST['act'] == "2") {
	$errormsg = "<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <strong>Success!</strong> ESP Edit successfully</div>";
} else if (isset($_REQUEST['act']) && @$_REQUEST['act'] == "3") {
	$errormsg = "<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Success!</strong> ESP Delete successfully</div>";
}

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="refresh" content="<?php echo $sec ?>;URL='<?php echo $page ?>'">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>egnion_yomi</title>

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

    <link href="css/ui.css" rel="stylesheet" />
    <link href="css/datepicker.css" rel="stylesheet" />

    <script src="js/jquery-1.10.2.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type='text/javascript' src='js/jquery/jquery-ui-1.10.1.custom.min.js'></script>
    <script>
    $(document).ready(function() {
        $('#sensoradd').click(function() {
            let selectedValue1 = $("#sensordropdown1 option:selected").val();
            let selectedValue2 = $("#sensordropdown2 option:selected").val();
            let selectedValue3 = document.getElementById("label").value;
            let selectedValue4 = $("#sensordropdown2 option:selected").text();
            if (selectedValue1 == "-1") {
                alert("Kindly Select a Sensor.");
            } else if (selectedValue2 == "-1" && selectedValue4 != "TX & RX") {
                alert("Kindly Select a pin.");
            } else if (selectedValue3 == "") {
                alert("Kindly provide a label for the sensor")
            } else {
                var ESPid = <?php echo $_GET['id'] ?>;
                var s = ESPid + " " + selectedValue1 + " " + selectedValue2 + " " + selectedValue3;
                $.post('./php/sensor_add.php', {
                    sensor: selectedValue1,
                    pin: selectedValue2,
                    label: selectedValue3,
                    espID: ESPid
                }, function(data) {
                    if (data == 0) {
                        alert("Sensor not added pins already in use by another sensor.")
                    } else {
                        document.getElementById("tSortable2").innerHTML += data;
                        alert("Sensor has been added to the Esp ID: " +
                            <?php echo $_GET['id'] ?> + ".")
                        document.getElementById("sensoradd").setAttribute("Disabled", "");
                    }
                });

            }
        });
    });
    </script>
    <script>
    $(document).ready(function() {
        $('#sensordropdown1').change(function() {
            //Selected value
            var inputValue = $(this).val();
            var ESPid = <?php echo $_GET['id'] ?>;
            $.post('./php/sensor_fill.php', {
                dropdownValue: inputValue,
                espID: ESPid
            }, function(data) {
                if (data != "") {
                    var s = String(data);
                    var S = s.split('-');
                    document.getElementById("type").innerHTML = S[0];
                    document.getElementById("p_r").innerHTML = S[1];
                    document.getElementById("iomode").innerHTML = S[2];
                    s = "";
                    for (var i = 3; i < S.length; i++) {
                        temp = S[i];
                        temp2 = S[++i];
                        s += "<option value=" + temp2 + ">" + temp + "</option>";
                    }
                    document.getElementById("sensordropdown2").removeAttribute("Disabled", "");
                    document.getElementById("sensoradd").removeAttribute("Disabled", "");
                    document.getElementById("sensordropdown2").innerHTML = s;
                    if (S[0] == "Communication") {
                        document.getElementById("sensordropdown2").setAttribute("Disabled", "");
                        document.getElementById("sensordropdown2").innerHTML =
                            "<option value=-2>" + "TX & RX" + "</option>";
                        document.getElementById("sensoradd").removeAttribute("Disabled", "");
                    }
                } else {
                    <?php echo $t1 = "" ?>
                    <?php echo $t1 = "" ?>
                    <?php echo $t3 = "" ?>
                }
            });
        });
    });
    </script>
    <script>
    $(document).ready(function() {
        $('input[type="checkbox"]').click(function() {
            console.log("Checkbox is checked.");


            let p_name = $(this).data('pin_name');
            let p_number = $(this).data('pin_number');

            let lbl = $(this).data('label');
            var ESPid = <?php echo $_GET['id'] ?>;
            let out = 0;
            if ($(this).is(":checked")) {
                out = 1;


            } else if ($(this).is(":not(:checked)")) {
                out = 0;
            }
            $.post("./php/output_controls.php", {
                pin_name: p_name,
                output: out,
                esp_id: ESPid
            }, function(data, status) {
                //alert("Data: " + data + "\nStatus: " + status);
            });
        });

        out = 0;

    });
    </script>
</head>
<?php
include("php/header.php");
?>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-head-line">ESP NODE
                    <?php
					echo (isset($_GET['action']) && @$_GET['action'] == "add" || @$_GET['action'] == "edit" || @$_GET['action'] == "view") ?
						' <a href="esp.php" class="btn btn-primary btn-sm pull-right">Back <i class="glyphicon glyphicon-arrow-right"></i></a>' : '<a href="esp.php?action=add" class="btn btn-primary btn-sm pull-right"><i class="glyphicon glyphicon-plus"></i> Add </a>';
					?>
                </h1>

                <?php

				echo $errormsg;
				?>
            </div>
        </div>

        <?php
		if (isset($_GET['action']) && @$_GET['action'] == "add" || @$_GET['action'] == "edit") {
		?>
        <script type="text/javascript" src="js/validation/jquery.validate.min.js"></script>
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <?php if ($action == "add") {
								echo "Add ESP";
							} else {
								$con = mysqli_connect("localhost", "root", "", "egnion_yomi");
								if (mysqli_connect_errno()) {
									echo "Failed to connect to MySQL: " . mysqli_connect_error();
								}
								$id = @$_GET['id'];
								$result = mysqli_query($con, "SELECT * FROM esp32 WHERE id=$id");
								while ($row = mysqli_fetch_array($result)) {
									$name = $row['esp_name'];
									echo ("Edit ESP: $name, ID: $id");
								}
							} ?>
                    </div>
                    <form action="esp.php" method="post" id="signupForm1" class="form-horizontal">
                        <div class="panel-body">
                            <fieldset class="scheduler-border">
                                <legend class="scheduler-border">ESP Information:</legend>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="Old">Name* </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="esp_name" name="esp_name"
                                            value="<?php echo $esp_name; ?>" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-8 col-sm-offset-2"
                                        style="display: -ms-flexbox!important; display:flex!important; -ms-flex-pack:center!important; justify-content:center!important;">
                                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                                        <input type="hidden" name="action" value="<?php echo $action; ?>">
                                        <button type="submit" name="save" class="btn btn-primary">Save </button>
                                    </div>
                                </div>
                            </fieldset>
                    </form>
                    <script type="text/javascript">
                    $(document).ready(function() {
                        if ($("#signupForm1").length > 0) {
                            $("#signupForm1").validate({
                                rules: {
                                    esp_name: "required",
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
                                    $(element).parents(".col-sm-10").addClass("has-error")
                                        .removeClass("has-success");
                                    $(element).next("span").addClass("glyphicon-remove")
                                        .removeClass("glyphicon-ok");
                                },
                                unhighlight: function(element, errorClass, validClass) {
                                    $(element).parents(".col-sm-10").addClass("has-success")
                                        .removeClass("has-error");
                                    $(element).next("span").addClass("glyphicon-ok").removeClass(
                                        "glyphicon-remove");
                                }
                            });
                        }
                    });
                    </script>
                    <?php if (isset($_GET['action']) && @$_GET['action'] == "edit") { ?>
                    <form action="esp.php" method="post" id="signupForm2" class="form-horizontal">
                        <div class="panel-body">
                            <fieldset class="scheduler-border">
                                <legend class="scheduler-border">Add Devices:</legend>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="Old">Sensor</label>
                                    <div class="col-sm-3">
                                        <select class="form-control" name=”sensordropdown1” id="sensordropdown1">
                                            <option value='-1'>Select Sensor</option>
                                            <?php
													$sql = "SELECT * FROM `sensors` WHERE delete_status = 0";
													$result = mysqli_query($conn, $sql);
													$i = 0;
													$type1 = '';
													$type2 = '';
													$type3 = '';
													$type4 = '';
													while ($row = mysqli_fetch_assoc($result)) {
													?>
                                            <option value='<?php echo $row['ID']; ?>'>
                                                <?php echo $row['name']; ?>
                                            </option>
                                            <?php
														if ($i == 0) {
															echo $type1 = $row['type'];
															echo $t1 = ($type1 == 0) ? 'Analog' : (($type1 == 1) ? 'Digital' : 'Communication');
															echo $type2 = $row['pins_required'];
															echo $type3 = $row['iomode'];
															echo $t3 = ($type3 == 0) ? 'Output' : (($type3 == 1) ? 'Input' : 'I/O');
														}
														?>
                                            <?php $i += 1;
													} ?>
                                        </select>
                                    </div>
                                    <label class="col-sm-2 control-label" for="Old">Add Label</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="label" name="label"
                                            value="<?= $labelenter; ?>" />
                                    </div>
                                    <label class="col-sm-1 control-label" for="Old">Pin</label>
                                    <div class="col-sm-2">
                                        <select class="form-control" name="sensordropdown2" id="sensordropdown2">
                                            <option value='-1'>Select Pin</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="Old">Type</label>
                                    <div class="col-sm-3">
                                        <div class="form-control" id="type" name="type"
                                            <?php echo ($action == "update") ? "Disabled" : (($action == "add") ? "Disabled" : ""); ?>>
                                            <?= $t1; ?>
                                        </div>
                                    </div>
                                    <label class="col-sm-2 control-label" for="Old">Pins Required</label>
                                    <div class="col-sm-1">
                                        <div class="form-control" id="p_r" name="p_r"
                                            <?php echo ($action == "update") ? "Disabled" : (($action == "add") ? "Disabled" : ""); ?>>
                                            <?= $type2; ?>
                                        </div>
                                    </div>
                                    <label class="col-sm-2 control-label" for="Old">I/O Mode</label>
                                    <div class="col-sm-2">
                                        <div class="form-control" id="iomode" name="iomode"
                                            <?php echo ($action == "update") ? "Disabled" : (($action == "add") ? "Disabled" : ""); ?>>
                                            <?= $t3; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-8 col-sm-offset-2"
                                        style="display: -ms-flexbox!important; display:flex!important; -ms-flex-pack:center!important; justify-content:center!important;">
                                        <div class="btn btn-primary" id="sensoradd">Add</div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </form>
                    <!--<script type="text/javascript">
                    $(document).ready(function() {

                    });-->
                    </script>
                    <link href="css/datatable/datatable.css" rel="stylesheet" />
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Manage Sensors
                        </div>
                        <div class="panel-body">
                            <div class="table-sorting table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="tSortable2">
                                    <thead>
                                        <tr>
                                            <th>Sr No.</th>
                                            <th>Sensor Name</th>
                                            <th>Sensor Label</th>
                                            <th>Type</th>
                                            <th>I/O Mode</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
												if (isset($_GET['action']) && @$_GET['action'] == "edit") {
													// $sql = "SELECT * FROM `sensors` INNER JOIN `connected_sensors` ON sensors.ID=connected_sensors.sensor_id INNER JOIN esp32 ON connected_sensors.esp_id = esp32.ID INNER JOIN sensors_data ON sensors.id=sensors_data.connected_sersor_id WHERE esp_id=$id";
													// SELECT * FROM `sensors` INNER JOIN `connected_sensors` ON sensors.ID=connected_sensors.ID INNER JOIN esp32 ON connected_sensors.esp_id = esp32.ID INNER JOIN sensors_data ON sensors.id=sensors_data.connected_sersor_id WHERE esp_id=11
													// SELECT * FROM `sensors_data` INNER JOIN `connected_sensors` ON sensors_data.connected_sersor_id=connected_sensors.ID INNER JOIN esp32 ON connected_sensors.esp_id = esp32.ID WHERE esp_id=11

													$sql = "SELECT * FROM `sensors` INNER JOIN `connected_sensors` ON sensors.ID=connected_sensors.sensor_id WHERE esp_id=$id";
													$q = $conn->query($sql);
													$i = 1;
													while ($r = $q->fetch_assoc()) {
														$temp = $r['type'];
														$temp2 = ($temp == 0) ? 'Analog' : 'Digital';
														$temp = $r['iomode'];
														$temp3 = ($temp == 0) ? 'Output' : 'Input';
														echo '<tr >
                                            <td>' . $i . '</td>
                                            <td>' . $r['name'] . '</td>
											<td>' . $r['label'] . '</td>
											<td>' . $temp2 . '</td>
											<td>' . $temp3 . '</td>
                                        </tr>';
														$i++;
													}
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
                            "bLengthChange": true,
                            "bFilter": true,
                            "bInfo": false,
                            "bAutoWidth": true
                        });

                    });
                    </script>
                </div>
                </form>
            </div>
        </div>
        <?php } ?>


        <!--Manage ESP change.-->
        <?php } else if (@$_GET['action'] != "view") { ?>
        <link href="css/datatable/datatable.css" rel="stylesheet" />
        <div class="panel panel-default">
            <div class="panel-heading">
                Manage ESP
            </div>
            <div class="panel-body">
                <div class="table-sorting table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="tSortable22">
                        <thead>
                            <tr>
                                <th>Sr No.</th>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
							$sql = "select * from esp32 where delete_status='0'";
							$q = $conn->query($sql);
							$i = 1;
							while ($r = $q->fetch_assoc()) {

								echo '<tr >
                                            <td>' . $i . '</td>
                                            <td>' . $r['esp_name'] . '</td>

											<td>								
											<a href="esp.php?action=edit&id=' . $r['id'] . '" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-edit"></span></a>
											
											<a onclick="return confirm(\'Are you sure you want to delete this record\');" href="esp.php?action=delete&id=' . $r['id'] . '" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span></a>
											<a href="esp.php?action=view&id=' . $r['id'] . '" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-eye-open"></span></a> </td>
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
                "bLengthChange": true,
                "bFilter": true,
                "bInfo": false,
                "bAutoWidth": true
            });

        });
        </script>
        <?php } ?>

        <!--view action change-->
        <?php if (isset($_GET['action']) && @$_GET['action'] == "view") { ?>
        <script type="text/javascript" src="js/validation/jquery.validate.min.js"></script>
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <?php
						$id = @$_GET['id'];
						echo ("ESP ID: $id");
						// $sql = "SELECT * FROM `sensors` INNER JOIN `connected_sensors` ON sensors.ID=connected_sensors.sensor_id WHERE esp_id=$id";
						// $sql = "SELECT * FROM `sensors` INNER JOIN `connected_sensors` ON sensors.ID=connected_sensors.sensor_id INNER JOIN esp32 ON connected_sensors.esp_id = esp32.ID INNER JOIN sensors_data ON sensors.id=sensors_data.connected_sersor_id WHERE esp_id=$id";

						$sql = "SELECT * FROM `sensors` INNER JOIN `connected_sensors` ON sensors.ID=connected_sensors.sensor_id INNER JOIN `used_pins` ON used_pins.connected_sersor_id=connected_sensors.ID INNER JOIN `pins` ON pins.ID=used_pins.pin_id WHERE esp_id=$id";


						$q = $conn->query($sql);

						?>
                    </div>
                    <div class='bg-danger text-white col-md-6 display-main' id='digital-input'>Digital-input</div>
                    <div class=' text-white col-md-6 display-main' id='analog-input'></div>
                    <form action="esp.php" method="post" id="signupForm1" class="form-horizontal">
                        <div class="panel-body">
                            <fieldset class="scheduler-border">
                                <legend class="scheduler-border">Digital Output:</legend>
                                <div class="form-group" id='digital-output'>

                                </div>
                            </fieldset>
                    </form>

                    <!-- <div class='bg-danger text-white col-sm-10 col-sm-offset-1 display-main' id='digital-output'> -->
                </div>

                <?php
				$i = 0;
				while ($r = $q->fetch_assoc()) {

					$typ = $r['type'];
					$Sensortype = ($typ == 0) ? 'Analog' : 'Digital';
					$iomode = $r['iomode'];
					$SensorIOMode = ($iomode == 0) ? 'Output' : 'Input';
					$SensorLabel = $r['label'];
					$connected_id = $r['connected_sersor_id'];
					$Connected_pin_name = $r['pin_name'];
					$Connected_pin_id = $r['pin_id'];
					$Connected_pin_number = $r['pin_number'];

					$i++;
					if ($typ == 1) {
						if ($iomode == 1) { ?>
                <script>
                var label = '<?php echo $SensorLabel; ?>'

                $(`<div class='digital_input_div'><button class='digital_input_btn' disabled></button> <span class='digital_input_span'>${label}</span> </div>`)
                    .appendTo("#digital-input");
                </script>
                <?php } else { ?>
                <script>
                // function test(event) {
                // 	console.log("Hereerree")
                // 	// $('.output_checkbox input[type=checkbox]').val();
                // 	console.log(event.target.attributes)

                // 	console.log(event.target.attributes['pin_id'])
                // 	console.log(event)
                // 	let pin_id = event.target.attributes['pin_id'];
                // 	let pin_name = event.target.attributes['pin_name'];
                // 	let pin_number = event.target.attributes['pin_number'];

                // 	let label = event.target.attributes['label'];
                // 	let output = 0;
                // 	if ($('input.output_checkbox').is(':checked')) {
                // 		console.log("inside checked Value : " + output);
                // 		output = 1;

                // 	}
                // 	console.log("outside checked Value : " + output);
                // 	$.post('./php/output_controls.php', {
                // 		pin_id: pin_id,
                // 		pin_name: pin_name,
                // 		pin_number: pin_number,
                // 		label: label,
                // 		output: output,
                // 		esp_id: '14'
                // 	}, function(data) {
                // 		console.log(data);
                // 		if (data == 0) {
                // 			alert("not updated")
                // 		} else {
                // 			alert("updated")
                // 		}
                // 	});
                // 	output = 0;

                // } -->

                var label = '<?php echo $SensorLabel; ?>'
                var pin_name = '<?php echo $Connected_pin_name; ?>'
                var pin_id = '<?php echo $Connected_pin_id; ?>'
                var pin_number = '<?php echo $Connected_pin_number; ?>'

                $(`<div class="form-group">
										<label class="col-sm-2 control-label" for="Old">${label} </label>
										<div class="col-sm-10">
										<label class='switch'><input class='output_checkbox' data-pin_name=${pin_name} data-pin_id=${pin_id} data-pin_number=${pin_number} data-label=${label}   type='checkbox' value='0'><span class='slider round'></span></label><span class='digital_output_span'></span>
											
										</div>
								</div>`).appendTo("#digital-output");
                // $(`<div class='digital_input_div'><label class='switch'><input class='output_checkbox' id=${pin_name} onClick='test()' type='checkbox' value='1'><span class='slider round'></span></label><span class='digital_output_span'>${label}</span></div>`)
                // .appendTo("#digital-output");
                </script>
                <?php } ?>
                <?php } else { ?>
                <script>
                var label = '<?php echo $SensorLabel; ?>'
                $(`<div id=${label} style='height: 300px; width:700px'></div>`).appendTo("#analog-input")


                function SimpleLineChart() {

                    var chart = new CanvasJS.Chart(label, {
                        animationEnabled: true,
                        theme: "light2",
                        title: {
                            text: label
                        },
                        axisY: {
                            includeZero: false
                        },
                        data: [{
                            type: "line",
                            dataPoints: [{
                                    y: 450
                                },
                                {
                                    y: 414
                                },
                                {
                                    y: 520,
                                    indexLabel: "highest",
                                    markerColor: "red",
                                    markerType: "triangle"
                                },
                                {
                                    y: 460
                                },
                                {
                                    y: 450
                                },
                                {
                                    y: 500
                                },
                                {
                                    y: 480
                                },
                                {
                                    y: 480
                                },
                                {
                                    y: 410,
                                    indexLabel: "lowest",
                                    markerColor: "DarkSlateGrey",
                                    markerType: "cross"
                                },
                                {
                                    y: 500
                                },
                                {
                                    y: 480
                                },
                                {
                                    y: 510
                                }
                            ]
                        }]
                    });
                    chart.render();

                }
                // $("#analog-input").load("C:\\Users\\Dexter\\Downloads\\Programs\\sample_chartjs\\examples\\10-dynamic-charts\\dynamic-multi-series-chart.html"); <
                SimpleLineChart();
                </script>


                <?php } ?>


                <?php } ?>


                <?php } ?>


            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
    <!--
        <div id="footer-sec">
            School Fees Payment System | Brought To You By : <a href="http://code-projects.org/"
                target="_blank">Code-Projects</a>
        </div>
-->

    <!-- BOOTSTRAP SCRIPTS -->
    <script src="js/bootstrap.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="js/jquery.metisMenu.js"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="js/custom1.js"></script>
    <!-- Canvas JS -->


    </body>

</html>