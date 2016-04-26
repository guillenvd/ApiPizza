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
				    echo $_GET['callback']."(".json_encode(array('code'=>19,'products'=>$products,'size'=>$sizes)).");";
				}else{
				    echo $_GET['callback']."(".json_encode(array('code'=>20,"msg"=>"something Goes bad or no exist that category")).");";
				}
		   }else{
		   	echo $_GET['callback']."(".json_encode(array('status' =>'fail','code'=>'12', 'msg'=>'you are missing some required fields')).");";
			}
		}
	}
	//VorLVCzv7R
	//4t1gcDRXkR
	//u851374438_api
	//u851374438_user
	//4VuCEVmPzX
?>