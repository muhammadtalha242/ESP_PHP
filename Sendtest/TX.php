
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

http://localhost/IOTFRIDGE/Sendtest/TX.php?esp=1&s1=1&s2=1&s3=1&s4=1&s5=1&s6=1&s7=1&s8=1&s9=1&s10=1&s11=1&s12=1&s14=1&s15=1&s16=1&s17=1&s18=1

*/
//We loop through and grab variables from the received the URL
foreach ($_REQUEST as $key => $value)  //Save the received value to the hey variable. Save each cahracter after the "&"
{
	//Now we detect if we recheive the id, the password, unit, or a value to update
	if ($key == "esp") {

		$esp = $value;
		echo $esp;
	}

	if ($key == "s1") {
		$sensor1 = $value;

		// echo 'INSERT INTO sensors_data (connected_sersor_id,esp_id,sensor_id,time, value) VALUES ('$esp','$esp','1', now(), $sensor1)';
		mysqli_query($conn, "INSERT INTO sensors_data (connected_sersor_id,esp_id,sensor_id,time, value) VALUES ('$esp','$esp','1', now(), $sensor1)");

		echo "sensor1 esp1 updated";
	}
	if ($key == "s2") {
		$sensor2 = $value;
		mysqli_query($conn, "INSERT INTO sensors_data (connected_sersor_id,esp_id,sensor_id,time, value) VALUES ('$esp','$esp','2', now(), $sensor2)");

		echo $sensor2;
	}
	if ($key == "s3") {
		$sensor3 = $value;
		mysqli_query($conn, "INSERT INTO sensors_data (connected_sersor_id,esp_id,sensor_id,time, value) VALUES ('$esp','$esp','3', now(), $sensor3)");

		echo $sensor3;
	}

	if ($key == "s4") {
		$sensor4 = $value;
		mysqli_query($conn, "INSERT INTO sensors_data (connected_sersor_id,esp_id,sensor_id,time, value) VALUES ('$esp','$esp','4', now(), $sensor4)");

		echo $sensor4;
	}
	if ($key == "s5") {
		$sensor5 = $value;
		mysqli_query($conn, "INSERT INTO sensors_data (connected_sersor_id,esp_id,sensor_id,time, value) VALUES ('$esp','$esp','5', now(), $sensor5)");

		echo $sensor5;
	}
	if ($key == "s6") {
		$sensor6 = $value;
		mysqli_query($conn, "INSERT INTO sensors_data (connected_sersor_id,esp_id,sensor_id,time, value) VALUES ('$esp','$esp','6', now(), $sensor6)");
	}
	if ($key == "s7") {
		$sensor7 = $value;
		mysqli_query($conn, "INSERT INTO sensors_data (connected_sersor_id,esp_id,sensor_id,time, value) VALUES ('$esp','$esp','7', now(), $sensor7)");
	}
	if ($key == "s8") {
		$sensor8 = $value;
		mysqli_query($conn, "INSERT INTO sensors_data (connected_sersor_id,esp_id,sensor_id,time, value) VALUES ('$esp','$esp','8', now(), $sensor8)");
	}
	if ($key == "s9") {
		$sensor9 = $value;
		mysqli_query($conn, "INSERT INTO sensors_data (connected_sersor_id,esp_id,sensor_id,time, value) VALUES ('$esp','$esp','9', now(), $sensor9)");
	}
	if ($key == "s10") {
		$sensor10 = $value;
		mysqli_query($conn, "INSERT INTO sensors_data (connected_sersor_id,esp_id,sensor_id,time, value) VALUES ('$esp','$esp','10', now(), $sensor10)");
	}
	if ($key == "s11") {
		$sensor11 = $value;
		mysqli_query($conn, "INSERT INTO sensors_data (connected_sersor_id,esp_id,sensor_id,time, value) VALUES ('$esp','$esp','11', now(), $sensor11)");
	}
	if ($key == "s12") {
		$sensor12 = $value;
		mysqli_query($conn, "INSERT INTO sensors_data (connected_sersor_id,esp_id,sensor_id,time, value) VALUES ('$esp','$esp','12', now(), $sensor12)");
	}
	if ($key == "s13") {
		$sensor13 = $value;
		mysqli_query($conn, "INSERT INTO sensors_data (connected_sersor_id,esp_id,sensor_id,time, value) VALUES ('$esp','$esp','13', now(), $sensor13)");
	}
	if ($key == "s14") {
		$sensor14 = $value;
		mysqli_query($conn, "INSERT INTO sensors_data (connected_sersor_id,esp_id,sensor_id,time, value) VALUES ('$esp','$esp','14', now(), $sensor14)");
	}
	if ($key == "s15") {
		$sensor15 = $value;

		mysqli_query($conn, "INSERT INTO sensors_data (connected_sersor_id,esp_id,sensor_id,time, value) VALUES ('$esp','$esp','15', now(), $sensor15)");
	}
	if ($key == "s18") {
		$sensor16 = $value;

		mysqli_query($conn, "INSERT INTO sensors_data (connected_sersor_id,esp_id,sensor_id,time, value) VALUES ('$esp','$esp','16', now(), $sensor16)");
	}
	if ($key == "s17") {
		$sensor17 = $value;
		mysqli_query($conn, "INSERT INTO sensors_data (connected_sersor_id,esp_id,sensor_id,time, value) VALUES ('$esp','$esp','17', now(), $sensor17)");
	}
	if ($key == "s18") {
		$sensor18 = $value;
		mysqli_query($conn, "INSERT INTO sensors_data (connected_sersor_id,esp_id,sensor_id,time, value) VALUES ('$esp','$esp','18', now(), $sensor18)");
	}
} //End of foreach


