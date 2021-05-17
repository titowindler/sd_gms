<?php
    class trainerAdmin{
        public $conn;

        public function __construct(){
            $this->conn = mysqli_connect('localhost','root','','stamina');

            if(!$this->conn){
                echo "Failed to connect DB!".mysqli_error($this->conn);
            }
        }

        public function addTrainer($fname, $lname, $contact_num, $email, $trainer_type, $gender){
            $stm = "INSERT INTO `trainer`(`id`, `fname`, `lname`, `contact_num`, `email`, `trainer_type`, `gender`, `date_employed`) VALUES (null, '".$fname."', '".$lname."', '".$contact_num."', '".$email."', '".$trainer_type."', '".$gender."',NOW())";
    
            $result = mysqli_query($this->conn, $stm);
            return $result;
        }

        public function editTrainer($id, $fname, $lname, $contact_num, $email, $trainer_type, $gender){
            $stm = "UPDATE `trainer` SET `fname`='".$fname."',`lname`='".$lname."',`contact_num`='".$contact_num."',`email`='".$email."',`trainer_type`='".$trainer_type."',`gender`='".$gender."' WHERE id='".$id."'";
    
            $result = mysqli_query($this->conn, $stm);
            return $result;
        }

        public function deleteTrainer($id){
            $stm = "DELETE FROM `trainer` WHERE id='".$id."'";
    
            $result = mysqli_query($this->conn, $stm);
            return $result;
        }

        public function retTrainer(){
            $sql ="SELECT * FROM trainer";
            $itemArray = array();
            $res = mysqli_query($this->conn, $sql);

            while($row = mysqli_fetch_assoc($res)){
                $itemArray[] = $row;
            }
            return $itemArray;
        } 

        public function getCountTrainer(){
            $stm = "SELECT COUNT(*) as count FROM trainer";
            $res = mysqli_query($this->conn, $stm);
            $data = mysqli_fetch_assoc($res);
            return $data['count'];

        }
    }
?>