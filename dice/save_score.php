<?php 

require_once('model.php');

$is_p1 		= $_POST['is_p1'];
$score 		= $_POST['score'];
$score_id 	= $_POST['score_id'];


$result = save_score( $is_p1 , $score , $score_id );

$row = get_score($score_id);

if( $row['p1_score'] > 0 && $row['p2_score'] > 0 ) {
	
	if( $row['p1_score'] > $row['p2_score'] ) {
		if( $row['p1_id'] == $_SESSION["user_id"] ) {
			$message = 'You Win!';
		} else {
			$message = 'Your Opponent Win!';
		}
		set_win($score_id , 1);

	} else {
		if( $row['p2_id'] == $_SESSION["user_id"] ) {
			$message = 'You Win!';
		} else {
			$message = 'Your Opponent Win!';
		}
		set_win($score_id , 2);

	}


	$result = [
		'success' => 2,
		'message' => $message
	];
}


echo json_encode($result);
exit();
?>