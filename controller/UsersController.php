<?php
	
	$filepath = realpath(dirname(__FILE__));
	include ($filepath.'/../config/Session.php');
	Session::checkLogin();
	
	include_once ($filepath.'/../config/Database.php');
	include_once ($filepath.'/../config/Format.php');

?>


<?php

/**
 * 
 */
class UsersController {
	
	private $db;
    private $fm;
    private $errors; 

	public function __construct() {
		$this->db = new Database();
        $this->fm = new Format();
        $this->errors = array();
    }
    
    public function userRegister($request){

        $username = $this->fm->validation( $request['username'] );
        $email = $this->fm->validation( $request['email'] );
        $password = $this->fm->validation( $request['password'] );
        $confirm_password = $this->fm->validation( $request['confirm_password'] );
        
        
        $username = mysqli_real_escape_string( $this->db->link, $username );
        $email = mysqli_real_escape_string( $this->db->link, $email );
        $password = mysqli_real_escape_string( $this->db->link, $password );
        $confirm_password = mysqli_real_escape_string( $this->db->link, $confirm_password );

        // form validation: ensure that the form is correctly filled ...
        // by adding (array_push()) corresponding error unto $errors array
        if (empty($username)) { array_push($this->errors, "username is required"); }
        if (empty($email)) { array_push($this->errors, "Email is required"); }
        if (empty($password)) { array_push($this->errors, "Password is required"); }
        if(strlen($password) < 6){ array_push($this->errors, "Password length minimum 6"); }
        if ($password != $confirm_password) {
            array_push($this->errors, "The two passwords do not match");
        }

        // first check the database to make sure 
        // a user does not already exist with the same username and/or email
        $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
        $result = $this->db->select($user_check_query);        
        $user = mysql_fetch_assoc($result);
        
        if ($user) { // if user exists
            if ($user['username'] === $username) {
            array_push($errors, "username already exists");
            }

            if ($user['email'] === $email) {
            array_push($errors, "email already exists");
            }
        }


        // // Finally, register user if there are no errors in the form
        // if (count($errors) == 0) {
        //     $password = md5($password);//encrypt the password before saving in the database

        //     $query = "INSERT INTO users (username, email, password) 
        //             VALUES('$username', '$email', '$password')";
        //     mysqli_query($db, $query);
        //     $_SESSION['username'] = $username;
        //     $_SESSION['success'] = "You are now logged in";
        //     header('location: index.php');
        // } else{
        //     return $this->errors;
        // }


    }



	public function userLogin($request) {
		$adminUser = $this->fm->validation($adminUser);
		$adminPass = $this->fm->validation($adminPass);

		$adminUser = mysqli_real_escape_string($this->db->link, $adminUser);
		$adminPass = mysqli_real_escape_string($this->db->link, $adminPass);

		if(empty($adminUser) || empty($adminPass)){
			
			$loginMsg = "";
			return $loginMsg;
			
		} else {
			$query = "SELECT * FROM tbl_admin WHERE adminUser = '$adminUser' AND adminPass = '$adminPass'";
			$result = $this->db->select($query);

			if($result != false) {
				$value = $result->fetch_assoc();

				Session::set("adminLogin", true);
				Session::set("adminId", $value['adminId']);
				Session::set("adminUser", $value['adminUser']);
				Session::set("adminusername", $value['adminusername']);

				header("Location:dashbord.php");
			} else {
				$loginMsg = " name or Password is not Match !!!";
				return $loginMsg;
			}
		}
	}
}

?>