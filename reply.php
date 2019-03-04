<?php
    
    include 'controller/ReplyController.php';

    $reply = new ReplyController();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $replis = $reply->store($_POST);

        header('Content-type:application/json;charset=utf-8');
        echo json_encode( $replis );
    }
?>

