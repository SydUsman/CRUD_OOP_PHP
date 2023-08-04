<?php

include 'connection.php';


class Model{
    private $servername = 'localhost';
    private $username = 'root';
    private $password = '';
    private $dbname = 'ignisit';
    private $conn;

    // Constructor
    function __construct(){
        // $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname); 
        // if($this->conn->connect_error){
        //     echo "Connection Failed";
        // }else{
        //     // echo "Connected";
        //     return $this->conn;
        // }
        $this->conn = getConnection();        
    }

    //Creating a method for inserting a record
    function insertRecord($post){
        $name = $post['name'];
        $email = $post['email'];
        $sql = "INSERT INTO users(name,email)VALUES('$name','$email')";
        $result = $this->conn->query($sql);
        if($result){
            header('location:index.php?msg=ins');
        }else{
            echo "Error";
        }
    }

    // Display the Record
    public function displayRecord(){
        $sql = 'SELECT * from users';
        $result = $this->conn->query($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $data[]=$row;
            }
            return $data;
        }
    }

    // Get record by ID
    public function get_by_id($updateid){
        $sql = "SELECT * from users where id='$updateid'";
        $result = $this->conn->query($sql);
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            return $row;
        }
    }

    //Update Record
    function updateRecord($post){
        $name = $post['name'];
        $email = $post['email'];
        $id = $post['hid'];
        $sql = "UPDATE users SET name='$name', email='$email' WHERE id='$id'";
        $result = $this->conn->query($sql);
        if($result){
            header('location:index.php?msg=ups');
        }else{
            echo "Error";
        }
    }

    //Delete Record
    public function deleteRecord($delid){
        $sql = "DELETE FROM users WHERE id='$delid'";
        $result = $this->conn->query($sql);
        if($result){
            header("location:index.php?msg=del");
        }else{
            echo "Error";
        }
    }
}



?>
