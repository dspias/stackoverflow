<?php
    $post = new PostController();

    $posts = $post->unApprovedPost();

    if (isset($_GET['approveId'])) {
        echo $_GET['approveId'];
        $approved = $post->approvedPost($_GET['approveId']);
        if($approved) {
            echo $approved;
        }
    }

    if (isset($_GET['deleteId'])) {
        $deletePost = $post->adminDeletePost($_GET['deleteId']);
        if($deletePost) {
            echo $deletePost;
        }
    }
?>


<section class="approval">
<div class="container"></div>
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <table class="table">
                <thead>
                    <tr>
                        <th>sl</th>
                        <th>username</th>
                        <th>category</th>
                        <th>body</th>
                        <th>action</th>
                    </tr>
                </thead>
                

                <?php
                    if($posts){
                        $i=1;
                        while($post = $posts->fetch_assoc()){
                ?>
                <tbody>
                    <tr>
                        <td scope="col"><?php echo $i; $i++;?></td>
                        <td scope="col"><?php echo $post['username']; ?></td>
                        <td scope="col"><?php echo $post['category_name']; ?></td>
                        <td scope="col"><?php echo $post['body']; ?></td>
                        <td scope="row">                                     
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="?approveId=<?php echo $post['id']; ?>" class="btn btn-info btn-sm">
                                        <i class="far fa-question-circle"></i>
                                        approved
                                    </a>
                                <a href="?deleteId=<?php echo $post['id']; ?>" class="btn btn-danger btn-sm" onclick="confirm('Are You Sure to Delete This User...?')">
                                <i class="far fa-trash-alt"></i>
                                    Delete
                                </a>
                            </div>
                        </td>
                    </tr>
                </tbody>
                <?php } } ?>
                
            </table>
        </div>
    </div>
</div>
</section>