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

$id = "";
$esp_name = '';
$esp_id = 2;
$connected = 0;


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


if (isset($_POST['save'])) {

	$esp_name = mysqli_real_escape_string($conn, $_POST['esp_name']);



	if ($_POST['action'] == "add") {
	

		$q1 = $conn->query("INSERT INTO esp32 (eps_id,esp_name,connected) VALUES ('$esp_id','$esp_name','$connected')");

		  $sid = $conn->insert_id;

		 $conn->query("INSERT INTO  fees_transaction (stdid,paid,submitdate,transcation_remark) VALUES ('$sid','$advancefees','$joindate','$remark')") ;

		echo '<script type="text/javascript">window.location="student.php?act=1";</script>';
	} else
  if ($_POST['action'] == "update") {
		$id = mysqli_real_escape_string($conn, $_POST['id']);
		$sql = $conn->query("UPDATE  esp32  SET  esp_name  = '$esp_name'");
		echo '<script type="text/javascript">window.location="student.php?act=2";</script>';
	}
}




if (isset($_GET['action']) && $_GET['action'] == "delete") {

	$conn->query("UPDATE  esp32 set delete_status = '1'  WHERE id='" . $_GET['id'] . "'");
	header("location: student.php?act=3");
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
	$errormsg = "<div class='alert alert-success'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Success!</strong> Student Add successfully</div>";
} else if (isset($_REQUEST['act']) && @$_REQUEST['act'] == "2") {
	$errormsg = "<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <strong>Success!</strong> Student Edit successfully</div>";
} else if (isset($_REQUEST['act']) && @$_REQUEST['act'] == "3") {
	$errormsg = "<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Success!</strong> Student Delete successfully</div>";
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

	<script type='text/javascript' src='js/jquery/jquery-ui-1.10.1.custom.min.js'></script>


</head>
<?php
include("php/header.php");
?>
<div id="page-wrapper">
	<div id="page-inner">
		<div class="row">
			<div class="col-md-12">
				<h1 class="page-head-line">ESP_NODE
					<?php
					echo (isset($_GET['action']) && @$_GET['action'] == "add" || @$_GET['action'] == "edit" || @$_GET['action'] == "view") ?
						' <a href="student.php" class="btn btn-primary btn-sm pull-right">Back <i class="glyphicon glyphicon-arrow-right"></i></a>' : '<a href="student.php?action=add" class="btn btn-primary btn-sm pull-right"><i class="glyphicon glyphicon-plus"></i> Add </a>';
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
							<?php echo ($action == "add") ? "Add ESP" : "Edit ESP"; ?>
						</div>
						<form action="student.php" method="post" id="signupForm1" class="form-horizontal">
							<div class="panel-body">
								<fieldset class="scheduler-border">
									<legend class="scheduler-border">ESP Information:</legend>
									<div class="form-group">
										<label class="col-sm-2 control-label" for="Old">Name* </label>
										<div class="col-sm-10">
											<input type="text" class="form-control" id="esp_name" name="esp_name" value="<?php echo $esp_name; ?>" />
										</div>
									</div>
									<!-- <div class="form-group">
								<label class="col-sm-2 control-label" for="Old">Contact* </label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="contact" name="contact" value="<?php echo $contact; ?>" maxlength="10" />
								</div>
							</div>
							 -->
									<!-- <div class="form-group">
								<label class="col-sm-2 control-label" for="Old">Branch* </label>
								<div class="col-sm-10">
									<select  class="form-control" id="branch" name="branch" >
									<option value="" >Select Branch</option>
                                    <!-- <?php
											// $sql = "select * from branch where delete_status='0' order by branch.branch asc";
											// $q = $conn->query($sql);

											// while($r = $q->fetch_assoc())
											// {
											// echo '<option value="'.$r['id'].'"  '.(($branch==$r['id'])?'selected="selected"':'').'>'.$r['branch'].'</option>';
											// }
											?>									 
									
									</select>
								</div>
						</div> -->

									<!-- 						
						<div class="form-group">
								<label class="col-sm-2 control-label" for="Old">DOJ* </label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="joindate" name="joindate" value="<?php echo ($joindate != '') ? date("Y-m-d", strtotime($joindate)) : ''; ?>" style="background-color: #fff;" readonly />
								</div>
							</div>-->

								</fieldset>


								<!-- <fieldset class="scheduler-border" >
						 <legend  class="scheduler-border">Fee Information:</legend>
						<div class="form-group">
								<label class="col-sm-2 control-label" for="Old">Total Fees* </label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="fees" name="fees" value="<?php echo $fees; ?>" <?php echo ($action == "update") ? "disabled" : ""; ?>  />
								</div>
						</div>
						
						<?php
						if ($action == "add") {
						?>
						<div class="form-group">
								<label class="col-sm-2 control-label" for="Old">Advance Fee* </label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="advancefees" name="advancefees" readonly   />
								</div>
						</div>
						<?php
						}
						?>
						
						<div class="form-group">
								<label class="col-sm-2 control-label" for="Old">Balance </label>
								<div class="col-sm-10">
									<input type="text" class="form-control"  id="balance" name="balance" value="<?php echo $balance; ?>" disabled />
								</div>
						</div>
						
						
						
							
							<?php
							if ($action == "add") {
							?>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="Password">Fee Remark </label>
								<div class="col-sm-10">
	                        <textarea class="form-control" id="remark" name="remark"><?php echo $remark; ?></textarea >
								</div>
							</div>
						<?php
							}
						?>
							
							</fieldset>
							
							 <fieldset class="scheduler-border" >
						 <legend  class="scheduler-border">Optional Information:</legend>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="Password">About Student </label>
								<div class="col-sm-10">
	                        <textarea class="form-control" id="about" name="about"><?php echo $about; ?></textarea >
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-2 control-label" for="Old">Email Id </label>
								<div class="col-sm-10">
									
									<input type="text" class="form-control" id="emailid" name="emailid" value="<?php echo $emailid; ?>"  />
								</div>
						    </div>
							</fieldset>
						
						
                            </div> -->
								<div class="form-group">
									<div class="col-sm-8 col-sm-offset-2">
										<input type="hidden" name="id" value="<?php echo $id; ?>">
										<input type="hidden" name="action" value="<?php echo $action; ?>">

										<button type="submit" name="save" class="btn btn-primary">Save </button>



									</div>
								</div>





							</div>
						</form>

					</div>

				</div>




				<script type="text/javascript">
					$(document).ready(function() {

								// 		$( "#joindate" ).datepicker({
								// dateFormat:"yy-mm-dd",
								// changeMonth: true,
								// changeYear: true,
								// yearRange: "1970:<?php echo date('Y'); ?>"
								// });	



								if ($("#signupForm1").length > 0) {

									<?php if ($action == 'add') {
									?>

										$("#signupForm1").validate({
												rules: {
													esp_name: "required",
													// joindate: "required",
													// emailid: "email",
													// branch: "required",


													// contact: {
													// 	required: true,
													// 	digits: true
													// },

													// fees: {
													// 	required: true,
													// 	digits: true
													// },


													// advancefees: {
													// 	required: true,
													// 	digits: true
													// },


												},
											<?php
										} else {
											?>

												$("#signupForm1").validate({
													rules: {
														esp_name: "required",
														// sname: "required",
														// joindate: "required",
														// emailid: "email",
														// branch: "required",


														// contact: {
														// 	required: true,
														// 	digits: true
														// }

													},



												<?php
											}
												?>

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
														$("<span class='glyphicon glyphicon-remove form-control-feedback'></span>").insertAfter(element);
													}
												},
												success: function(label, element) {
													// Add the span element, if doesn't exists, and apply the icon classes to it.
													if (!$(element).next("span")[0]) {
														$("<span class='glyphicon glyphicon-ok form-control-feedback'></span>").insertAfter($(element));
													}
												},
												highlight: function(element, errorClass, validClass) {
													$(element).parents(".col-sm-10").addClass("has-error").removeClass("has-success");
													$(element).next("span").addClass("glyphicon-remove").removeClass("glyphicon-ok");
												},
												unhighlight: function(element, errorClass, validClass) {
													$(element).parents(".col-sm-10").addClass("has-success").removeClass("has-error");
													$(element).next("span").addClass("glyphicon-ok").removeClass("glyphicon-remove");
												}
												});

											}

										});



								// $("#fees").keyup( function(){
								// $("#advancefees").val("");
								// $("#balance").val(0);
								// var fee = $.trim($(this).val());
								// if( fee!='' && !isNaN(fee))
								// {
								// $("#advancefees").removeAttr("readonly");
								// $("#balance").val(fee);
								// $('#advancefees').rules("add", {
								//     max: parseInt(fee)
								// });

								// }
								// else{
								// $("#advancefees").attr("readonly","readonly");
								// }

								// });




								// $("#advancefees").keyup( function(){

								// var advancefees = parseInt($.trim($(this).val()));
								// var totalfee = parseInt($("#fees").val());
								// if( advancefees!='' && !isNaN(advancefees) && advancefees<=totalfee)
								// {
								// var balance = totalfee-advancefees;
								// $("#balance").val(balance);

								// }
								// else{
								// $("#balance").val(totalfee);
								// }

								// });
				</script>


				<!--Manage ESP change.-->
			<?php
		} else if (@$_GET['action'] != "view") {
			?>

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
										<th>#</th>
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
											<a href="student.php?action=edit&id=' . $r['id'] . '" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-edit"></span></a>
											
											<a onclick="return confirm(\'Are you sure you want to delete this record\');" href="student.php?action=delete&id=' . $r['id'] . '" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span></a>
											<a href="student.php?action=view&id=' . $r['id'] . '" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-eye-open"></span></a> </td>
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
				<!--view action change-->
			<?php
		}
			?>
			<?php if (isset($_GET['action']) && @$_GET['action'] == "view") { ?>
				<script type="text/javascript" src="js/validation/jquery.validate.min.js"></script>
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<?php
								$con = mysqli_connect("localhost", "root", "", "egnion_yomi");
								if (mysqli_connect_errno()) {
									echo "Failed to connect to MySQL: " . mysqli_connect_error();
								}
								$id = @$_GET['id'];
								$result = mysqli_query($con, "SELECT * FROM esp32 WHERE id=$id");
								while ($row = mysqli_fetch_array($result)) {
									$name = $row['esp_name'];
									echo ("Esp: $name, ID: $id");
								} ?>
							</div>
							<?php //We include the database_connect.php which has the data for the connection to the database

							$con = mysqli_connect("localhost", "root", "", "dbs122647");
							// Check the connection
							if (mysqli_connect_errno()) {
								echo "Failed to connect to MySQL: " . mysqli_connect_error();
							}
							//Again, we grab the table out of the database, name is ESPtable2 in this case
							$result = mysqli_query($con, "SELECT * FROM ESPtable2"); //table select



							//Now we create the table with all the values from the database	  
							echo "<table class='table' style='font-size: 30px;'>
	<thead>
		<tr>
		<th>Boolean Indicators</th>	
		</tr>
	</thead>
	
    <tbody>
      <tr class='active'>
        <td>Noobix ID</td>
        <td>Boolean control 1</td>
        <td>Boolean control 2 </td>
		<td>Boolean control 3 </td>
		<td>Boolean control 4</td>
        <td>Boolean control 5 </td>		
      </tr>  
		";

							//loop through the table and print the data into the table
							while ($row = mysqli_fetch_array($result)) {

								echo "<tr class='success'>";
								$unit_id = $row['id'];
								echo "<td>" . $row['id'] . "</td>";

								$column1 = "RECEIVED_BOOL1";
								$column2 = "RECEIVED_BOOL2";
								$column3 = "RECEIVED_BOOL3";
								$column4 = "RECEIVED_BOOL4";
								$column5 = "RECEIVED_BOOL5";

								$current_bool_1 = $row['RECEIVED_BOOL1'];
								$current_bool_2 = $row['RECEIVED_BOOL2'];
								$current_bool_3 = $row['RECEIVED_BOOL3'];
								$current_bool_4 = $row['RECEIVED_BOOL4'];
								$current_bool_5 = $row['RECEIVED_BOOL5'];

								if ($current_bool_1 == 1) {
									$inv_current_bool_1 = 0;
									$text_current_bool_1 = "ON";
									$color_current_bool_1 = "#6ed829";
								} else {
									$inv_current_bool_1 = 1;
									$text_current_bool_1 = "OFF";
									$color_current_bool_1 = "#e04141";
								}


								if ($current_bool_2 == 1) {
									$inv_current_bool_2 = 0;
									$text_current_bool_2 = "ON";
									$color_current_bool_2 = "#6ed829";
								} else {
									$inv_current_bool_2 = 1;
									$text_current_bool_2 = "OFF";
									$color_current_bool_2 = "#e04141";
								}


								if ($current_bool_3 == 1) {
									$inv_current_bool_3 = 0;
									$text_current_bool_3 = "ON";
									$color_current_bool_3 = "#6ed829";
								} else {
									$inv_current_bool_3 = 1;
									$text_current_bool_3 = "OFF";
									$color_current_bool_3 = "#e04141";
								}


								if ($current_bool_4 == 1) {
									$inv_current_bool_4 = 0;
									$text_current_bool_4 = "ON";
									$color_current_bool_4 = "#6ed829";
								} else {
									$inv_current_bool_4 = 1;
									$text_current_bool_4 = "OFF";
									$color_current_bool_4 = "#e04141";
								}


								if ($current_bool_5 == 1) {
									$inv_current_bool_5 = 0;
									$text_current_bool_5 = "ON";
									$color_current_bool_5 = "#6ed829";
								} else {
									$inv_current_bool_5 = 1;
									$text_current_bool_5 = "OFF";
									$color_current_bool_5 = "#e04141";
								}


								echo "<td><form action= update_values.php method= 'post'>
  	<input type='hidden' name='value2' value=$current_bool_1   size='15' >	
	<input type='hidden' name='value' value=$inv_current_bool_1  size='15' >	
  	<input type='hidden' name='unit' value=$unit_id >
  	<input type='hidden' name='column' value=$column1 >
  	<input type= 'submit' name= 'change_but' style=' margin-left: 25%; margin-top: 10%; font-size: 30px; text-align:center; background-color: $color_current_bool_1' value=$text_current_bool_1></form></td>";



								echo "<td><form action= update_values.php method= 'post'>
  	<input type='hidden' name='value2' value=$current_bool_2   size='15' >	
	<input type='hidden' name='value' value=$inv_current_bool_2  size='15' >	
  	<input type='hidden' name='unit' value=$unit_id >
  	<input type='hidden' name='column' value=$column2 >
  	<input type= 'submit' name= 'change_but' style=' margin-left: 25%; margin-top: 10%; font-size: 30px; text-align:center; background-color: $color_current_bool_2' value=$text_current_bool_2></form></td>";


								echo "<td><form action= update_values.php method= 'post'>
  	<input type='hidden' name='value2' value=$current_bool_3   size='15' >	
	<input type='hidden' name='value' value=$inv_current_bool_3  size='15' >	
  	<input type='hidden' name='unit' value=$unit_id >
  	<input type='hidden' name='column' value=$column3 >
  	<input type= 'submit' name= 'change_but' style=' margin-left: 25%; margin-top: 10%; font-size: 30px; text-align:center; background-color: $color_current_bool_3' value=$text_current_bool_3></form></td>";


								echo "<td><form action= update_values.php method= 'post'>
  	<input type='hidden' name='value2' value=$current_bool_4   size='15' >	
	<input type='hidden' name='value' value=$inv_current_bool_4  size='15' >	
  	<input type='hidden' name='unit' value=$unit_id >
  	<input type='hidden' name='column' value=$column4 >
  	<input type= 'submit' name= 'change_but' style=' margin-left: 25%; margin-top: 10%; font-size: 30px; text-align:center; background-color: $color_current_bool_4' value=$text_current_bool_4></form></td>";


								echo "<td><form action= update_values.php method= 'post'>
  	<input type='hidden' name='value2' value=$current_bool_5   size='15' >	
	<input type='hidden' name='value' value=$inv_current_bool_5  size='15' >	
  	<input type='hidden' name='unit' value=$unit_id >
  	<input type='hidden' name='column' value=$column5 >
  	<input type= 'submit' name= 'change_but' style=' margin-left: 25%; margin-top: 10%; font-size: 30px; text-align:center; background-color: $color_current_bool_5' value=$text_current_bool_5></form></td>";

								echo "</tr>
	  </tbody>";
							}
							echo "</table>
<br>
";
							?>





							//Again for the second table for numeric controls. We create the table with all the values from the database
							<?php

							$con = mysqli_connect("localhost", "root", "", "dbs122647");
							if (mysqli_connect_errno()) {
								echo "Failed to connect to MySQL: " . mysqli_connect_error();
							}
							$result = mysqli_query($con, "SELECT * FROM ESPtable2"); //table select

							echo "<table class='table' style='font-size: 30px;'>
	<thead>
		<tr>
		<th>Numeric controls</th>	
		</tr>
	</thead>
	
    <tbody>
      <tr class='active'>
        <td>CONTROL NUMBER 1</td>
        <td>CONTROL NUMBER 2</td>
        <td>CONTROL NUMBER 3</td>
		<td>CONTROL NUMBER 4 </td>
		<td>CONTROL NUMBER 5 </td>
      </tr>  
		";

							while ($row = mysqli_fetch_array($result)) {

								echo "<tr class='success'>";

								$column6 = "RECEIVED_NUM1";
								$column7 = "RECEIVED_NUM2";
								$column8 = "RECEIVED_NUM3";
								$column9 = "RECEIVED_NUM4";
								$column10 = "RECEIVED_NUM5";

								$current_num_1 = $row['RECEIVED_NUM1'];
								$current_num_2 = $row['RECEIVED_NUM2'];
								$current_num_3 = $row['RECEIVED_NUM3'];
								$current_num_4 = $row['RECEIVED_NUM4'];
								$current_num_5 = $row['RECEIVED_NUM5'];


								echo "<td><form action= update_values.php method= 'post'>
  	<input type='text' name='value' style='width: 120px;' value=$current_num_1  size='15' >
  	<input type='hidden' name='unit' style='width: 120px;' value=$unit_id >
  	<input type='hidden' name='column' style='width: 120px;' value=$column6 >
  	<input type= 'submit' name= 'change_but' style='width: 120px; text-align:center;' value='change'></form></td>";



								echo "<td><form action= update_values.php method= 'post'>
  	<input type='text' name='value' style='width: 120px;' value=$current_num_2  size='15' >
  	<input type='hidden' name='unit' style='width: 120px;' value=$unit_id >
  	<input type='hidden' name='column' style='width: 120px;' value=$column7 >
  	<input type= 'submit' name= 'change_but' style='text-align:center' value='change'></form></td>";

								echo "<td><form action= update_values.php method= 'post'>
  	<input type='text' name='value' style='width: 120px;' value=$current_num_3  size='15' >
  	<input type='hidden' name='unit' style='width: 120px;' value=$unit_id >
  	<input type='hidden' name='column' style='width: 120px;' value=$column8 >
  	<input type= 'submit' name= 'change_but' style='text-align:center' value='change'></form></td>";

								echo "<td><form action= update_values.php method= 'post'>
  	<input type='text' name='value' style='width: 120px;' value=$current_num_4  size='15' >
  	<input type='hidden' name='unit' style='width: 120px;' value=$unit_id >
  	<input type='hidden' name='column' style='width: 120px;' value=$column9 >
  	<input type= 'submit' name= 'change_but' style='text-align:center' value='change'></form></td>";

								echo "<td><form action= update_values.php method= 'post'>
  	<input type='text' name='value' style='width: 120px;' value=$current_num_5  size='15' >
  	<input type='hidden' name='unit' style='width: 120px;' value=$unit_id >
  	<input type='hidden' name='column' style='width: 120px;' value=$column10 >
  	<input type= 'submit' name= 'change_but' style='text-align:center' value='change'></form></td>";

								echo "</tr>
	  </tbody>";
							}
							echo "</table>
<br>
";
							?>






							//Again for the third table for text send. We create the table with all the values from the database
							<?php

							$con = mysqli_connect("localhost", "root", "", "dbs122647");

							if (mysqli_connect_errno()) {
								echo "Failed to connect to MySQL: " . mysqli_connect_error();
							}
							$result = mysqli_query($con, "SELECT * FROM ESPtable2"); //table select



							echo "<table class='table' style='font-size: 30px;'>
	<thead>
		<tr>
		<th>Send Text to Noobix</th>	
		</tr>
	</thead>
	
    <tbody>
      <tr class='active'>
        <td>Text</td>        
      </tr>  
		";

							while ($row = mysqli_fetch_array($result)) {

								echo "<tr class='success'>";

								$column11 = "TEXT_1";
								$current_text_1 = $row['TEXT_1'];


								echo "<td><form action= update_values.php method= 'post'>
  	<input style='width: 100%;' type='text' name='value' value=$current_text_1  size='100'>
  	<input type='hidden' name='unit' value=$unit_id >
  	<input type='hidden' name='column' value=$column11 >
  	<input type= 'submit' name= 'change_but' style='text-align:center' value='Send'></form></td>";

								echo "</tr>
	  </tbody>";
							}
							echo "</table>
<br>
<br>
<hr>";

							?>

















							//Again for the forth table.
							<?php
							$con = mysqli_connect("localhost", "root", "", "dbs122647");

							if (mysqli_connect_errno()) {
								echo "Failed to connect to MySQL: " . mysqli_connect_error();
							}

							$result = mysqli_query($con, "SELECT * FROM ESPtable2"); //table select

							echo "<table class='table' style='font-size: 30px;'>
	<thead>
		<tr>
		<th>Boolean Indicators</th>	
		</tr>
	</thead>
	
    <tbody>
      <tr class='active'>
        <td>Noobix ID</td>
        <td>Indicator 1</td>
        <td>Indicator 2 </td>
		<td>Indicator 3 </td>
      </tr>  
		";



							while ($row = mysqli_fetch_array($result)) {

								$cur_sent_bool_1 = $row['SENT_BOOL_1'];
								$cur_sent_bool_2 = $row['SENT_BOOL_2'];
								$cur_sent_bool_3 = $row['SENT_BOOL_3'];


								if ($cur_sent_bool_1 == 1) {
									$label_sent_bool_1 = "label-success";
									$text_sent_bool_1 = "Active";
								} else {
									$label_sent_bool_1 = "label-danger";
									$text_sent_bool_1 = "Inactive";
								}


								if ($cur_sent_bool_2 == 1) {
									$label_sent_bool_2 = "label-success";
									$text_sent_bool_2 = "Active";
								} else {
									$label_sent_bool_2 = "label-danger";
									$text_sent_bool_2 = "Inactive";
								}


								if ($cur_sent_bool_3 == 1) {
									$label_sent_bool_3 = "label-success";
									$text_sent_bool_3 = "Active";
								} else {
									$label_sent_bool_3 = "label-danger";
									$text_sent_bool_3 = "Inactive";
								}


								echo "<tr class='info'>";
								$unit_id = $row['id'];
								echo "<td>" . $row['id'] . "</td>";
								echo "<td>
		<span class='label $label_sent_bool_1'>"
									. $text_sent_bool_1 . "</td>
	    </span>";

								echo "<td>
		<span class='label $label_sent_bool_2'>"
									. $text_sent_bool_2 . "</td>
	    </span>";

								echo "<td>
		<span class='label $label_sent_bool_3'>"
									. $text_sent_bool_3 . "</td>
	    </span>";
								echo "</tr>
	  </tbody>";
							}
							echo "</table>";
							?>









							//Again for the fifth table.
							<?php

							$con = mysqli_connect("localhost", "root", "", "dbs122647");

							if (mysqli_connect_errno()) {
								echo "Failed to connect to MySQL: " . mysqli_connect_error();
							}

							$result = mysqli_query($con, "SELECT * FROM ESPtable2"); //table select


							echo "<table class='table' style='font-size: 30px;'>
	<thead>
		<tr>
		<th>Integer Indicators</th>	
		</tr>
	</thead>
	
    <tbody>
      <tr class='active'>
        <td>Received number 1</td>
        <td>Received number 2</td>
        <td>Received number 3 </td>
		<td>Received number 4 </td>
      </tr>  
		";


							while ($row = mysqli_fetch_array($result)) {

								echo "<tr class='info'>";

								echo "<td>" . $row['SENT_NUMBER_1'] . "</td>";
								echo "<td>" . $row['SENT_NUMBER_2'] . "</td>";
								echo "<td>" . $row['SENT_NUMBER_3'] . "</td>";
								echo "<td>" . $row['SENT_NUMBER_4'] . "</td>";

								echo "</tr>
	</tbody>";
							}
							echo "</table>
<br>
";
							?>
						<?php } ?>


						</div>
						<!-- /. PAGE INNER  -->
					</div>
					<!-- /. PAGE WRAPPER  -->
				</div>
				<!-- /. WRAPPER  -->

				<div id="footer-sec">
					School Fees Payment System | Brought To You By : <a href="http://code-projects.org/" target="_blank">Code-Projects</a>
				</div>


				<!-- BOOTSTRAP SCRIPTS -->
				<script src="js/bootstrap.js"></script>
				<!-- METISMENU SCRIPTS -->
				<script src="js/jquery.metisMenu.js"></script>
				<!-- CUSTOM SCRIPTS -->
				<script src="js/custom1.js"></script>



				</body>

</html>