<?php

$espId ;
$label ;
$update;

foreach ($_REQUEST as $key => $value) {
    if ($key == 'espID') {
        $espId = $value;
    }
    if($key == 'label') {
        $label = $value;
    }
    if($key == 'update') {
        $update = $value;
        get_analog_input($espId, $label, $update);
    }

}

function get_analog_input($espId, $label, $update){
    if($update == 1){
        $con = mysqli_connect("localhost", "root", "", "egnion_yomi");
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        $sql = "SELECT value FROM `sensors_data` INNER JOIN `connected_sensors` ON sensors_data.connected_sersor_id=connected_sensors.ID INNER JOIN `esp32` ON esp32.id=connected_sensors.esp_id WHERE esp_id=$espId AND sensors_data.Type=0 AND connected_sensors.label='$label' ORDER BY sensors_data.time DESC LIMIT 0,1";
        $result = mysqli_fetch_assoc(mysqli_query($con, $sql));
        echo $result['value'];
    }
    else {
        $con = mysqli_connect("localhost", "root", "", "egnion_yomi");
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        $sql = "SELECT value FROM `sensors_data` INNER JOIN `connected_sensors` ON sensors_data.connected_sersor_id=connected_sensors.ID INNER JOIN `esp32` ON esp32.id=connected_sensors.esp_id WHERE esp_id=$espId AND sensors_data.Type=0 AND connected_sensors.label='$label' ORDER BY sensors_data.time ASC LIMIT 0,5";
        $result = mysqli_query($con, $sql);
        $data = "";
        while ($row = $result->fetch_assoc()) {
            $output1 = $row['value'];
            $data = $data."-".$output1;
        }
        echo $data;        
    }
}

?>