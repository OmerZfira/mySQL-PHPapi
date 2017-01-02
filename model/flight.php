<?php
function getFlights() {
    global $conn;
    $flights = array();
    $sql = "SELECT * FROM flight";
    $result = $conn->query($sql);

    while($flight = $result->fetch_object()) {
        $flights[] = $flight;
    }
    
    return $flights;
}

function getFlightById($id) {
    global $conn;
    $sql = "SELECT * FROM flight WHERE id=".$id;
    $result = $conn->query($sql);
    $flight = $result->fetch_object();
    return $flight;
}

function deleteFlightById($id) {
    global $conn;
    $sql = "DELETE FROM flight WHERE id=".$id;
    $result = $conn->query($sql);
}

function insertFlight($plane) {
    global $conn;
    $newId = null;
    $sql = 'INSERT INTO flight (origin, dest, departure_at, plane_id) VALUES ' . 
           ' ("' . $flight->origin . '", "' . $flight->dest .'", ' . $flight->departure_at .', ' . $flight->plane_id .')';

    if ($conn->query($sql) === TRUE) {
        // echo "New record created successfully";
        $newId = $conn->insert_id;
    }
    return $newId;
}

function updateFlight($flight) {
    global $conn;
    $sql = 'UPDATE flight 
    SET origin="' .$flight->origin .'" ,
        dest="'.$flight->dest.'" ,
        departure_at=' .$flight->departure_at.' ,
        plane_id=' .$flight->plane_id. ' 
    WHERE id=' . $flight->id;
    $conn->query($sql);
}

?>