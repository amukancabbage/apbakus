<?php
include_once("../../0model/model_basic.php");
class Kategori extends Model_Basic {
  public  $nama_tabel="kategori";
  public $kategori_instrumen;
  public $deskripsi;
  public $id_tipe;
  private  $basic_query="SELECT * FROM kategori";
  public function __construct($db){
    $this->conn = $db;
  }

  function read(){
    $query = "SELECT * FROM " . $this->nama_tabel . " ORDER BY id ASC";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt;
  }

  function delete(){
    $query = "DELETE FROM " . $this->nama_tabel . " WHERE id = ?";
    $stmt = $this->conn->prepare($query);
    $this->id=htmlspecialchars(strip_tags($this->id));
    $stmt->bindParam(1, $this->id);
    if($stmt->execute()){
      return true;
    }
    return false;

  }
  function search($keywords){
    $query = $this->basic_query."  WHERE  butir LIKE ?  ORDER BY  butir";
    $stmt = $this->conn->prepare($query);

    $keywords=htmlspecialchars(strip_tags($keywords));
    $keywords = "%{$keywords}%";

    $stmt->bindParam(1, $keywords);
    $stmt->execute();

    return $stmt;
  }

  public function count(){
    $query = "SELECT COUNT(id) as total_rows FROM " . $this->nama_tabel . "";

    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    return $row['total_rows'];
  }

  function create(){
    $query = "INSERT INTO
    " . $this->nama_tabel . "
    SET
    status =:status, kategori_instrumen=:kategori_instrumen, deskripsi=:deskripsi, id_tipe=:id_tipe";
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

  function update(){
    $query = "UPDATE " . $this->nama_tabel . "
    SET
    status = :status, kategori_instrumen=:kategori_instrumen, deskripsi=:deskripsi, id_tipe=:id_tipe
    WHERE
    id = :id";
    $stmt = $this->conn->prepare($query);

    $this->status=htmlspecialchars(strip_tags($this->status));
    $this->kategori_instrumen=htmlspecialchars(strip_tags($this->kategori_instrumen));
    $this->deskripsi=htmlspecialchars(strip_tags($this->deskripsi));
    $this->id_tipe=htmlspecialchars(strip_tags($this->id_tipe));
    $this->id=htmlspecialchars(strip_tags($this->id));

    $stmt->bindParam(':status', $this->status);
    $stmt->bindParam(":kategori_instrumen", $this->kategori_instrumen);
    $stmt->bindParam(":deskripsi", $this->deskripsi);
    $stmt->bindParam(":id_tipe", $this->id_tipe);
    $stmt->bindParam(':id', $this->id);

    if($stmt->execute()){
      return true;
    }

    return false;
  }

  function readOne(){
    $query = $this->basic_query."  WHERE id = ?  LIMIT 0,1";
    $stmt = $this->conn->prepare( $query );
    $stmt->bindParam(1, $this->id);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $this->id = $row['id'];
    $this->kategori_instrumen = $row['kategori_instrumen'];
    $this->deskripsi = $row['deskripsi'];
    $this->id_tipe = $row['id_tipe'];

  }

  function readByTipe(){
    $query = "SELECT * FROM " . $this->nama_tabel . " WHERE id_tipe = ? ORDER BY id ASC";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->id_tipe);
    $stmt->execute();
    return $stmt;
  }


}
?>
