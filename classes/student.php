<?php


class student
{
    public $id;
    public $name;
    public $email;
    public $mobile;

    private $conn;
    private $table_name;

    public function __construct($db)
    {
        $this->conn = $db;
        $this->table_name = "students";
    }

    public function createData(){
        $query = "INSERT INTO ".$this->table_name."
        SET name = ?, email = ?, mobile = ?";
        $obj = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->mobile = htmlspecialchars(strip_tags($this->mobile));

        $obj->bind_param("sss", $this->name, $this->email, $this->mobile);
        if($obj->execute()){
            return true;
        }
        return false;
    }

    public function getAllData()
    {
        $query = "SELECT * from ".$this->table_name;
        $obj = $this->conn->prepare($query);

        $obj->execute();
        return $obj->get_result();
    }

    public function getSingle(){
        $query = "SELECT * from ".$this->table_name." WHERE id = ?";
        $obj = $this->conn->prepare($query);

        $obj->bind_param("i", $this->id);
        $obj->execute();
        $data = $obj->get_result();
        return $data->fetch_assoc();
    }

    public function updateStudent(){
        $query = "UPDATE students SET name = ?, email = ?, mobile = ? WHERE id = ?";
        $obj = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->mobile = htmlspecialchars(strip_tags($this->mobile));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $obj->bind_param("sssi", $this->name, $this->email, $this->mobile, $this->id);
        if($obj->execute()){
            return true;
        }
        return false;

    }

    public function deleteStudent(){
        $query = "DELETE from ".$this->table_name." WHERE id = ?";
        $obj = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));

        $obj->bind_param("i", $this->id);
        if($obj->execute()){
            return true;
        }
        return false;
    }

}