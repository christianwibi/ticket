<?php
include_once("connection.php");

$event_id = $argv[1];
$total_ticket = $argv[2];

function random_alphanumerics($len)
{
    $result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    return substr(str_shuffle($result),0, $len);
}

$result = $mysqli->prepare('SELECT name FROM events WHERE event_id = ? LIMIT 1');
$result->bind_param('i', $event_id);
$result->execute();
$event = $result->get_result();

$event = mysqli_fetch_array($event);
if(!$event) throw new Exception("Event tidak ditemukan!");

try{
    for ($i = 0; $i < $total_ticket; $i++) {
        $ticket_code = strtoupper(substr($event['name'], 0, 3)).random_alphanumerics(7);
        $insert = $mysqli->prepare('INSERT INTO tickets (event_id, ticket_code) VALUES ( ? , ? )');
        $insert->bind_param('is', $event_id, $ticket_code);
        $insert->execute();

        if ($insert) {
            echo "Kode tiket $ticket_code berhasil dibuat!\n";
        } else {
            echo "Gagal membuat tiket: " . mysqli_error($mysqli) . "\n";
        }
    }
}catch(Exception $e) {
    echo 'Message: ' .$e->getMessage();
}

mysqli_close($mysqli);
?>