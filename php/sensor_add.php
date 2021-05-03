<?php
    $pin = 0;
    $sensor = 0;
    $label = 0;
    $espId = 0;
    foreach($_REQUEST as $key => $value) {
        if($key =='sensor'){
            $sensor = $value;
        }
        if($key =='pin'){
            $pin = $value;
        }
        if($key =='label'){
            $label = $value;
        }
        if($key =='espID'){
            $espId = $value;
            processDrpdown($pin,$sensor,$label,$espId);
        }
        
    }
    function processDrpdown($pin,$sensor,$label,$espID) {
        $con = mysqli_connect("localhost", "root", "", "egnion_yomi");
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        $sql1 = "INSERT INTO `connected_sensors`(`label`, `esp_id`, `sensor_id`) VALUES ('$label',$espID,$sensor)";
        $sql2 = "SELECT ID FROM `connected_sensors` WHERE esp_id=$espID ORDER BY connected_sensors.ID DESC LIMIT 1";
        $sql3 = "SELECT ID FROM `pins` WHERE pin_number = $pin";
        mysqli_query($con,$sql1);
        $result2 = mysqli_fetch_assoc(mysqli_query($con,$sql2));
        $result3 = mysqli_fetch_assoc(mysqli_query($con,$sql3));
        $csid = $result2['ID'];
        $pid = $result3['ID'];
        $sql4 = "INSERT INTO `used_pins`(`connected_sersor_id`, `pin_id`) VALUES ($csid,$pid)";
        mysqli_query($con, $sql4);		
        $sql = "SELECT * FROM `sensors` INNER JOIN `connected_sensors` ON sensors.ID=connected_sensors.sensor_id WHERE esp_id=$espID ORDER BY connected_sensors.ID DESC LIMIT 1";
        $sql1 = "SELECT COUNT(ID) as countid FROM `connected_sensors` WHERE esp_id=$espID";
        $q = $con->query($sql);
        $Q = $con->query($sql1);
        $i = 0;
        $count = 0;
        while ($R = $Q->fetch_assoc()) {        
            if($i==0){
             echo $count = $R['countid'];   
            }
        }
        while ($r = $q->fetch_assoc()) {
            if($i==0){
            $temp = $r['type'];
            $temp2 = ($temp == 0) ? 'Analog' : 'Digital';
            $temp = $r['iomode'];
            $temp3 = ($temp == 0) ? 'Output' : 'Input';
            echo $tablerow = '<tr ><td>' . $count . '</td><td>' . $r['name'] . '</td><td>' . $r['label'] . '</td><td>' . $temp2 . '</td><td>' . $temp3 . '</td></tr>';     
            }
            $i++;
        }
    };
?>