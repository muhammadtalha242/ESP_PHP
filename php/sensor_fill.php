<?php
    foreach($_REQUEST as $key => $value) {
        if($key =='dropdownValue'){
            processDrpdown($value);
        }
    }

    function processDrpdown($selectedVal) {
        $con = mysqli_connect("localhost", "root", "", "egnion_yomi");
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        $selectedVal.trim($selectedVal,"\"");
        $sql = "SELECT * FROM `sensors` WHERE ID = $selectedVal";
        $result = mysqli_query($con,$sql);
        $i = 0;
        $type1 = '';
        $type3 = '';										
        while($row=mysqli_fetch_assoc($result)) {
            if($i==0){
                $type1 = $row['type'];
                $t1 = ($type1==0) ? 'Analog' : (($type1==1) ? 'Digital' : 'Communication');
                $pinselect = $row['pins_required'];
                $type3 = $row['iomode'];
                $t3 = ($type3==0) ? 'Output' : (($type3==1) ? 'Input' : 'I/O');	
                $r = $t1."-".($pinselect)."-".$t3;
                echo $r;
            }
            $i +=1;
        }
    };
?>