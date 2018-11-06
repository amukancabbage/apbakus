<?php
class Kategori{

  private $conn;
  private $table_name = "kategori";

  public $id;
  public $created_at;
  public $updated_at;
  public $status;
  public $kategori_instrumen;
  public $deskripsi;

  public function __construct($db){
    $this->conn = $db;
  }

  function read(){

    $query = "SELECT * FROM " . $this->table_name . " ORDER BY id ASC";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    return $stmt;
  }

  function create(){
    $query = "INSERT INTO
    " . $this->table_name . "
    SET
    kategori_instrumen=:kategori_instrumen, deskripsi=:deskripsi";
    $stmt = $this->conn->prepare($query);

    $this->kategori_instrumen=htmlspecialchars(strip_tags($this->kategori_instrumen));
    $this->deskripsi=htmlspecialchars(strip_tags($this->deskripsi));

    $stmt->bindParam(":kategori_instrumen", $this->kategori_instrumen);
    $stmt->bindParam(":deskripsi", $this->deskripsi);

    if($stmt->execute()){
      return true;
    }

    return false;

  }

  function readOne(){
    $query = "SELECT * FROM " . $this->table_name . "
    WHERE  id = ? LIMIT 0,1";

    $stmt = $this->conn->prepare( $query );
    $stmt->bindParam(1, $this->id);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $this->id = $row['id'];
    $this->kategori_instrumen = $row['kategori_instrumen'];
    $this->deskripsi = $row['deskripsi'];
  }

  function update(){
    $query = "UPDATE " . $this->table_name . "
    SET
    kategori_instrumen = :kategori_instrumen,
    deskripsi = :deskripsi
    WHERE
    id = :id";
    $stmt = $this->conn->prepare($query);

    $this->kategori_instrumen=htmlspecialchars(strip_tags($this->kategori_instrumen));
    $this->deskripsi=htmlspecialchars(strip_tags($this->deskripsi));
    $this->id=htmlspecialchars(strip_tags($this->id));

    $stmt->bindParam(':kategori_instrumen', $this->kategori_instrumen);
    $stmt->bindParam(':deskripsi', $this->deskripsi);
    $stmt->bindParam(':id', $this->id);

    if($stmt->execute()){
      return true;
    }

    return false;
  }
}
