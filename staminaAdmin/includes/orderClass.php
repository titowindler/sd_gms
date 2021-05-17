<?php 
    class OrderClass{
        public $conn;

        public function __construct(){
            $this->conn = mysqli_connect('localhost','root','','stamina');

            if(!$this->conn){
                echo "Failed to connect to DB!".mysqli_error($this->conn);
            }
        }

        public function paidOrder($id){
            $stm = "UPDATE `order_class` SET `isPaid`='paid' WHERE id='".$id."'";
            $result = mysqli_query($this->conn, $stm);
            $data = $this->getOrder($id);

            if(!$this->updateEnrollee($data['class_id'])){
                echo "Enrolle not updated!";
            }
            
            return $result;
        }

        public function getClass($id){
            $stm = "SELECT * FROM class_service WHERE id='".$id."'";

            $result = mysqli_query($this->conn, $stm);
            $row = mysqli_fetch_assoc($result);

            return $row;
        }

        public function getMember($id){
            $stm = "SELECT * FROM member WHERE id='".$id."'";

            $result = mysqli_query($this->conn, $stm);
            $row = mysqli_fetch_assoc($result);
            return $row;
        }

        public function getCountOrder(){
            $stm = "SELECT COUNT(*) as count FROM order_class WHERE isPaid='not'";
            if($res = mysqli_query($this->conn, $stm)){
                $data = mysqli_fetch_assoc($res);
            }else{
                $data['count'] = 0;
            }

            return $data['count'];
        }

        public function getOrderAll(){
            $stm = "SELECT COUNT(*) as count FROM order_class";
            if($res = mysqli_query($this->conn, $stm)){
                $data = mysqli_fetch_assoc($res);
            }else{
                $data['count'] = 0;
            }

            return $data['count'];
        }

        public function getProfitAll(){
            $stm = "SELECT * FROM order_class WHERE isPaid='paid'";
            $res = mysqli_query($this->conn, $stm);
            $total = 0;

            while($row = mysqli_fetch_assoc($res)){
                $total = $total + floatval($row['total_price']);
            }

            return $total;
        }

        public function updateEnrollee($id, $num){
            $num = (int)$num + 1;
            $stm = "UPDATE `class_service` SET `num_ordered`='.$num.' WHERE id='".$id."'";
            $res = mysqli_query($this->conn, $stm);

            return $res;
        }

        public function getOrder($id){
            $stm = "SELECT * FROM order_class WHERE id='".$id."'";
            $res = mysqli_query($this->conn, $stm);
            $data = mysqli_fetch_assoc($res);

            return $data;
        }
    }
?>