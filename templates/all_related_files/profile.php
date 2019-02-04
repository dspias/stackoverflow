<?php
    $categories = new CategoryController();
    $post = new PostController();
    
    $categories = $categories->getAllCategory();
    $posts = $post->userallPost();

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        $errors = $post->store($_REQUEST);
    }
?>
<section class="profile-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 offset-2">
                <div class="card profile-post-card">
                    <div class="card-header">
                        create post
                    </div>
                    <form action="" method="POST">
                        <div class="row">
                            <div class="col-md-6" style="margin-top:5px;">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="title" placeholder="Enter Post Title" name="title" required>
                                </div>
                            </div>

                            <div class="col-md-6" style="margin-top:5px;">
                                <div class="input-group">
                                    <select class="custom-select" id="inputGroupSelect04" aria-label="Example select with button addon" name="cat_id" required>
                                        <option selected>Choose Category ...</option>
                                    <?php
                                        if($categories){
                                            while($category = $categories->fetch_assoc()){
                                    ?>
                                        <option value="<?php echo $category['id']; ?>"> <?php echo $category['category_name']; ?> </option>
                                    <?php } } ?>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea id="my-input" class="form-control" rows="3" required name="body" placeholder="write there"></textarea>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <button type="submit" class="btn btn-outline-info btn-share float-right">Share</button>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
        
        <div class="row">

            <div class="col-md-8 offset-2">
                <div class="profile-details">
                    <div class="row">
                        <div class="col-md-12">
                            <?php
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
                                        // $date = date_create($post->updated_at);
                                        $myDateTime = new DateTime('2019-01-19 07:30:04');
                                        $myDateTime->setTimezone(new DateTimeZone('GMT+06:00'));
                                        
                                    ?>
                                        <strong class="post-time-date"><?php $myDateTime->format('d-m-Y | h:i A') ?> </strong>
                                    </div>
                                </div>
                                <div class="card-body post-comment" id="post-comment<?php echo $post['id']; ?>">
                                    <div class="new-comment">
                                        <form action="#" method="POST">
                                            <div class="row">
                                                <div class="col-md-9">
                                                    <textarea class="form-control comment-area" id="postComment" rows="1" placeholder="Post a comment" name="postComment"></textarea>
                                                </div>
                                                <div class="col-md-3">
                                                    <button type="sumbit" class="btn btn-primary btn-lg btn-block btn-comment">Comment</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    
                                    <?php
                                        if(isset($comments)){
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
                                                    <div class="h5 m-0">user name</div>
                                                <?php
                                                    // $date = date_create($post->updated_at);
                                                    $commentDate = new DateTime('2019-01-19 07:30:04');
                                                    $commentDate->setTimezone(new DateTimeZone('GMT+06:00'));
                                                    
                                                ?>
                                                    <div class="text-muted"><?php $commentDate->format('d-m-Y | h:i A') ?></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="comnt">conljal</div>
                                    </div>
                                    <?php } }?>

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