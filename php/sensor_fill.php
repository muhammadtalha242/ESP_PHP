<?php
    $val1 = 0;
    $val2 = 0;
    foreach($_REQUEST as $key => $value) {
        if($key =='dropdownValue'){
            $val1 = $value;
        }
        if($key =='espID'){
            $val2 = $value;
            processDrpdown($val1,$val2);
        }
    }
    function processDrpdown($selectedVal,$espID) {
        $con = mysqli_connect("localhost", "root", "", "egnion_yomi");
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        $sql = "SELECT * FROM `sensors` WHERE ID = $selectedVal";
        $result = mysqli_query($con,$sql);
        $i = 0;									
        while($row=mysqli_fetch_assoc($result)) {
            if($i==0){
                $type1 = $row['type'];
                $t1 = ($type1==0) ? 'Analog' : (($type1==1) ? 'Digital' : 'Communication');
                $pinselect = $row['pins_required'];
                $type3 = $row['iomode'];
                $t3 = ($type3==0) ? 'Output' : (($type3==1) ? 'Input' : 'I/O');	
                $r = $t1."-".($pinselect)."-".$t3;
                $sql1 = "SELECT pin_name,pin_number From pins as p1 WHERE p1.Type=$type1 AND p1.iomode=$type3 AND p1.ID NOT IN (SELECT pins.ID FROM pins INNER JOIN used_pins On pins.ID=used_pins.pin_id INNER JOIN connected_sensors on used_pins.connected_sersor_id=connected_sensors.ID WHERE connected_sensors.esp_id=$espID AND pins.Type=$type1 AND pins.iomode=$type3)";
                $result1 = mysqli_query($con,$sql1);
                while($row1=mysqli_fetch_assoc($result1)) {
                    $r = $r."-".$row1['pin_name']."-".($row1['pin_number']);
                }
                echo $r;
            }
            $i +=1;
        }
    };
?>