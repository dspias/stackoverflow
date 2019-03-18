// Slide Toggle
$(document).ready(function() {
    $("a.comment").click(function() {
        var comment = '#' + $(this).attr('id');
        var postComment = '#post-comment' + comment.substring(8, comment.length);
        $(postComment).slideToggle();
        return false;
    });
});

// =================================================== commnet post submit ============================================
$(document).ready(function() {
    $("button#comment-submit").click(function(event) {

        var parent = '#'+$(this).parent().parent().parent().attr('id');

        event.preventDefault(); 
        var form = $(parent);
        var formData = $(form).serialize();

        $.ajax({
            method: 'POST',
            url: 'comment.php',
            data: formData,
            datatype: "JSON",
            success: function(data) {
                var string = "<div class='user-comments'><div class='d-flex justify-content-between align-items-center'><div class='d-flex justify-content-between align-items-center'><a href='#' class='btn btn-light btn-sm comment-delete' id='dltCmnt'><i class='fas fa-trash-alt'></i></a><div class='mr-2'><img class='rounded-circle' style='width: 45px; height: 45px;' src='http://www.juliehamilton.ca/resources/finance-icon-2.png' alt=''></div><div class='ml-2'><div class='h5 m-0'> "+data[0].username+" </div><div class='text-muted'>"+data[0].updated_at+"</div></div></div></div><div class='comnt'> "+data[0].comment+" </div><div class='replies'><div class='all-reply'><div class='row'><div class='col-md-11 offset-md-1' id='allreply"+data[0].id+"'><hr></div></div></div><div class='new-comment'><form method='POST' id='reply-post"+data[0].id+"'><div class='row'><div class='col-md-9 offset-md-1'><textarea class='form-control comment-area' id='commentReply"+data[0].id+"' rows='1' placeholder='reply a comment' name='replyComment'></textarea><input type='number' class='form-control' name='post_id' value='"+data[0].post_id+"' style='display:none;'><input type='number' class='form-control' name='comment_id' value='"+data[0].id+"' style='display:none;'><input type='number' class='form-control' name='user_id' value='"+data[0].user_id+"' style='display:none;'></div><div class='col-md-2'><button id='reply-submit' class='btn btn-primary btn-lg btn-block btn-comment reply-submit'>reply</button></div></div></form></div></div></div>";

                
                var picId = "#post-comment"+data[0].post_id;
                var replyform = "#postComment"+data[0].post_id;
                $(replyform).val("");
                $(picId).append(string);
            }
        });
    });
});

// =================================================== reply comment submit =================================

$(document).ready(function() {
    $("button#reply-submit").click(function(event) {

        var parent = '#'+$(this).parent().parent().parent().attr('id');

        event.preventDefault(); 
        var form = $(parent);
        var formData = $(form).serialize();

        $.ajax({
            method: 'POST',
            url: 'reply.php',
            data: formData,
            datatype: "JSON",
            success: function(data) {
                var string = "<div class='row'><div class='col-md-3'><div class='mr-2'><img class='rounded-circle' style='width: 45px; height: 45px;' src='http://www.juliehamilton.ca/resources/finance-icon-2.png' alt=''><span> "+data[0].username+" </span></div></div><div class='col-md-9'> "+data[0].reply+" </div></div><hr>";

                var picId = "#allreply"+data[0].comment_id;
                var replyform = "#commentReply"+data[0].comment_id;
                $(replyform).val("");
                $(picId).append(string);
            }
        });
    });
});








