<?php 
require_once '../src/lib/connection.php';

	class Products extends Connection
	{
		
		public function getProducts($data){
		  if(isset($data['category'])){ 
			$products =array();$sizes =array(); $i=0;
			$sql =  "SELECT a.price as price, b.description as description, d.model_desc as models FROM product a , product_type b, models d WHERE b.category_id = ".(int)$data['category']." and a.type_id = b.id and d.id = a.model_id";
				$result = $this->conn->query($sql);

			 $sqlSizes =  "SELECT DISTINCT(d.model_desc) FROM product a , product_type b, models d WHERE b.category_id = 1 and a.type_id = b.id and d.id = a.model_id";
				$result = $this->conn->query($sql);
				$result2 = $this->conn->query($sqlSizes);

				if ($result->num_rows > 0) {
				    while($row = $result->fetch_assoc()) {
				        $products[$i] = $row;
				        $i++;
				    }$i=0;
				    while($row = $result2->fetch_assoc()) {
				        $sizes[$i] = $row;
				        $i++;
				    }
				    echo $_GET['callback']."(".json_encode(array('code'=>'19','products'=>$products,'size'=>$sizes)).");";
				}else{
				    echo $_GET['callback']."(".json_encode(array('code'=>'20',"msg"=>"something Goes bad or no exist that category")).");";
				}
		   }else{
		   	echo $_GET['callback']."(".json_encode(array('status' =>'fail','code'=>'12', 'msg'=>'you are missing some required fields')).");";
			}
		}

		public function orderCustomer($data){
			var_dump($data);
			if(isset($data['order_date'])&&isset($data['customer_id'])&&isset($data['total_price'])&&isset($data['order_distance'])&&isset($data['product_id'])&&isset($data['quantity'])){
				$sql = "INSERT INTO `order` (`id`, `order_date`, `customer_id`, `total_price`, `order_distance`, `statusTable`) VALUES (NULL, '".$data['order_date']."', '".$data['customer_id']."','".$data['total_price']."', '".$data['order_distance']."', 'in order')";
				

				if ($this->conn->query($sql) === TRUE) {
					$sql2 = "INSERT INTO `pizz`.`item_order` (`order_id`, `product_id`, `quantity`, `description`) VALUES ('".$this->conn->insert_id."','".$data['product_id']."', '".$data['quantity']."', '".$data['description']."');";

						if ($this->conn->query($sql2) === TRUE) {
						   echo $_GET['callback']."(".json_encode(array('status' =>'done','code'=>'21', 'msg'=>'Order Created successfully')).");";
						} else {
						    if($this->env == "dev")
						    	echo "Error: " . $sql . "<br>" . $this->conn->error;
						    echo $_GET['callback']."(".json_encode(array('status' =>'fail','code'=>'20','msg'=>'Something going bad with the database')).");";}


				} else {
				    if($this->env == "dev")
				    	echo "Error: " . $sql . "<br>" . $this->conn->error;
				    echo $_GET['callback']."(".json_encode(array('status' =>'fail','code'=>'20','msg'=>'Something going bad with the database')).");";}
				    //$conn->insert_id
			}else{
				echo $_GET['callback']."(".json_encode(array('status' =>'fail','code'=>'12', 'msg'=>'you are missing some required fields')).");";
			}

		}
	}
?>