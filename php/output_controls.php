<script>
console.log("fsdfsdfsdf")
</script>
<?php
// http://localhost/IOTFRIDGE/php/output_controls.php?&pin_id=12&pin_name=GPIO26&pin_number=26&label=26&output=1&esp_id=14
$pin_id = 0;
$pin_name = 0;
$pin_number = 0;
$label = 0;
$output = 2;
$esp_id = 0;

foreach ($_REQUEST as $key => $value) {
    if ($key == 'pin_id') {
        $pin_id = $value;
    }
    if ($key == 'pin_name') {
        $pin_name = $value;
    }
    if ($key == 'pin_number') {
        $pin_number = $value;
    }

    if ($key == 'label') {
        $label = $value;
    }
    if ($key == 'output') {
        $output = $value;
    }
    if ($key == 'esp_id') {
        $espId = $value;
        updateDB($pin_id, $pin_name, $pin_number, $label, $output, $espId);
        
    }

    
}
function updateDB($pin_id, $pin_name, $pin_number, $label, $output, $espId)
{
    echo $pin_id . " " . $pin_name . " " . $pin_number . " " . $label . " " . $output . " " . $espId;
    $conn = mysqli_connect("localhost", "root", "", "egnion_yomi");
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    $pins = array("GPIO26" => "output1", "GPIO5" => "output2", "GPIO27" => "output3", "GPIO12" => "output4", "GPIO14" => "output5", "GPIO15" => "output6");


    $sql1 = "UPDATE output_controls SET $pins[$pin_name] = '$output' Where esp_id = $espId";
    mysqli_query($conn, $sql1);
    // $sql = "SELECT * FROM output_controls where esp_id=$espId";
    // $q = $conn->query($sql);

    // echo 1;
    //Loop through the table and filter out data for this unit id equal to the one taht we've received. 
    // while ($row = $q->fetch_assoc()) {
    //     $output1 = $row['output1'];
    //     $output2 = $row['output2'];
    //     $output3 = $row['output3'];
    //     $output4 = $row['output4'];
    //     $output5 = $row['output5'];
    //     $output6 = $row['output6'];


    //     echo "_output1$output1##_output2$output2##_output3$output3##_output4$output4##_output5$output5##_output6$output6";
    // } // End of the while loop

}
?>
