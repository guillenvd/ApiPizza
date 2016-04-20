<?php 
require_once '../src/lib/connection.php';
class User extends Connection
{
	/**
	 * @param [array] $[data] [array with all data about the customer]
	 */
	public function signupCustomer($data){
		if((isset($data['name'])&& isset($data['address'])&& isset($data['zipCode'])&& isset($data['phone'])&& isset($data['email'])&& isset($data['password'])&& isset($data['user']))&&  ($data['name']&& $data['address']&& $data['zipCode']&& $data['phone']&& $data['email']&& $data['password']&& $data['user'])  ){
			if( (int)$this->validateExistUser($data['user']) != 0 ){
				 echo $_GET['callback']."(".json_encode(array('status' =>'fail','code'=>'13', 'msg'=>'This user already exists.')).");";
			}
			else if(  (int)$this->validateExistEmail($data['email']) != 0  ){
				 echo $_GET['callback']."(".json_encode(array('status' =>'fail','code'=>'14', 'msg'=>'This email already exists.')).");";
			}else{
				$sql = "INSERT INTO customer (name, address, zipCode, phone, email, gender, user, pass) VALUES ('".$data['name']."','".$data['address']."','".$data['zipCode']."','".$data['phone']."','".$data['email']."','".$data['gender']."','".$data['user']."', '".MD5($data['password'])."')";
				if ($this->conn->query($sql) === TRUE) {
				   echo $_GET['callback']."(".json_encode(array('status' =>'done','code'=>'10', 'msg'=>'Account Created successfully')).");";
				} else {
				    if($env == "dev")
				    	echo "Error: " . $sql . "<br>" . $this->conn->error;
				    echo $_GET['callback']."(".json_encode(array('status' =>'fail','code'=>'11','msg'=>'Something going bad with the database')).");";
				}
			}
		}else{
			echo $_GET['callback']."(".json_encode(array('status' =>'fail','code'=>'12', 'message'=>'you are missing some required fields')).");";

		}
		
	}
	public function validateExistUser($user){
		$sql = "SELECT count(id) as users from customer where user = '".$user."'";
		while( $row = $this->conn->query($sql)->fetch_assoc() ) {
			return $row["users"];
		}
	}
	public function validateExistEmail($email){
		$sql = "SELECT count(id) as emails from customer where email = '".$email."'";
		while( $row = $this->conn->query($sql)->fetch_assoc() ) {
			return $row["emails"];
		}
	}

	public function checkLoginCustomer($data){
		$sql = "SELECT user, id FROM customer  WHERE user ='".$data['user']."' and pass ='".MD5($data['password'])."'";
		$result = $this->conn->query($sql);
		if ($result->num_rows) {
			while( $row = $this->conn->query($sql)->fetch_assoc() ) {
				echo json_encode(array('status' =>'done', 'code'=>'15', 'msg'=>'Login successfully', 'data'=>array('user'=>$row["user"], 'id'=>$row["id"])));
				exit;
			}
		} else {
		    //echo  "Error: " . $sql . "<br>" . $this->conn->error;
		   	echo json_encode(array('status' =>'fail', 'code'=>'16', 'msg'=>'Bad Login'));
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
				echo $_GET['callback']."(".json_encode(array('status' =>'done', 'code'=>'17', 'msg'=>'update successfully')).");";
			} else {
			   	echo $_GET['callback']."(".json_encode(array('status' =>'fail', 'code'=>'18', 'msg'=>'bad update')).");";

			}
		}
		else{
			echo $_GET['callback']."(".json_encode(array('status' =>'fail','code'=>'12', 'msg'=>'you are missing some required fields')).");";
		}
	}


}

?>