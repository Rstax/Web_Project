<?php $sql = "SELECT `email_address`, `password`,`first_name`,`last_name`,`id` FROM users WHERE `role_id`=2 ";
    $data = $db->query($sql);
    while($obj=$data->fetch_object())
    {
        $sql2 = "SELECT  `consultancy_fee`,`specialization` FROM doctor_details WHERE `user_id`= `$obj->id `";
        $doc = new DOMDocument();
        $table=$doc->createElement("table");
        $tablenode=$doc->appendChild($table);
        $tr = $doc->createElement("tr");
        $tablenode->appendChild($tr);
        $fn=$obj->first_name;
        $ln=$obj->last_name;
        $str=$fn.$ln;
        echo("fn")
        $th = $doc->createElement("th", "$obj->");
    }
    echo "Data Fetched Successfully";
    ?>