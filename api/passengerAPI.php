<?php
header("Access-Control-Allow-Origin: *");

require_once '../util/util.php';
require_once '../model/passenger.php';

dbConnect();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
     
     $idToGet = (int) r('id');

     if ($idToGet) {
        $passenger = getPassengerById($idToGet);
        echo json_encode($passenger);
     } else {
        $passengers = getPassengers();
        echo json_encode($passengers);
     }

} else if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
     $idToUpdate = (int)$_REQUEST['id'];

    // Read the JSON we got in the req
    //test git 
    $entity = file_get_contents('php://input');
    $entity = json_decode($entity);
    updatePassenger($entity);

} else if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
     $idToRemove = (int)$_REQUEST['id'];

     deletePassengerById($idToRemove);

} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $entity = file_get_contents('php://input');
    $entity = json_decode($entity);
   
    insertPassenger($entity);
}

$conn->close();
?>