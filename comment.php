<?php
    
    include 'controller/CommentController.php';

    $comment = new CommentController();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $comment->store($_POST);
    }
?>