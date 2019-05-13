<?php
class Database{

  private $host = "localhost";
  private $db_name = "api_db";
  private $username = "root";
  private $password = "";
  public $conn;

  function __construct() {
    $ippengguna=$_SERVER['REMOTE_ADDR'];
    // if($ippengguna=="::1") {
    $this->host     ='localhost';
    $this->username = 'root';
    $this->password = '';
    $this->db_name    = 'db_abk';
    // }else{
    //   $this->host     ='mysql.hostinger.co.id';
    //   $this->username = 'u713260332_yogy';
    //   $this->password = 'kurniawan86';
    //   $this->db_name    = 'u713260332_abk';
    // }
  }




  // get the database connection
  public function getConnection(){

    $this->conn = null;

    try{
      $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
      $this->conn->exec("set names utf8");
    }catch(PDOException $exception){
      echo "Connection error: " . $exception->getMessage();
    }

    return $this->conn;
  }
}
?>
