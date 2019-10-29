<?php 

require_once('model.php');

logout();
session_destroy();

header('Location: login.php');

?>