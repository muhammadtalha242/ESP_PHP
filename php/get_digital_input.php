<?php



foreach ($_REQUEST as $key => $value) {
    if ($key == 'espID') {
        $espId = $value;
        get_digital_input($espId);
    }
}

function get_digital_input($espId){
    $con = mysqli_connect("localhost", "root", "", "egnion_yomi");
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    $sql = "SELECT value FROM `sensors_data` INNER JOIN `connected_sensors` ON sensors_data.connected_sersor_id=connected_sensors.ID INNER JOIN `esp32` ON esp32.id=connected_sensors.esp_id WHERE esp_id=$espId";
    $result = mysqli_query($con, $sql);
    $data = "";
    while ($row = $result->fetch_assoc()) {
        $output1 = $row['value'];
        $data = $data."-".$output1;

    }
    echo $data;
}

?>