// include("database_connect.php"); 	//We include the database_connect.php which has the data for the connection to the database


// // Check  the connection
// if (mysqli_connect_errno()) {
// 	echo "Failed to connect to MySQL: " . mysqli_connect_error();
// }

// //Now we update the values in database
// mysqli_query($con, "UPDATE sensors_data SET SENT_BOOL_1 = $sent_bool_1, SENT_BOOL_2 = $sent_bool_2, SENT_BOOL_3 = $sent_bool_3 
// 		WHERE id=$unit");



// //In case that you need the time from the internet, use this line
date_default_timezone_set('UTC');
$t1 = date("gi"); 	//This will return 1:23 as 123

//Get all the values form the table on the database
// $result = mysqli_query($conn, "SELECT * FROM sensors_data where esp_id=$esp)");	//table select is ESPtable2, must be the same on yor database
$sql = "SELECT * FROM sensors_data where esp_id=1 ";
$q = $conn->query($sql);
$i = 1;
//Loop through the table and filter out data for this unit id equal to the one taht we've received. 
while ($row = $q->fetch_assoc()) {
	echo "<h2>".$i."</h2>";
	echo "esp_id  " . $row['esp_id'];
	echo "<br>";

	echo "sensor_id " . $row['sensor_id'];
	echo "<br>";

	echo "time " .$row['time'];
	echo "<br>";

	echo "value " . $row['value'];
	echo "<br>";

	$i++;
	// if ($row['esp_id'] == $esp) {

	// 	//We update the values for the boolean and numebers we receive from the Arduino, then we echo the boolean
	// 	//and numbers and the text from the database back to the Arduino
	// 	$b1 = $row['RECEIVED_BOOL1'];
	// 	$b2 = $row['RECEIVED_BOOL2'];
	// 	$b3 = $row['RECEIVED_BOOL3'];
	// 	$b4 = $row['RECEIVED_BOOL4'];
	// 	$b5 = $row['RECEIVED_BOOL5'];

	// 	$n1 = $row['RECEIVED_NUM1'];
	// 	$n2 = $row['RECEIVED_NUM2'];
	// 	$n3 = $row['RECEIVED_NUM3'];
	// 	$n4 = $row['RECEIVED_NUM4'];
	// 	$n5 = $row['RECEIVED_NUM5'];

	// 	$n6 = $row['TEXT_1'];

	// 	//Next line will echo the data back to the Arduino
	// 	echo " _t1$t1##_b1$b1##_b2$b2##_b3$b3##_b4$b4##_b5$b5##_n1$n1##_n2$n2##_n3$n3##_n4$n4##_n5$n5##_n6$n6##";
	// }
} // End of the while loop

?>

