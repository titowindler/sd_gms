<?php
    class Member{
        public $conn;

        public function __construct(){
            $this->conn = mysqli_connect('localhost','root','','stamina');

            if(!$this->conn){
                echo "Fail to connect DB: ".mysqli_error($this->conn);
            }
        }

        public function countMembers(){
            $stm = "SELECT COUNT(*) as count FROM member WHERE status='active'";
            $result = mysqli_query($this->conn, $stm);
            $data = mysqli_fetch_assoc($result);
            return $data['count'];
        }

        public function blockMembers($id){
            $stm = "UPDATE `member` SET `status`='blocked' WHERE id='".$id."'";
            $result = mysqli_query($this->conn,$stm);
            return $result;
        }

        public function unblockMembers($id){
            $stm = "UPDATE `member` SET `status`='active' WHERE id='".$id."'";
            $result = mysqli_query($this->conn,$stm);
            return $result;
        }
    }
?>