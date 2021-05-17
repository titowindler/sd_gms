<?php
    class Member{
        public $conn;

        public function __construct(){
            $this->conn = mysqli_connect('localhost','root','','stamina');

            if(!$this->conn){
                echo "Error in connecting DB: ".mysqli_error($this->conn);
            }
        }

        public function loginMember($email, $password){
            $stm = "SELECT * FROM `member` WHERE email='".$email."' AND password='".$password."' AND status='active'";

            $result = mysqli_query($this->conn, $stm);

            if($result){
                if($row = mysqli_fetch_assoc($result)){
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['password'] = $row['password'];
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['fname'] = $row['fname'];
                    $_SESSION['type'] = $row['type'];
                }
            }

            return $result;
        }

        public function createMember($fname, $lname, $contact, $email, $gender, $birthdate, $password){
            $stm = "INSERT INTO `member`(`id`, `fname`, `lname`, `birthdate`, `contact_num`, `email`, `gender`, `password`, `status`, `type`) VALUES (null,'".$fname."','".$lname."','".$birthdate."','".$contact."','".$email."','".$gender."','".$password."','active','regular')";

            $result = mysqli_query($this->conn,$stm);
            if($result){
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;

                $query_id = "SELECT * FROM `member` WHERE email='".$email."' AND password='".$password."'";
                if($res = mysqli_query($this->conn,$query_id)){
                    if($row = mysqli_fetch_assoc($res)){
                        $_SESSION['id'] = $row['id'];
                        $_SESSION['fname'] = $row['fname'];
                    }
                }
            }
            return $result;
        }

        public function displayMember(){
            if(isset($_SESSION['id'])){
                $stm = "SELECT * FROM `member` WHERE id='".$_SESSION['id']."'";

                $result = mysqli_query($this->conn, $stm);
                return $result;
            }
        }

        public function updateMember($id, $fname, $lname, $contact, $email, $gender, $birthdate, $password){
            $stm = "UPDATE `member` SET `fname`='".$fname."',`lname`='".$lname."',`birthdate`='".$birthdate."',`contact_num`='".$contact."',`email`='".$email."',`gender`='".$gender."',`password`='".$password."' WHERE id='".$id."'";

            $result = mysqli_query($this->conn, $stm);

            if($result){
                $query_session = "SELECT * FROM `member` WHERE email='".$email."' AND password='".$password."' AND status='active'";

                $query = mysqli_query($this->conn, $query_session);
                if($query){
                    if($row = mysqli_fetch_assoc($query)){
                        $_SESSION['id'] = $row['id'];
                        $_SESSION['name'] = $row['fname'];
                        $_SESSION['email'] = $row['email'];
                        $_SESSION['password'] = $row['password'];
                    }
                }
            }

            return $result;
        }

        public function deleteMember($id){
            if(isset($_SESSION['email'])){
                session_unset();
                session_destroy();
                $stm = "UPDATE `member` SET `status`='deleted' WHERE id='".$id."'";
                $result = mysqli_query($this->conn, $stm);
            }
            return $result;
        }
    }
?>
