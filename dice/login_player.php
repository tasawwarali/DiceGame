<?php 

require_once('model.php');


$username   = isset($_POST["uname"]) ? $_POST["uname"] : '';
$password   = isset($_POST["pass"]) ? $_POST["pass"] : '';

if( empty($username) || empty($password) ) {
    echo json_encode([
        'success' => 0,
        'message' => 'Invalid Fields'
    ]);
    exit();
}


$result = login( $username , $password );

echo json_encode($result);


// Making Session
if( $result['success'] ) {
    $_SESSION['user_id']    = $result['user_id'];
    $_SESSION['username']   = $result['username'];
}

exit();
?>