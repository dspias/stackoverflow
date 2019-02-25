<?php
    
    include 'controller/ReplyController.php';

    $comment = new ReplyController();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $comment->store($_POST);
    }
?>