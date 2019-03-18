<?php
    
    include 'controller/CommentController.php';

    $comment = new CommentController();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $comment = $comment->store($_POST);

        header('Content-type:application/json;charset=utf-8');
        echo json_encode( $comment );
    }
?>