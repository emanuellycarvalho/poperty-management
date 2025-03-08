<?php
    function fetch_properties() {
        require_once('db_connect.php');

        $sql = "SELECT * FROM properties";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            $properties = [];
            while ($row = $result->fetch_assoc()) {
                $properties[] = $row;
            }
            return $properties;
        } else {
            return false;
        }

        $conn->close();
    }
?>
