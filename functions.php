<?php  
require_once('config/connection.php');
date_default_timezone_set("Asia/Jakarta"); 
session_start();  
    class functions {  

        private $db;
            
        function __construct() {  
              
            // connecting to database  
            $this->db = new connection();
               
        }
        
        public function UserRegister($username, $emailid, $password){  
                $password = md5($password);  
                $qr = mysqli_query("INSERT INTO users(username, password) values('".$username."','".$password."')") or die(mysql_error());  
                return $qr;  
               
        }  
        public function Login($username, $password){  
            $res = mysqli_query($this->db->conn ,"SELECT * FROM users WHERE username = '".$username."' AND password = '".md5($password)."'");  
            $user_data = mysqli_fetch_array($res);  
            

            $no_rows = mysqli_num_rows($res);  
              
            if ($no_rows == 1) {  
           
                $_SESSION['login'] = true;  
                $_SESSION['id'] = $user_data['id'];  
                $_SESSION['username'] = $user_data['username'];   
                return TRUE;  
            }  
            else {  
                return FALSE;  
            }  
        }  
        public function isUserExist($username){  
            $query = mysqli_query("SELECT * FROM users WHERE username = '".$username."'");  
            echo $row = mysqli_num_rows($query);  
            if($row > 0){  
                return true;  
            } else {  
                return false;  
            }  
        }
        
        public function getDataParkir()
        {
            $rows['data'] = mysqli_query($this->db->conn ,"SELECT * FROM transportations");
            $count_parkir = mysqli_query($this->db->conn ,"SELECT COUNT(*) FROM transportations WHERE updated_at IS NULL");
            $rows['count_parkir'] = mysqli_fetch_assoc($count_parkir);

            return $rows;

        }

        public function addEditDataParkir($data)
        {
            $id = $_GET['id'];
            $user_id = $data['user_id'];
            $name = $data['name'];
            $vehicle_number = $data['vehicle_number'];
            $code = 'CODE' . random_int(100, 999);
            $type = $data['type'];
            $created_at = $data['created_at'];

            if (isset($_GET['id'])) {
                $query = "UPDATE transportations SET
                    user_id = '$user_id',
                    vehicle_number = '$vehicle_number',
                    name = '$name',
                    type = '$type',
                    created_at = '$created_at'
                    WHERE id ='$id' 
                ";
            } else {
                $query = "INSERT INTO transportations(user_id,code,name,vehicle_number,type,created_at) VALUES
                ('$user_id','$code' ,'$name', '$vehicle_number','$type', '$created_at')";
            }

            $data_parkir = mysqli_query($this->db->conn, $query) or die(mysqli_error($this->db->conn));

            return $data_parkir;
        }

        public function detailParkir($id)
        {
            $rows = mysqli_query($this->db->conn ,"SELECT * FROM transportations WHERE id=$id");
            
            return $rows;
        }

        public function deleteDataParkir($id)
        {
            $data = mysqli_query($this->db->conn ,"DELETE FROM transportations WHERE id=$id");

            return $data;
        }

        public function updateTime($data)
        {
            $code = $data['code'];
            $data = mysqli_query($this->db->conn ,"UPDATE transportations SET updated_at=now() WHERE code='$code'") or die(mysqli_error($this->db->conn));

            return $data;
        }

        public function transaction($code)
        {
            $rows = mysqli_query($this->db->conn ,"SELECT * FROM transportations WHERE code='$code'");
            
            return $rows;
        }
    }  
?>  