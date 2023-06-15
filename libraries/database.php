<?php
// connection class
class Connection{
    // using configuration
    private $host=DB_HOST;
    private $user=DB_USER;
    private $pass=DB_PASS;
    private $name=DB_NAME;
    public $conn;
    private $error;
    public function __construct(){
        $this->conn();
        $this->error();
}
    // connect function
    public function conn(){
        $this->conn= new mysqli($this->host,$this->user,$this->pass,$this->name);
    }
    // error function
    public function error(){
        if($this->conn->connect_error){
            $this->error="CONNECTION FAILED".$this->conn->connect_error;
        }
    }
    // crud operations
    public function select($query){
        $result=$this->conn->query($query) or die($this->conn->error);
        if ($result)
            return $result;
    }
    public function insert($query)
    {
        return $this->conn->query($query) or die ($this->conn->error);
    }
    public function update($query){
        return $this->conn->query($query) or die($this->conn->error);
    }
    public function delete($query){
        $delete_row=$this->conn->query($query) or die ($this->conn->error);
        if($delete_row){

        }
        else
            die($this->conn->error);
    }
}