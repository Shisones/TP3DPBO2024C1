<?php

class Steel extends DB {
    function getSteel() {
        $query = "SELECT * FROM steel";
        return $this->execute($query);
    }

    function getSteelById($id) {
        $query = "SELECT * FROM steel WHERE steel_id=$id";
        return $this->execute($query);
    }

    function addSteel($data) {
        $name = $data['name'];
        $query = "INSERT INTO steel VALUES('', '$name')";
        return $this->executeAffected($query);
    }

    function updateSteel($id, $data) {
        $query = "UPDATE steel SET name = '$data' WHERE steel_id = $id";
        return $this->executeAffected($query, [$new_name, $steel_id]);
    }

    function deleteSteel($id) {
        $query = "DELETE FROM steel WHERE steel_id = $id";
        return $this->executeAffected($query, [$new_name, $steel_id]);
    }
}
