<?php
class Kategori{

  private $conn;
  private $table_name = "instrumen";

  public $id;
  public $created_at;
  public $updated_at;
  public $status;
  public $butir;
  public $deskripsi;
  public $gambar;
  public $id_kategori_instrumen;
  public $kategori_instrumen;
  public $basic_query = "SELECT
             k.kategori_instrumen as kategori_instrumen, i.*
         FROM
             instrumen  i
             LEFT JOIN
                 kategori k
                     ON i.id_kategori_instrumen = k.id";

  public function __construct($db){
    $this->conn = $db;
  }

  function read(){

    $query = $this->basic_query." ORDER BY i.id";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    return $stmt;
  }

  function create(){
    $query = "INSERT INTO
    " . $this->table_name . "
    SET
    status = :status, butir=:butir, deskripsi=:deskripsi,gambar=:gambar, id_kategori_instrumen=:id_kategori_instrumen";
    $stmt = $this->conn->prepare($query);

    $this->status=htmlspecialchars(strip_tags($this->status));
    $this->butir=htmlspecialchars(strip_tags($this->butir));
    $this->deskripsi=htmlspecialchars(strip_tags($this->deskripsi));
    $this->gambar=htmlspecialchars(strip_tags($this->gambar));
    $this->id_kategori_instrumen=htmlspecialchars(strip_tags($this->id_kategori_instrumen));

    $stmt->bindParam(":status", $this->status);
    $stmt->bindParam(":butir", $this->butir);
    $stmt->bindParam(":deskripsi", $this->deskripsi);
    $stmt->bindParam(":gambar", $this->gambar);
    $stmt->bindParam(":id_kategori_instrumen", $this->id_kategori_instrumen);

    if($stmt->execute()){
      return true;
    }

    return false;

  }

  function readOne(){
    $query = $this->basic_query."  WHERE  i.id = ?  LIMIT 0,1";
    $stmt = $this->conn->prepare( $query );
    $stmt->bindParam(1, $this->id);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $this->id = $row['id'];
    $this->butir = $row['butir'];
    $this->deskripsi = $row['deskripsi'];
    $this->gambar = $row['gambar'];
    $this->id_kategori_instrumen = $row['id_kategori_instrumen'];
    $this->kategori_instrumen = $row['kategori_instrumen'];
  }

  function update(){
    $query = "UPDATE " . $this->table_name . "
    SET
    status = :status,
    butir = :butir,
    deskripsi = :deskripsi,
    gambar = :gambar,
    id_kategori_instrumen = :id_kategori_instrumen
    WHERE
    id = :id";
    $stmt = $this->conn->prepare($query);

    $this->status=htmlspecialchars(strip_tags($this->status));
    $this->id_kategori_instrumen=htmlspecialchars(strip_tags($this->id_kategori_instrumen));
    $this->butir=htmlspecialchars(strip_tags($this->butir));
    $this->deskripsi=htmlspecialchars(strip_tags($this->deskripsi));
    $this->gambar=htmlspecialchars(strip_tags($this->gambar));
    $this->id=htmlspecialchars(strip_tags($this->id));

    $stmt->bindParam(':status', $this->status);
    $stmt->bindParam(':butir', $this->butir);
    $stmt->bindParam(':id_kategori_instrumen', $this->id_kategori_instrumen);
    $stmt->bindParam(':deskripsi', $this->deskripsi);
    $stmt->bindParam(':gambar', $this->gambar);
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

  $query = $basic_query."  WHERE  butir LIKE ?  ORDER BY  butir";
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
