<section class="profile-body">
    <div class="container-fluid">
        
        <div class="row">

            <div class="col-md-8 offset-2">
                <div class="profile-details">
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                                $post = new PostController();
                                $posts = $post->allpost();
                                if($posts){
                                    while($post = $posts->fetch_assoc()){
                            ?>
                            <div class="posts card gedf-card alumni-post">
                                <div class="card-header">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="mr-2">
                                                <img class="rounded-circle" style="width: 45px; height: 45px;" src="http://www.juliehamilton.ca/resources/finance-icon-2.png" alt="">                                                
                                            </div>
                                            <div class="ml-2">
                                                <div class="h5 m-0"><?php echo $post['username']; ?></div>
                                                <div class="text-muted"><?php echo $post['email']; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body" id="viewPost">
                                    
                                    <h5 class="card-title"><?php echo $post['title']; ?> (<?php echo $post['category_name']; ?>)</h5>

                                    <p class="card-text">
                                    <?php echo $post['body']; ?>
                                    </p>
                                </div>
                                <div class="card-footer">
                                    <div class="float-left">
                                    
                                    
                                        <!-- <a href="#" class="card-link"><i class="far fa-heart"></i> Like <sup>(112)</sup></a> -->
                                        <!-- <a href="#" class="card-link"><i class="fas fa-heart" style="color:red;"></i> Unlike <sup>(55)</sup></a> -->
                                      

                                        <a href="#" class="card-link comment" id="comment<?php echo $post['id']; ?>"><i class="far fa-comments"></i> Comment <sup>(55)</sup></a>
                                    </div>
                                    <div class="float-right">

                                    <?php
                                    
                                        
                                        $myDateTime = new DateTime($post['updated_at']);
                                        // $myDateTime->setTimezone(new DateTimeZone('GMT+06:00'));
                                        
                                    ?>
                                        <strong class="post-time-date"><?php echo $myDateTime->format('d-m-Y | h:i A'); ?> </strong>
                                    </div>
                                </div>
                                <div class="card-body post-comment" id="post-comment<?php echo $post['id']; ?>">
                                    <div class="new-comment">
                                        <form method="POST" id="comment-post<?php echo $post['id']; ?>">
                                            <div class="row">
                                                <div class="col-md-9">
                                                    <textarea class="form-control comment-area" id="postComment" rows="1" placeholder="Post a comment" name="postComment"></textarea>
                                                    <input type="number" class="form-control" name="post_id" value="<?php echo $post['id']; ?>" style="display:none;">
                                                    <input type="number" class="form-control" name="user_id" value="<?php echo Session::get('id'); ?>" style="display:none;">
                                                </div>
                                                <div class="col-md-3">
                                                    <button id="comment-submit" class="btn btn-primary btn-lg btn-block btn-comment">Comment</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    
                                    <?php
                                        $comment = new CommentController();
                                        $comments = $comment->getAllComment($post['id']);
                                        if($comments){
                                            while($comment = $comments->fetch_assoc()){
                                    ?>
                                    <div class="user-comments">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex justify-content-between align-items-center">

                                                <a href="#" class="btn btn-light btn-sm comment-delete" id="dltCmnt"><i class="fas fa-trash-alt"></i></a>
                                                <div class="mr-2">
                                                    <img class="rounded-circle" style="width: 45px; height: 45px;" src="http://www.juliehamilton.ca/resources/finance-icon-2.png" alt="">
                                                </div>
                                                <div class="ml-2">
                                                    <div class="h5 m-0"> <?php echo $comment['username']?> </div>
                                                <?php
                                                    // $date = date_create($post->updated_at);
                                                    $commentDate = new DateTime($comment['updated_at']);
                                                    // $commentDate->setTimezone(new DateTimeZone('GMT+06:00'));
                                                    
                                                ?>
                                                    <div class="text-muted"><?php echo $commentDate->format('d-m-Y | h:i A'); ?></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="comnt"> <?php echo $comment['comment']?> </div>

                                        <div class="replies">
                                            <div class="all-reply">
                                                <div class="row">
                                                    <div class="col-md-11 offset-md-1">
                                                        <hr>
                                                        <?php
                                                            $reply = new ReplyController();
                                                            $replies = $reply->getAllReply($post['id'], $comment['id']);

                                                            if($replies){
                                                                while($reply = $replies->fetch_assoc()){
                                                        ?>
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="mr-2">
                                                                    <img class="rounded-circle" style="width: 45px; height: 45px;" src="http://www.juliehamilton.ca/resources/finance-icon-2.png" alt="">
                                                                    <span> <?php echo $reply['username']; ?> </span>
                                                                </div>

                                                            </div>
                                                            <div class="col-md-9">
                                                                <?php echo $reply['reply']; ?>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <?php } } ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="new-comment">
                                                <form method="POST" id="reply-post<?php echo $comment['id']; ?>">
                                                    <div class="row">
                                                        <div class="col-md-9 offset-md-1">
                                                            <textarea class="form-control comment-area" id="commentReply" rows="1" placeholder="reply a comment" name="replyComment"></textarea>
                                                            <input type="number" class="form-control" name="post_id" value="<?php echo $post['id']; ?>" style="display:none;" >
                                                            <input type="number" class="form-control" name="comment_id" value="<?php echo $comment['id']; ?>" style="display:none;" >
                                                            <input type="number" class="form-control" name="user_id" value="<?php echo Session::get('id'); ?>" style="display:none;" >
                                                        </div>
                                                        <div class="col-md-2">
                                                            <button  id="reply-submit" class="btn btn-primary btn-lg btn-block btn-comment reply-submit">reply</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <?php  } } ?>

                                </div>
                            </div>
                            <?php } } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>