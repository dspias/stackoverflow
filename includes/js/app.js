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
        console.log(formData);

        $.ajax({
            method: 'POST',
            url: 'comment.php',
            data: formData,
            datatype: "JSON"
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
            success: function() {
                console.log("hello");
            }
        });
    });
});


/* <div class="row">
    <div class="col-md-3">
        <div class="mr-2">
            <img class="rounded-circle" style="width: 45px; height: 45px;" src="http://www.juliehamilton.ca/resources/finance-icon-2.png" alt="">
            <span> sperrow </span>
        </div>
    </div>
    <div class="col-md-9"> gsdgs </div>
</div> */