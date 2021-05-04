<?php
include("../php/dbconnect.php"); 	//We include the database_connect.php which has the data for the connection to the database


// Check  the connection
if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

//Now we update the values in database

/*This file should receive a link somethong like this: http://noobix.000webhostapp.com/TX.php?unit=1&b1=1
If you paste that link to your browser, it should update b1 value with this TX.php file. Read more details below.
The ESP will send a link like the one above but with more than just b1. It will have b1, b2, etc...

http://localhost/IOTFRIDGE/php/TX.php?esp=1&s1=1&s2=1&s3=1&s4=1&s5=1&s6=1&s7=1&s8=1&s9=1&s10=1&s11=1&s12=1

*/
//We loop through and grab variables from the received the URL
foreach ($_REQUEST as $key => $value)  //Save the received value to the hey variable. Save each cahracter after the "&"
{
	//Now we detect if we recheive the id, the password, unit, or a value to update
	if ($key == "esp") {

		$esp = $value;
		
	}

	if ($key == "s1") {
		$sensor1 = $value;

		// echo 'INSERT INTO sensors_data (connected_sersor_id,esp_id,sensor_id,time, value) VALUES ('$esp','$esp','1', now(), $sensor1)';
		// mysqli_query($conn, "INSERT INTO sensors_data (connected_sersor_id,esp_id,sensor_id,time, value) VALUES ('(SELECT connected_sensors.ID FROM connected_sensors where connected_sensors.sensor_id = 1 and connected_sensors.esp_id=$esp)','$esp','1', now(), $sensor1);");
		
		mysqli_query($conn, "INSERT INTO sensors_data (connected_sersor_id,time, value) VALUES ((SELECT connected_sensors.ID FROM `connected_sensors`INNER JOIN `used_pins` ON used_pins.connected_sersor_id=connected_sensors.ID INNER JOIN `pins` ON pins.ID=used_pins.pin_id WHERE connected_sensors.esp_id=$esp and pins.pin_name='GPIO13'), now(),$sensor1)");

		
	}
	if ($key == "s2") {
		$sensor2 = $value;
		
		// mysqli_query($conn, "INSERT INTO sensors_data (connected_sersor_id,esp_id,sensor_id,time, value) VALUES ('$esp','$esp','2', now(), $sensor2)");
		mysqli_query($conn, "INSERT INTO sensors_data (connected_sersor_id,time, value) VALUES ((SELECT connected_sensors.ID FROM `connected_sensors`INNER JOIN `used_pins` ON used_pins.connected_sersor_id=connected_sensors.ID INNER JOIN `pins` ON pins.ID=used_pins.pin_id WHERE connected_sensors.esp_id=$esp and pins.pin_name='GPIO18'), now(),$sensor2)");


		
	}
	if ($key == "s3") {
		$sensor3 = $value;
		// mysqli_query($conn, "INSERT INTO sensors_data (connected_sersor_id,esp_id,sensor_id,time, value) VALUES ('$esp','$esp','3', now(), $sensor3)");
		mysqli_query($conn, "INSERT INTO sensors_data (connected_sersor_id,time, value) VALUES ((SELECT connected_sensors.ID FROM `connected_sensors`INNER JOIN `used_pins` ON used_pins.connected_sersor_id=connected_sensors.ID INNER JOIN `pins` ON pins.ID=used_pins.pin_id WHERE connected_sensors.esp_id=$esp and pins.pin_name='GPIO19'), now(),$sensor3)");


		
	}

	if ($key == "s4") {
		$sensor4 = $value;
		// mysqli_query($conn, "INSERT INTO sensors_data (connected_sersor_id,esp_id,sensor_id,time, value) VALUES ('$esp','$esp','4', now(), $sensor4)");
		mysqli_query($conn, "INSERT INTO sensors_data (connected_sersor_id,time, value) VALUES ((SELECT connected_sensors.ID FROM `connected_sensors`INNER JOIN `used_pins` ON used_pins.connected_sersor_id=connected_sensors.ID INNER JOIN `pins` ON pins.ID=used_pins.pin_id WHERE connected_sensors.esp_id=$esp and pins.pin_name='GPIO2'), now(),$sensor4)");

		
	}
	if ($key == "s5") {
		$sensor5 = $value;
		// mysqli_query($conn, "INSERT INTO sensors_data (connected_sersor_id,esp_id,sensor_id,time, value) VALUES ('$esp','$esp','5', now(), $sensor5)");
		mysqli_query($conn, "INSERT INTO sensors_data (connected_sersor_id,time, value) VALUES ((SELECT connected_sensors.ID FROM `connected_sensors`INNER JOIN `used_pins` ON used_pins.connected_sersor_id=connected_sensors.ID INNER JOIN `pins` ON pins.ID=used_pins.pin_id WHERE connected_sensors.esp_id=$esp and pins.pin_name='GPIO23'), now(),$sensor5)");

	
	}
	if ($key == "s6") {
		$sensor6 = $value;
		// mysqli_query($conn, "INSERT INTO sensors_data (connected_sersor_id,esp_id,sensor_id,time, value) VALUES ('$esp','$esp','6', now(), $sensor6)");
		mysqli_query($conn, "INSERT INTO sensors_data (connected_sersor_id,time, value) VALUES ((SELECT connected_sensors.ID FROM `connected_sensors`INNER JOIN `used_pins` ON used_pins.connected_sersor_id=connected_sensors.ID INNER JOIN `pins` ON pins.ID=used_pins.pin_id WHERE connected_sensors.esp_id=$esp and pins.pin_name='GPIO25'), now(),$sensor6)");

	}
	if ($key == "s7") {
		$sensor7 = $value;
		// mysqli_query($conn, "INSERT INTO sensors_data (connected_sersor_id,esp_id,sensor_id,time, value) VALUES ('$esp','$esp','7', now(), $sensor7)");
		mysqli_query($conn, "INSERT INTO sensors_data (connected_sersor_id,time, value) VALUES ((SELECT connected_sensors.ID FROM `connected_sensors`INNER JOIN `used_pins` ON used_pins.connected_sersor_id=connected_sensors.ID INNER JOIN `pins` ON pins.ID=used_pins.pin_id WHERE connected_sensors.esp_id=$esp and pins.pin_name='GPIO34'), now(),$sensor7)");

	}
	if ($key == "s8") {
		$sensor8 = $value;
		// mysqli_query($conn, "INSERT INTO sensors_data (connected_sersor_id,esp_id,sensor_id,time, value) VALUES ('$esp','$esp','8', now(), $sensor8)");
		mysqli_query($conn, "INSERT INTO sensors_data (connected_sersor_id,time, value) VALUES ((SELECT connected_sensors.ID FROM `connected_sensors`INNER JOIN `used_pins` ON used_pins.connected_sersor_id=connected_sensors.ID INNER JOIN `pins` ON pins.ID=used_pins.pin_id WHERE connected_sensors.esp_id=$esp and pins.pin_name='GPIO35'), now(),$sensor8)");

	}
	if ($key == "s9") {
		$sensor9 = $value;
		// mysqli_query($conn, "INSERT INTO sensors_data (connected_sersor_id,esp_id,sensor_id,time, value) VALUES ('$esp','$esp','9', now(), $sensor9)");
		mysqli_query($conn, "INSERT INTO sensors_data (connected_sersor_id,time, value) VALUES ((SELECT connected_sensors.ID FROM `connected_sensors`INNER JOIN `used_pins` ON used_pins.connected_sersor_id=connected_sensors.ID INNER JOIN `pins` ON pins.ID=used_pins.pin_id WHERE connected_sensors.esp_id=$esp and pins.pin_name='GPIO36'), now(),$sensor9)");

	}
	if ($key == "s10") {
		$sensor10 = $value;
		// mysqli_query($conn, "INSERT INTO sensors_data (connected_sersor_id,esp_id,sensor_id,time, value) VALUES ('$esp','$esp','10', now(), $sensor10)");
		mysqli_query($conn, "INSERT INTO sensors_data (connected_sersor_id,time, value) VALUES ((SELECT connected_sensors.ID FROM `connected_sensors`INNER JOIN `used_pins` ON used_pins.connected_sersor_id=connected_sensors.ID INNER JOIN `pins` ON pins.ID=used_pins.pin_id WHERE connected_sensors.esp_id=$esp and pins.pin_name='GPIO39'), now(),$sensor10)");

	}
	if ($key == "s11") {
		$sensor11 = $value;
		// mysqli_query($conn, "INSERT INTO sensors_data (connected_sersor_id,esp_id,sensor_id,time, value) VALUES ('$esp','$esp','11', now(), $sensor11)");
		mysqli_query($conn, "INSERT INTO sensors_data (connected_sersor_id,time, value) VALUES ((SELECT connected_sensors.ID FROM `connected_sensors`INNER JOIN `used_pins` ON used_pins.connected_sersor_id=connected_sensors.ID INNER JOIN `pins` ON pins.ID=used_pins.pin_id WHERE connected_sensors.esp_id=$esp and pins.pin_name='GPIO32'), now(),$sensor11)");

	}
	if ($key == "s12") {
		$sensor12 = $value;
		// mysqli_query($conn, "INSERT INTO sensors_data (connected_sersor_id,esp_id,sensor_id,time, value) VALUES ('$esp','$esp','12', now(), $sensor12)");
		mysqli_query($conn, "INSERT INTO sensors_data (connected_sersor_id,time, value) VALUES ((SELECT connected_sensors.ID FROM `connected_sensors`INNER JOIN `used_pins` ON used_pins.connected_sersor_id=connected_sensors.ID INNER JOIN `pins` ON pins.ID=used_pins.pin_id WHERE connected_sensors.esp_id=$esp and pins.pin_name='GPIO33'), now(),$sensor12)");

	}
	
} //End of foreach


//In case that you need the time from the internet, use this line
date_default_timezone_set('UTC');
$t1 = date("gi"); 	//This will return 1:23 as 123

// output pins

//Get all the values form the table on the database
$sql = "SELECT * FROM output_controls where esp_id=$esp";
$q = $conn->query($sql);

//Loop through the table and filter out data for this unit id equal to the one taht we've received. 
while ($row = $q->fetch_assoc()) {
	$output1=$row['output1'];
	$output2=$row['output2'];
	$output3=$row['output3'];
	$output4=$row['output4'];
	$output5=$row['output5'];
	$output6= $row['output6'];

	
	echo "_output1$output1##_output2$output2##_output3$output3##_output4$output4##_output5$output5##_output6$output6";

	
} // End of the while loop

?>