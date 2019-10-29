<?php 

require_once('model.php');

$player_id = $_POST['player_id'];

$res = challenging( $player_id );

echo json_encode($res);
exit();
?>