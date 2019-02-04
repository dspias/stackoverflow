// Slide Toggle
$(document).ready(function() {
    $("a.comment").click(function() {
        var comment = '#' + $(this).attr('id');
        console.log(comment);
        var postComment = '#post-comment' + comment.substring(8, comment.length);
        $(postComment).slideToggle();
        return false;
    });
});