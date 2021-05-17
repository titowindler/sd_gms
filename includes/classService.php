<?php   
    class ClassService{
        public $conn;

        public function __construct(){
            $this->conn = mysqli_connect('localhost','root','','stamina');

            if(!$this->conn){
                echo "Failed to connect DB: ".mysqli_error($this->conn);
            }
        }

        public function addService($title, $type, $max, $price, $month, $year, $description, $schedule, $date_start){
    
            $stm = "INSERT INTO `class_service`(`id`, `title`, `type`, `duration_month`, `duration_year`, `schedule_class`, `trainer_id`, `description`, `price`, `max_cap`, `num_ordered`, `date_created`, `status`) VALUES (null,'".$title."','".$type."','".$month."','".$year."','".$schedule."',null,'".$description."','".$price."','".$max."',0,'".$date_start."','active')";
    
            $result = mysqli_query($this->conn, $stm);
            return $result;
        }

        public function editService($title, $type, $max, $price, $month, $year, $description, $schedule, $date_start, $id){
            $stm = "UPDATE `class_service` SET `title`='".$title."',`type`='".$type."',`duration_month`='".$month."',`duration_year`='".$year."',`schedule_class`='".$schedule."',`description`='".$description."',`price`='".$price."',`max_cap`='".$max."',`date_created`='".$date_start."' WHERE id='".$id."'";
    
            $result = mysqli_query($this->conn, $stm);
            return $result;
        }

        public function deleteService($id){
            $stm = "UPDATE `class_service` SET status='deleted' WHERE id='".$id."'";
    
            $result = mysqli_query($this->conn, $stm);
            return $result;
        }
    }
?>