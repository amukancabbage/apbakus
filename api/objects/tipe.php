<?php
class Tipe{

  private $conn;
  private $table_name = "tipe";

  public $id;
  public $created_at;
  public $updated_at;
  public $status;
  public $tipe;
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
    status = :status, tipe=:tipe, deskripsi=:deskripsi";
    $stmt = $this->conn->prepare($query);

    $this->status=htmlspecialchars(strip_tags($this->status));
    $this->tipe=htmlspecialchars(strip_tags($this->tipe));
    $this->deskripsi=htmlspecialchars(strip_tags($this->deskripsi));

    $stmt->bindParam(":status", $this->status);
    $stmt->bindParam(":tipe", $this->tipe);
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
    $this->tipe = $row['tipe'];
    $this->deskripsi = $row['deskripsi'];
  }

  function update(){
    $query = "UPDATE " . $this->table_name . "
    SET
    status = :status,
    tipe = :tipe,
    deskripsi = :deskripsi
    WHERE
    id = :id";
    $stmt = $this->conn->prepare($query);

    $this->status=htmlspecialchars(strip_tags($this->status));
    $this->tipe=htmlspecialchars(strip_tags($this->tipe));
    $this->deskripsi=htmlspecialchars(strip_tags($this->deskripsi));
    $this->id=htmlspecialchars(strip_tags($this->id));

    $stmt->bindParam(':status', $this->status);
    $stmt->bindParam(':tipe', $this->tipe);
    $stmt->bindParam(':deskripsi', $this->deskripsi);
    $stmt->bindParam(':id', $this->id);

    if($stmt->execute()){
      return true;
    }

    return false;
  }

  function delete(){
    $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
    $stmt = $this->conn->prepare($query);
    $this->id=htmlspecialchars(strip_tags($this->id));
    $stmt->bindParam(1, $this->id);
    if($stmt->execute()){
      return true;
    }
    return false;

  }
  function search($keywords){

    // select all query
    $query = "SELECT
    *
    FROM
    " . $this->table_name . "
    WHERE
    tipe LIKE ? OR tipe LIKE ?
    ORDER BY
    tipe";

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    $keywords=htmlspecialchars(strip_tags($keywords));
    $keywords = "%{$keywords}%";

    $stmt->bindParam(1, $keywords);
    $stmt->execute();

    return $stmt;
  }
  public function count(){
    $query = "SELECT COUNT(id) as total_rows FROM " . $this->table_name . "";

    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    return $row['total_rows'];
  }
  public function readPaging($from_record_num, $records_per_page){

    // select query
    $query = "SELECT
    *
    FROM
    " . $this->table_name . "
    ORDER BY id
    LIMIT ?, ?";

    // prepare query statement
    $stmt = $this->conn->prepare( $query );

    // bind variable values
    $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
    $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);

    // execute query
    $stmt->execute();

    // return values from database
    return $stmt;
  }
}
