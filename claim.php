<?php
include_once("connection.php");

try{
    if ($_SERVER["REQUEST_METHOD"] != "POST") {
        http_response_code(405);
        echo json_encode(array("error" => "Method not allowed."));
        exit;
    }

    $arrcheckpost = array('event_id' => '', 'ticket_code' => '', 'status' => '');
    $count = count(array_intersect_key($_POST, $arrcheckpost));
    if($count != count($arrcheckpost)) throw new Exception("Parameter tidak cocok!");

    $event_id=$_POST["event_id"];
    $ticket_code=$_POST["ticket_code"];
    $status=$_POST["status"];
    $updated_at= date("Y-m-d h:i:sa");

    $update = $mysqli->prepare('UPDATE tickets SET status = ? , updated_at = ?  WHERE event_id = ? AND ticket_code = ?');
    $update->bind_param('ssis',$status, $updated_at, $event_id, $ticket_code);
    $update->execute();

    $result = $mysqli->prepare('SELECT ticket_code,status,updated_at FROM tickets WHERE event_id = ? AND ticket_code = ? LIMIT 1');
    $result->bind_param('is', $event_id, $ticket_code);
    $result->execute();
    $ticket = $result->get_result();
    $ticket = mysqli_fetch_array($ticket);
    
    $response=array(
                    'ticket_code' => $ticket['ticket_code'],
                    'status' => $ticket['status'],
                    'updated_at' => $ticket['updated_at']
                );
    header('Content-Type: application/json');
    http_response_code(200);
    echo json_encode($response);
}catch(Exception $e) {
    $response=array("error" => $e->getMessage());
    header('Content-Type: application/json');
    http_response_code(500);
    echo json_encode($response);
}

mysqli_close($mysqli);
?>