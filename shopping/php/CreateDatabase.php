<?php


class CreateDatabase
{
 public $servername;
 public $username;
 public $password;
    public $databasename;
    public $tablename;
    public $con;

    public function __construct(

        $databasename = "shopdb",
        $tablename = "product",
        $servername = "localhost",
        $username = "root",
        $password = ""

    )
    {
        $this -> databasename = $databasename;
        $this -> tablename = $tablename;
        $this -> username = $username;
        $this -> password = $password;
        $this -> servername = $servername;

        $this -> con = mysqli_connect($servername,$username, $password);

        //Check connection

        if(!$this->con){
            die("Connection failed : " . mysqli_connect_error());

        }

        $sql = "Create Database if not exists $databasename";

        if(mysqli_query($this->con,$sql)){

            $this->con = mysqli_connect($servername,$username,$password, $databasename);

            $sql = " CREATE TABLE IF NOT EXISTS $tablename
                            (id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                             product_name VARCHAR (100) NOT NULL,
                             price FLOAT,
                             image VARCHAR (100)
                            );";


            if(!mysqli_query($this->con,$sql)){
                echo "Error - table wasn't create ". mysqli_error($this->con);
            }
        } else{
            return false;
        }
    }

    // products from database

    public function getProducts(){
        $sql = "SELECT * FROM shopdb.product";
        $result = mysqli_query($this->con, $sql);


        if(mysqli_num_rows($result)>0){
            return $result;
        }

    }
}