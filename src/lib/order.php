<?php 
require_once '../src/lib/connection.php';

	class Products extends Connection
	{
		public function orderCustomer($data){
			//var_dump($data);
			if(isset($data['order_date'])&&isset($data['customer_id'])&&isset($data['total_price'])&&isset($data['order_distance'])&&isset($data['product_id'])&&isset($data['quantity'])){
				$sql = "INSERT INTO `order` (`id`, `order_date`, `customer_id`, `total_price`, `order_distance`, `statusTable`) VALUES (NULL, '".$data['order_date']."', '".$data['customer_id']."','".$data['total_price']."', '".$data['order_distance']."', 'in order')";
				

				if ($this->conn->query($sql) === TRUE) {
					$sql2 = "INSERT INTO `pizz`.`item_order` (`order_id`, `product_id`, `quantity`, `description`) VALUES ('".$this->conn->insert_id."','".$data['product_id']."', '".$data['quantity']."', '".$data['description']."');";

						if ($this->conn->query($sql2) === TRUE) {
						   echo $_GET['callback']."(".json_encode(array('status' =>'done','code'=>'10', 'msg'=>'Order Created successfully', 'idOrder'=>$this->conn->insert_id)).");";
						} else {
						    if($this->env == "dev")
						    	echo "Error: " . $sql . "<br>" . $this->conn->error;
						    echo $_GET['callback']."(".json_encode(array('status' =>'fail','code'=>'11','msg'=>'Something going bad with the database')).");";}


				} else {
				    if($this->env == "dev")
				    	echo "Error: " . $sql . "<br>" . $this->conn->error;
				    echo $_GET['callback']."(".json_encode(array('status' =>'fail','code'=>'11','msg'=>'Something going bad with the database')).");";}
				    //$conn->insert_id
			}else{
				echo $_GET['callback']."(".json_encode(array('status' =>'fail','code'=>'12', 'msg'=>'you are missing some required fields')).");";
			}

		}

		public function orderById($data){
		  if(isset($data['orderId'])){ 
			$products =array(); $i=0;
			$sql =  "SELECT a.price as price, b.description as description, d.model_desc as models, e.*, f.* FROM product a , product_type b, models d, `order` e, item_order f, category g WHERE e.id = ".$data['orderId']." and e.id = f.order_id and a.id = f.product_id and d.id = a.model_id and a.type_id = b.id and a.type_id = b.id and b.category_id = g.id";
				$result = $this->conn->query($sql);

				if ($result->num_rows > 0) {
				    while($row = $result->fetch_assoc()) {
				        $products[$i] = $row;
				        $i++;
				    }
				    echo $_GET['callback']."(".json_encode(array('code'=>22,'msg'=>'order found','order'=>$products)).");";
				}else{
				    echo $_GET['callback']."(".json_encode(array('code'=>20,"msg"=>"Order not found")).");";
				}
		   }else{
		   	echo $_GET['callback']."(".json_encode(array('status' =>'fail','code'=>'12', 'msg'=>'you are missing some required fields')).");";
		  }
		}


		public function orderByCustomer($data){
		  if(isset($data['customerId'])){ 
			$products =array(); $i=0;
			$sql =  "SELECT a.price as price, b.description as description, d.model_desc as models, e.*, f.* FROM product a , product_type b, models d, `order` e, item_order f, category g WHERE e.customer_id =".$data['customerId']." and e.id = f.order_id and a.id = f.product_id and d.id = a.model_id and a.type_id = b.id and a.type_id = b.id and b.category_id = g.id";
				$result = $this->conn->query($sql);

				if ($result->num_rows > 0) {
				    while($row = $result->fetch_assoc()) {
				        $products[$i] = $row;
				        $i++;
				    }
				    echo $_GET['callback']."(".json_encode(array('code'=>22,'msg'=>'orders found','order'=>$products)).");";
				}else{
				    echo $_GET['callback']."(".json_encode(array('code'=>20,"msg"=>"Ordesr not found for that customer")).");";
				}
		   }else{
		   	echo $_GET['callback']."(".json_encode(array('status' =>'fail','code'=>'12', 'msg'=>'you are missing some required fields')).");";
		  }
		}


		public function countOrders($data){
		  if(isset($data['customerId'])){ 
			$products =array(); $i=0;
			$sql =  "SELECT count(id) FROM `order` WHERE customer_id=".$data['customerId'];
				$result = $this->conn->query($sql);
				if ($result->num_rows > 0) {
				    while($row = $result->fetch_assoc()) {
				        $products[$i] = $row;
				        $i++;
				    }
				    echo $_GET['callback']."(".json_encode(array('code'=>22,'msg'=>'orders found','order'=>$products)).");";
				}else{
				    echo $_GET['callback']."(".json_encode(array('code'=>20,"msg"=>"Ordesr not found for that customer")).");";
				}
		   }else{
		   	echo $_GET['callback']."(".json_encode(array('status' =>'fail','code'=>'12', 'msg'=>'you are missing some required fields')).");";
		  }
		}
	}
?>