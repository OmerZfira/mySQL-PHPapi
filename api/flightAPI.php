<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods:  POST, GET, PUT, DELETE');
header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Origin, Authorization');

require_once '../util/util.php';
require_once '../model/flight.php';

dbConnect();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
     
     $idToGet = (int) r('id');
     $originToGet = r('origin');
     $destToGet = r('dest');

     if ($idToGet) {
        $flight = getFlightById($idToGet);
        // echo json_encode($flight);
     } elseif ($originToGet) {
        $flights = getFlightsByOrigin($originToGet);
        echo json_encode($flights);
     } elseif ($destToGet) {
        $flights = getFlightsByDest($destToGet);
        echo json_encode($flights);
     } else {
        $flights = getFlights();
        echo json_encode($flights);
     }

} else if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
     $idToUpdate = (int)$_REQUEST['id'];

    // Read the JSON we got in the req
    //test git 
    $entity = file_get_contents('php://input');
    $entity = json_decode($entity);
    updateFlight($entity);

} else if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
     $idToRemove = (int)$_REQUEST['id'];

     deleteFlightById($idToRemove);

} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $entity = file_get_contents('php://input');
    $entity = json_decode($entity);
    insertFlight($entity);
}

$conn->close();
?>