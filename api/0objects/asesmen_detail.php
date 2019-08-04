<?php
include_once("../../0model/model_basic.php");
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

  function readByAsesmen(){
    $query = "SELECT asesmen_detail.*, instrumen.butir FROM asesmen_detail INNER JOIN instrumen ON asesmen_detail.id_instrumen = instrumen.id WHERE id_asesmen=?";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->id_asesmen);
    $stmt->execute();
    return $stmt;
  }

  function readByAsesmenKategori($id_kategori){
    $query = "SELECT instrumen.id_kategori_instrumen,kategori.kategori_instrumen, asesmen_detail.id_instrumen, instrumen.butir, asesmen_detail.id_asesmen,
              asesmen_detail.id, asesmen_detail.hasil
              from asesmen_detail
              LEFT JOIN instrumen ON asesmen_detail.id_instrumen = instrumen.id
              LEFT JOIN kategori ON instrumen.id_kategori_instrumen = kategori.id
              WHERE asesmen_detail.id_asesmen=? AND id_kategori_instrumen = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->id_asesmen);
    $stmt->bindParam(2, $id_kategori);
    $stmt->execute();
    return $stmt;
  }

  function checked(){
    $query = "UPDATE " . $this->nama_tabel . "
    SET hasil=:hasil
    WHERE
    id = :id";
    $stmt = $this->conn->prepare($query);

    $this->hasil=htmlspecialchars(strip_tags($this->hasil));
    $this->id=htmlspecialchars(strip_tags($this->id));

    $stmt->bindParam(":hasil", $this->hasil);
    $stmt->bindParam(':id', $this->id);

    if($stmt->execute()){
      return true;
    }

    return false;
  }

function readSummary(){
  $query = "select kategori.kategori_instrumen,
              count(if(asesmen_detail.hasil='MAMPU',asesmen_detail.hasil,NULL)) AS jumlah_mampu,
              count(if(asesmen_detail.hasil='TIDAK',asesmen_detail.hasil,NULL)) AS jumlah_tidak,
              count(*) AS jumlah,
              concat(count(if(asesmen_detail.hasil='MAMPU',asesmen_detail.hasil,NULL)),'/',count(*)) AS per,
              round((count(if(asesmen_detail.hasil='MAMPU',asesmen_detail.hasil,NULL))/count(*))*100,2) AS persen

              FROM asesmen_detail
              LEFT JOIN instrumen ON asesmen_detail.id_instrumen = instrumen.id
              LEFT JOIN kategori ON instrumen.id_kategori_instrumen = kategori.id
              WHERE asesmen_detail.id_asesmen = ?
              GROUP BY kategori_instrumen";
  $stmt = $this->conn->prepare($query);
  $stmt->bindParam(1, $this->id_asesmen);
  $stmt->execute();
  return $stmt;
}


}
?>
