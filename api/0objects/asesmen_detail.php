<?php
include("../../0model/model_basic.php");
class Asesmen_detail extends Model_Basic {
  public  $nama_tabel="asesmen_detail";
  public $id_asesmen;
  public $id_instrumen;
  public $hasil;
  public $catatan;
  private  $basic_query="SELECT * FROM asesmen_detail";
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
    status =:status, id_asesmen=:id_asesmen, id_instrumen=:id_instrumen, hasil=:hasil, catatan=:catatan";
    $stmt = $this->conn->prepare($query);

    $this->status=htmlspecialchars(strip_tags($this->status));
    $this->id_asesmen=htmlspecialchars(strip_tags($this->id_asesmen));
    $this->id_instrumen=htmlspecialchars(strip_tags($this->id_instrumen));
    $this->hasil=htmlspecialchars(strip_tags($this->hasil));
    $this->catatan=htmlspecialchars(strip_tags($this->catatan));


    $stmt->bindParam(":status", $this->status);
    $stmt->bindParam(":id_asesmen", $this->id_asesmen);
    $stmt->bindParam(":id_instrumen", $this->id_instrumen);
    $stmt->bindParam(":hasil", $this->hasil);
    $stmt->bindParam(":catatan", $this->catatan);

    if($stmt->execute()){
      return true;
    }

    return false;

  }

  function update(){
    $query = "UPDATE " . $this->nama_tabel . "
    SET
    status = :status, id_asesmen=:id_asesmen, id_instrumen=:id_instrumen, hasil=:hasil, catatan=:catatan
    WHERE
    id = :id";
    $stmt = $this->conn->prepare($query);

    $this->status=htmlspecialchars(strip_tags($this->status));
    $this->id_asesmen=htmlspecialchars(strip_tags($this->id_asesmen));
    $this->id_instrumen=htmlspecialchars(strip_tags($this->id_instrumen));
    $this->hasil=htmlspecialchars(strip_tags($this->hasil));
    $this->catatan=htmlspecialchars(strip_tags($this->catatan));
    $this->id=htmlspecialchars(strip_tags($this->id));

    $stmt->bindParam(':status', $this->status);
    $stmt->bindParam(":id_asesmen", $this->id_asesmen);
    $stmt->bindParam(":id_instrumen", $this->id_instrumen);
    $stmt->bindParam(":hasil", $this->hasil);
    $stmt->bindParam(":catatan", $this->catatan);
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
    $this->id_asesmen = $row['id_asesmen'];
    $this->id_instrumen = $row['id_instrumen'];
    $this->hasil = $row['hasil'];
    $this->catatan = $row['catatan'];

  }


}
?>
