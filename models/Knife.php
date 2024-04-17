<?php

class Knife extends DB {
    function getKnifeJoin() {
        $query = "SELECT * FROM knife JOIN steel ON knife.steel_id=steel.steel_id JOIN maker ON knife.maker_id=maker.maker_id ORDER BY knife.knife_id";
        return $this->execute($query);
    }

    function getKnife() {
        $query = "SELECT * FROM knife";
        return $this->execute($query);
    }

    function getKnifeById($id) {
        $query = "SELECT * FROM knife JOIN steel ON knife.steel_id=steel.steel_id JOIN maker ON knife.maker_id=maker.maker_id WHERE knife_id=$id";
        return $this->execute($query);
    }

    function searchKnife($keyword) {
        $query = "SELECT * FROM knife JOIN steel ON knife.steel_id=steel.steel_id JOIN maker ON knife.maker_id=maker.maker_id WHERE knife_name LIKE '%$keyword%'";
        return $this->execute($query);
    }
    
    function addData($data, $file) {
        $knife_pic = $data['knife_pic'];
        $knife_code = $data['knife_code'];
        $knife_name = $data['knife_name'];
        $knife_material = $data['knife_material'];
        $maker_id = $data['maker_id'];
        $steel_id = $data['steel_id'];
    
        $query = "INSERT INTO knife (knife_pic, knife_code, knife_name, knife_material, maker_id, steel_id) VALUES ('$knife_pic', '$knife_code', '$knife_name', '$knife_material', $maker_id, $steel_id)";
        
        return $this->executeAffected($query);
    }

    function updateData($id, $data, $file)
    {
        // ...
    }

    function deleteData($id) {
        $query = "DELETE FROM knife WHERE knife_id = $id";
        return $this->executeAffected($query);
    }
}
