<?php

class Maker extends DB {
    function getMaker() {
        $query = "SELECT * FROM maker";
        return $this->execute($query);
    }

    function getMakerById($id) {
        $query = "SELECT * FROM maker WHERE maker_id=$id";
        return $this->execute($query);
    }

    function addMaker($data) {
        $name = $data['name'];
        $query = "INSERT INTO maker VALUES('', '$name')";
        return $this->executeAffected($query);
    }

    function updateMaker($id, $data) {
        $query = "UPDATE maker SET name = '$data' WHERE maker_id = $id";
        return $this->executeAffected($query);
    
    }

    function deleteMaker($id) {
        $query = "DELETE FROM maker WHERE maker_id = $id";
        return $this->executeAffected($query);
    }
}
