<?php
include("../../0model/model_basic.php");
class Instrumen extends Model_Basic {
  public  $nama_tabel="instrumen";
  public $butir;
  public $gambar;
  public $keterangan;
  public $id_kategori;
  private  $basic_query="SELECT * FROM instrumen";
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
    status =:status, butir=:butir, gambar=:gambar, keterangan=:keterangan, id_kategori=:id_kategori";
    $stmt = $this->conn->prepare($query);

    $this->status=htmlspecialchars(strip_tags($this->status));
    $this->butir=htmlspecialchars(strip_tags($this->butir));
    $this->gambar=htmlspecialchars(strip_tags($this->gambar));
    $this->keterangan=htmlspecialchars(strip_tags($this->keterangan));
    $this->id_kategori=htmlspecialchars(strip_tags($this->id_kategori));


    $stmt->bindParam(":status", $this->status);
    $stmt->bindParam(":butir", $this->butir);
    $stmt->bindParam(":gambar", $this->gambar);
    $stmt->bindParam(":keterangan", $this->keterangan);
    $stmt->bindParam(":id_kategori", $this->id_kategori);

    if($stmt->execute()){
      return true;
    }

    return false;

  }

  function update(){
    $query = "UPDATE " . $this->nama_tabel . "
    SET
    status = :status, butir=:butir, gambar=:gambar, keterangan=:keterangan, id_kategori=:id_kategori
    WHERE
    id = :id";
    $stmt = $this->conn->prepare($query);

    $this->status=htmlspecialchars(strip_tags($this->status));
    $this->butir=htmlspecialchars(strip_tags($this->butir));
    $this->gambar=htmlspecialchars(strip_tags($this->gambar));
    $this->keterangan=htmlspecialchars(strip_tags($this->keterangan));
    $this->id_kategori=htmlspecialchars(strip_tags($this->id_kategori));
    $this->id=htmlspecialchars(strip_tags($this->id));

    $stmt->bindParam(':status', $this->status);
    $stmt->bindParam(":butir", $this->butir);
    $stmt->bindParam(":gambar", $this->gambar);
    $stmt->bindParam(":keterangan", $this->keterangan);
    $stmt->bindParam(":id_kategori", $this->id_kategori);
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
    $this->butir = $row['butir'];
    $this->gambar = $row['gambar'];
    $this->keterangan = $row['keterangan'];
    $this->id_kategori = $row['id_kategori'];

  }


}
?>
