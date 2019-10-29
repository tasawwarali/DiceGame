
<?php

session_start();

if( isset($_SESSION['user_id']) && !empty($_SESSION['username']) ) { 

	header('Location: home.php');
} else {
	header('Location: login.php');
}

?>