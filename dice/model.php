<?php 


/**
 * This file contains all the db related queries, stuff and function as a helper.
 */

session_start();


function connect() {
	$servername 	= "localhost";
	$username 		= "root";
	$password		= "";
	$dbname 		= "dice";

// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
	if ($conn->connect_error) {
		die("Database Connection failed : " . $conn->connect_error);
	}

	return $conn;
}



function login( $u_name , $pass ) {

	$pass = md5($pass);
	$sql = ' SELECT * FROM `players` WHERE `username` = "'.$u_name.'" and password = "'.$pass.'"';

	$conn = connect();
	$result = $conn->query($sql);

	if ( $result->num_rows > 0 ) {

		$row = $result->fetch_assoc();

		$sql2 = "UPDATE `players` SET `is_online` = 'yes' WHERE `id` =".$row['id'];
		$result = $conn->query($sql2);
		return [
			'success' 		=> 1,
			'message' 		=> 'User logged in',
			'user_id'   	=> $row['id'],
			'username'   	=> $row['username'],
		];
	} 
	else {
		return [
			'success' 	=> 0,
			'message' 	=> 'Invalid login details!'
		];
	}

}


function logout() {
	if( isset($_SESSION['user_id']) ) {
		$conn = connect();
		$sql2 = "UPDATE `players` SET `is_online` = 'no' WHERE `id` =".$_SESSION['user_id'];
		$result = $conn->query($sql2);
	}
}



function online_players() {
	$sql = ' SELECT * FROM `players` WHERE `is_online` = "yes" ';

	$conn = connect();
	$result = $conn->query($sql);
	return $result;
}



function register( $u_name , $pass ,$age ) {

	$pass = md5($pass);
	$conn = connect();

	$sql_check = 'SELECT * FROM `players` WHERE `username` = "'.$u_name.'" ';

	$result_check = $conn->query($sql_check);

	if ( $result_check->num_rows > 0 ) {
		return [
			'success' 	=> 0,
			'message' 	=> 'User already exist, please use another username'
		];
	} 

	$sql = "INSERT INTO `players` (`username`, `password` , `age`) VALUES ('".$u_name."', '".$pass."' , '".$age."')";

	if ($conn->query($sql) === TRUE) {
		return [
			'success' 	=> 1,
			'message' 	=> 'User Registered',
			'user_id'   	=> $conn->insert_id,
			'username'   	=> $u_name,
		];
	} else {
		return [
			'success' 	=> 0,
			'message' 	=> 'DB Error'
		];
	}

}




function challenging( $player_id ) {
	$conn = connect();

	$sql = "INSERT INTO `scores` (`p1_id`, `p2_id` , `p1_score` , `p2_score` , `p1_status`, `p2_status`) VALUES (".$_SESSION['user_id'].", ".$player_id." , 0 , 0 , 'Playing' , 'Playing')";

	if ($conn->query($sql) === TRUE) {
		return [
			'success' 	=> 1,
			'message' 	=> 'User Registered',
			'score_id'  => $conn->insert_id,
		];
	} else {
		return [
			'success' 	=> 0,
			'message' 	=> 'DB Error'
		];
	}
}



function save_score( $is_p1 , $score , $score_id ) {
	$conn = connect();

	if( $is_p1 == 1 ) {
		$sql = "UPDATE `scores` SET `p1_score` = ".$score." , `p1_status` = 'Done' WHERE `id` =".$score_id;
	} else {
		$sql = "UPDATE `scores` SET `p2_score` = ".$score." , `p2_status` = 'Done' WHERE `id` =".$score_id;
	}

	if ($conn->query($sql) === TRUE) {
		return [
			'success' 	=> 1,
			'message' 	=> 'User Registered',
			'score_id'  => $conn->insert_id,
		];
	} else {
		return [
			'success' 	=> 0,
			'message' 	=> 'DB Error'
		];
	}
}



function get_score($score_id){
	$sql = ' SELECT * FROM `scores` WHERE `id` = '.$score_id;
	$conn = connect();
	$result = $conn->query($sql);

	return $row = $result->fetch_assoc();
}


function check_chal(){
	$sql = 'SELECT * FROM `scores` WHERE `p2_id` = '.$_SESSION["user_id"] . ' ORDER BY `created` desc';
	// error_log( $sql );
	$conn = connect();
	return $conn->query($sql);
}

function set_win($s_id , $num) {
	$conn = connect();

	if( $num == 1 ) {
		$sql = "UPDATE `scores` SET `p1_status` = 'Win' , `p2_status` = 'Lose' WHERE `id` =".$s_id;
	} else {
		$sql = "UPDATE `scores` SET `p2_status` = 'Win' , `p1_status` = 'Lose' WHERE `id` =".$s_id;
	}


	if ($conn->query($sql) === TRUE) {
		return [
			'success' 	=> 1,
			'message' 	=> 'User Registered',
			'score_id'  => $conn->insert_id,
		];
	} else {
		return [
			'success' 	=> 0,
			'message' 	=> 'DB Error'
		];
	}

}


function get_scores() {
	$sql = 'SELECT * FROM `scores` WHERE `p2_id` = '.$_SESSION["user_id"] . ' OR `p1_id` = '.$_SESSION["user_id"];
	// error_log( $sql );
	$conn = connect();
	return $conn->query($sql);
}


?>