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
            datatype: "JSON"
        });
    });
});