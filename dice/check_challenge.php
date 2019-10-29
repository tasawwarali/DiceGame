<?php 

require_once('model.php');

if( isset($_SESSION['user_id']) && !empty($_SESSION['username']) ) {

	$result = check_chal();

	$row = $result->fetch_assoc();
	if( !empty($row) ) {

		if( $_SESSION["user_id"] == $row["p1_id"] ) {
			$sc = $row["p2_score"];
		} else {
			$sc = $row["p2_score"];
		}



		if( $row['p1_score'] > 0 && $row['p2_score'] > 0 ) {

			if( $row['p1_score'] > $row['p2_score'] ) {
				if( $row['p1_id'] == $_SESSION["user_id"] ) {
					$message = 'You Win!';
				} else {
					$message = 'Your Opponent Win!';
				}
				set_win($row['id'] , 1);

			} else {
				if( $row['p2_id'] == $_SESSION["user_id"] ) {
					$message = 'You Win!';
				} else {
					$message = 'Your Opponent Win!';
				}
				set_win($row['id'] , 2);

			}


			$result = [
				'success' => 3,
				'message' => $message,
				'op_score' => $sc
			];
		}




		$res = [
			'success' => 1,
			'message' => '',
			'score_id' => $row["id"],
			'op_score' => $sc
		];
	} else {
		$res = [
			'success' => 2,
		];
	}
	
} else {
	$res = [
		'success' => 0,
		'message' => 'Please Login',
	];
}

echo json_encode($res);

exit();
?>