<?php

class connection
{
	public $conn = null;
	
	function __construct(){
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "pizzaup";
		// Create connection
		$this->conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($this->conn->connect_error) {
		    die("Connection failed: " . $this->conn->connect_error);
		} 
	}

	public function createCustomer($data){
		$sql = "INSERT INTO customer (name, address, zipCode, phone, email, user, password) VALUES ('".$data['name']."','".$data['address']."','".$data['zipCode']."','".$data['phone']."','".$data['email']."','".$data['user']."', '".MD5($data['password'])."')";
		if ($this->conn->query($sql) === TRUE) {
		   echo json_encode(array('status' =>'done'));
		} else {
		    //echo "Error: " . $sql . "<br>" . $this->conn->error;
		   	echo json_encode(array('status' =>'fail'));
		}
	}
	public function checkLoginCustomer($data){
		$sql = "SELECT user FROM customer  WHERE user ='".$data['user']."' and password ='".MD5($data['password'])."'";
		$result = $this->conn->query($sql);
		if (!$result->num_rows > 0) {
		    echo json_encode(array('status' =>'done'));
		} else {
		    //echo  "Error: " . $sql . "<br>" . $this->conn->error;
		   	echo json_encode(array('status' =>'fail'));
		}
	}
	/**
	 * [updateCustomer update information about the customer
	 * 	This method requierer all fields of the user ]
	 * @param  [type] $data [array with all information about the user]
	 * @return [type]       [json data]
	 */
	public function updateCustomer($data){
		if((isset($data['name'])&& isset($data['address'])&& isset($data['zipCode'])&& isset($data['phone'])&& isset($data['email'])&& isset($data['password'])&& isset($data['user']))&&  ($data['name']&& $data['address']&& $data['zipCode']&& $data['phone']&& $data['email']&& $data['password']&& $data['user']) ){
			$sql = "UPDATE customer SET name='".$data['name']."', address='".$data['address']."', zipCode='".$data['zipCode']."', phone='".$data['phone']."', email='".$data['email']."', password='".MD5($data['password'])."' WHERE user='".$data['user']."'";
			if ($this->conn->query($sql) === TRUE) {
			   echo json_encode(array('status' =>'done'));
			} else {
			   	echo json_encode(array('status' =>'fail'));
			}
		}
		else{
			echo json_encode(array('status' =>'fail','message'=>'you are missing some required fields'));

		}
	}


}

//(md5($str) == "8b1a9953c4611296a827abf8c47804d7")
//
//
//