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
  public $id_tipe;
  public $nama_tipe;
  public $basic_query = "SELECT
             t.tipe as nama_tipe, k.*
         FROM
             kategori  k
             LEFT JOIN
                 tipe t
                     ON k.id_tipe = t.id";

  public function __construct($db){
    $this->conn = $db;
  }

  function read(){

    $query = $this->basic_query." ORDER BY k.id";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    return $stmt;
  }

  function create(){
    $query = "INSERT INTO
    " . $this->table_name . "
    SET
    status = :status, kategori_instrumen=:kategori_instrumen, deskripsi=:deskripsi, id_tipe=:id_tipe";
    $stmt = $this->conn->prepare($query);

    $this->status=htmlspecialchars(strip_tags($this->status));
    $this->kategori_instrumen=htmlspecialchars(strip_tags($this->kategori_instrumen));
    $this->deskripsi=htmlspecialchars(strip_tags($this->deskripsi));
    $this->id_tipe=htmlspecialchars(strip_tags($this->id_tipe));

    $stmt->bindParam(":status", $this->status);
    $stmt->bindParam(":kategori_instrumen", $this->kategori_instrumen);
    $stmt->bindParam(":deskripsi", $this->deskripsi);
    $stmt->bindParam(":id_tipe", $this->id_tipe);

    if($stmt->execute()){
      return true;
    }

    return false;

  }

  function readOne(){
    $query = $this->basic_query."  WHERE  k.id = ?  LIMIT 0,1";
    $stmt = $this->conn->prepare( $query );
    $stmt->bindParam(1, $this->id);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $this->id = $row['id'];
    $this->kategori_instrumen = $row['kategori_instrumen'];
    $this->deskripsi = $row['deskripsi'];
    $this->id_tipe = $row['id_tipe'];
    $this->nama_tipe = $row['nama_tipe'];
  }

  function update(){
    $query = "UPDATE " . $this->table_name . "
    SET
    status = :status,
    kategori_instrumen = :kategori_instrumen,
    id_tipe = :id_tipe,
    deskripsi = :deskripsi
    WHERE
    id = :id";
    $stmt = $this->conn->prepare($query);

    $this->status=htmlspecialchars(strip_tags($this->status));
    $this->id_tipe=htmlspecialchars(strip_tags($this->id_tipe));
    $this->kategori_instrumen=htmlspecialchars(strip_tags($this->kategori_instrumen));
    $this->deskripsi=htmlspecialchars(strip_tags($this->deskripsi));
    $this->id=htmlspecialchars(strip_tags($this->id));

    $stmt->bindParam(':status', $this->status);
    $stmt->bindParam(':kategori_instrumen', $this->kategori_instrumen);
    $stmt->bindParam(':id_tipe', $this->id_tipe);
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

  $query = $basic_query."  WHERE  kategori_instrumen LIKE ?  ORDER BY  kategori_instrumen";
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
}
?>
