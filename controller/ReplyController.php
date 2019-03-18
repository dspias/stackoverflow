<?php
	
	$filepath = realpath(dirname(__FILE__));
	// include ($filepath.'/../config/Session.php');
	// Session::checkLogin();
	
	include_once ($filepath.'/../config/Database.php');
	include_once ($filepath.'/../config/Format.php');

?>
<?php
/*
*
* @ Reply controller
*
*/
class ReplyController{
    private $db;
    private $fm;

	public function __construct() {
		$this->db = new Database();
        $this->fm = new Format();
    }

    public function store($request){

        $user_id = $this->fm->validation($request['user_id']);
        $post_id = $this->fm->validation($request['post_id']);
        $comment_id = $this->fm->validation($request['comment_id']);
        $reply = $this->fm->validation($request['replyComment']);

		$user_id = mysqli_real_escape_string($this->db->link, $user_id);
		$post_id = mysqli_real_escape_string($this->db->link, $post_id);
		$comment_id = mysqli_real_escape_string($this->db->link, $comment_id);
        $reply = mysqli_real_escape_string($this->db->link, $reply);

        $query = "INSERT INTO replies (post_id,comment_id, user_id, reply, created_at, updated_at)
        VALUES ('$post_id','$comment_id', '$user_id', '$reply', now(), now())";

        $result = $this->db->insert($query);

        $query = "SELECT r.id, u.username, u.email, r.reply, r.comment_id, r.updated_at FROM replies AS r INNER JOIN users AS u ON u.id = r.user_id WHERE r.post_id = '$post_id' AND r.comment_id = '$comment_id' ORDER BY r.id DESC LIMIT 1";

        $data = $this->db->select($query);

        // $data = array($data);

        if($data){
            $i=0;
            $array = [];
            while($dat = $data->fetch_assoc()){
                $array[$i] = $dat;
                $i++;
            }
        }

        return $array;

    }
    
    public function getAllReply($post_id, $comment_id){
        $post_id = $this->fm->validation($post_id);
        $comment_id = $this->fm->validation($comment_id);
        $post_id = mysqli_real_escape_string($this->db->link, $post_id);
        $comment_id = mysqli_real_escape_string($this->db->link, $comment_id);

        $query = "SELECT r.id, u.username, u.email, r.reply, r.updated_at FROM replies AS r INNER JOIN users AS u ON u.id = r.user_id WHERE r.post_id = '$post_id' AND r.comment_id = '$comment_id' ";

        $result = $this->db->select($query);

        return $result;
    }

}
?>