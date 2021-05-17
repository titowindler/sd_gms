<?php
    class OrderClass{
        public $conn;

        public function __construct(){
            $this->conn = mysqli_connect('localhost','root','','stamina');

            if(!$this->conn){
                echo "Failed to connect DB!".mysqli_error($this->conn);
            }
        }

        public function getClassService($id){
            $stm = "SELECT * FROM class_service WHERE id='".$id."'";

            $result = mysqli_query($this->conn, $stm);
            $row = mysqli_fetch_assoc($result);

            return $row;
        }

        public function insertOrder($class_id, $member_id){
            $isExist = $this->isOrdered($class_id, $member_id);

            if($isExist == 0){
                $class = $this->getClassService($class_id);

                $stm = "INSERT INTO `order_class`(`id`, `class_id`, `member_id`, `total_price`, `isPaid`) VALUES (null,'".$class_id."','".$member_id."',".$class['price'].",'not')";

                $result = mysqli_query($this->conn, $stm);
                return $result;
            }
        }

        public function paidOrder($id){
            $stm = "UPDATE `order_class` SET `isPaid`='paid' WHERE id='".$id."'";
            $result = mysqli_query($this->conn, $stm);
            return $result;
        }

        public function deleteOrder($id){
            $stm = "DELETE FROM `order_class` WHERE id='".$id."'";
            $result = mysqli_query($this->conn, $stm);
            return $result;
        }

        public function isOrdered($class_id, $member_id){
            $exist = 0;
            $stm = "SELECT * FROM order_class WHERE class_id='".$class_id."' AND member_id='".$member_id."'";

            if($result = mysqli_query($this->conn, $stm)){
                $rowcount = mysqli_num_rows($result);
                $exist = (($rowcount != 0)?1:0);
            }
            
            return $exist;
        }

        public function getTrainer($id){
            $res = 'null';

            if($id != null){
                $stm = "SELECT * FROM `trainer` WHERE id='".$id."'";
                $result = mysqli_query($this->conn, $stm);
                $res = mysqli_fetch_assoc($result);
            }

            return $res;
        }
    }
?>