<?php
include_once("../../0model/model_basic.php");
class Asesmen extends Model_Basic {
  public  $nama_tabel="asesmen";
  public $id_tipe;
  public $id_anak;
  public $id_user;
  public $tanggal_asesmen;
  public $usia;
  public $hasil_akhir;
  public $catatan_akhir ;
  private  $basic_query="SELECT * FROM asesmen";
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
    status =:status, id_tipe=:id_tipe, id_anak=:id_anak, id_user=:id_user, tanggal_asesmen=:tanggal_asesmen, usia=:usia, hasil_akhir=:hasil_akhir, catatan_akhir =:catatan_akhir ";
    $stmt = $this->conn->prepare($query);

    $this->status=htmlspecialchars(strip_tags($this->status));
    $this->id_tipe=htmlspecialchars(strip_tags($this->id_tipe));
    $this->id_anak=htmlspecialchars(strip_tags($this->id_anak));
    $this->id_user=htmlspecialchars(strip_tags($this->id_user));
    $this->tanggal_asesmen=htmlspecialchars(strip_tags($this->tanggal_asesmen));
    $this->usia=htmlspecialchars(strip_tags($this->usia));
    $this->hasil_akhir=htmlspecialchars(strip_tags($this->hasil_akhir));
    $this->catatan_akhir =htmlspecialchars(strip_tags($this->catatan_akhir ));


    $stmt->bindParam(":status", $this->status);
    $stmt->bindParam(":id_tipe", $this->id_tipe);
    $stmt->bindParam(":id_anak", $this->id_anak);
    $stmt->bindParam(":id_user", $this->id_user);
    $stmt->bindParam(":tanggal_asesmen", $this->tanggal_asesmen);
    $stmt->bindParam(":usia", $this->usia);
    $stmt->bindParam(":hasil_akhir", $this->hasil_akhir);
    $stmt->bindParam(":catatan_akhir ", $this->catatan_akhir );

    if($stmt->execute()){
      return true;
    }

    return false;

  }

  function update(){
    $query = "UPDATE " . $this->nama_tabel . "
    SET
    status = :status, id_tipe=:id_tipe, id_anak=:id_anak, id_user=:id_user, tanggal_asesmen=:tanggal_asesmen, usia=:usia, hasil_akhir=:hasil_akhir, catatan_akhir =:catatan_akhir
    WHERE
    id = :id";
    $stmt = $this->conn->prepare($query);

    $this->status=htmlspecialchars(strip_tags($this->status));
    $this->id_tipe=htmlspecialchars(strip_tags($this->id_tipe));
    $this->id_anak=htmlspecialchars(strip_tags($this->id_anak));
    $this->id_user=htmlspecialchars(strip_tags($this->id_user));
    $this->tanggal_asesmen=htmlspecialchars(strip_tags($this->tanggal_asesmen));
    $this->usia=htmlspecialchars(strip_tags($this->usia));
    $this->hasil_akhir=htmlspecialchars(strip_tags($this->hasil_akhir));
    $this->catatan_akhir =htmlspecialchars(strip_tags($this->catatan_akhir ));
    $this->id=htmlspecialchars(strip_tags($this->id));

    $stmt->bindParam(':status', $this->status);
    $stmt->bindParam(":id_tipe", $this->id_tipe);
    $stmt->bindParam(":id_anak", $this->id_anak);
    $stmt->bindParam(":id_user", $this->id_user);
    $stmt->bindParam(":tanggal_asesmen", $this->tanggal_asesmen);
    $stmt->bindParam(":usia", $this->usia);
    $stmt->bindParam(":hasil_akhir", $this->hasil_akhir);
    $stmt->bindParam(":catatan_akhir ", $this->catatan_akhir );
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
    $this->id_tipe = $row['id_tipe'];
    $this->id_anak = $row['id_anak'];
    $this->id_user = $row['id_user'];
    $this->tanggal_asesmen = $row['tanggal_asesmen'];
    $this->usia = $row['usia'];
    $this->hasil_akhir = $row['hasil_akhir'];
    $this->catatan_akhir  = $row['catatan_akhir '];

  }

  function readAnak(){
    $query = "SELECT asesmen.id_user,id_anak,anak.nama, count(id_anak) AS jumlah_asesmen
              FROM asesmen LEFT JOIN anak ON asesmen.id_anak = anak.id GROUP BY asesmen.id_anak HAVING id_user=?";
    $stmt = $this->conn->prepare($query);

    $this->id_user = htmlspecialchars(strip_tags($this->id_user));

    $stmt->bindParam(1, $this->id_user);
    $stmt->execute();

    return $stmt;
  }
  function readByUser(){
    $query = "SELECT asesmen.id as id_azezmen, asesmen.id_anak, asesmen.id_user, anak.nama, asesmen.id_tipe, tipe.tipe, asesmen.usia,asesmen.hasil_akhir,asesmen.catatan_akhir,
                  anak.tanggal_lahir, asesmen.tanggal_asesmen
              FROM asesmen INNER JOIN anak ON asesmen.id_anak = anak.id
              INNER JOIN tipe ON asesmen.id_tipe = tipe.id WHERE asesmen.id_user=? ORDER BY asesmen.tanggal_asesmen DESC";
    $stmt = $this->conn->prepare($query);

    $this->id_user = htmlspecialchars(strip_tags($this->id_user));

    $stmt->bindParam(1, $this->id_user);
    $stmt->execute();

    return $stmt;
  }

  function readNote(){
    $query = "SELECT asesmen.id, asesmen.catatan_akhir
              FROM asesmen WHERE asesmen.id=?";
    $stmt = $this->conn->prepare($query);

    $this->id = htmlspecialchars(strip_tags($this->id));

    $stmt->bindParam(1, $this->id);
    $stmt->execute();

    return $stmt;
  }

  function updateNote(){
    $query = "UPDATE asesmen SET catatan_akhir=? WHERE id=?";
    $stmt = $this->conn->prepare($query);

    // $this->catatan_akhir = htmlspecialchars(strip_tags($this->catatan_akhir));
    // $this->id = htmlspecialchars(strip_tags($this->id));
    //
    $stmt->bindParam(1, $this->catatan_akhir );
    $stmt->bindParam(2, $this->id);

    if($stmt->execute()){
      return true;
    }

    return false;
  }

  function createByMobile($tanggal_lahir){
    //TODO perbaiki ini napa kah kada mau bindParam
    $hari_ini = date("Y-m-d");
    $today = new DateTime();
    $biday = new DateTime($tanggal_lahir);
    $diff = $today->diff($biday);
    $this->usia = $diff->y." Tahun ".$diff->m." Bulan";
    $query = "INSERT INTO
    " . $this->nama_tabel . "
    SET
    status =:status, id_tipe=:id_tipe, id_anak=:id_anak, id_user=:id_user, tanggal_asesmen=:tanggal_asesmen, usia=:usia, hasil_akhir=:hasil_akhir, catatan_akhir =:catatan_akhir ";
    $query = "INSERT INTO asesmen SET status=1, id_anak=?, id_tipe=?, id_user=?, tanggal_asesmen=?, usia=?";
    $stmt = $this->conn->prepare($query);

    $this->id_tipe=htmlspecialchars(strip_tags($this->id_tipe));
    $this->id_anak=htmlspecialchars(strip_tags($this->id_anak));
    $this->id_user=htmlspecialchars(strip_tags($this->id_user));
    $this->tanggal_asesmen=htmlspecialchars(strip_tags($hari_ini));
    $this->usia=htmlspecialchars(strip_tags($this->usia));

    $stmt->bindParam(1, $this->id_anak);
    $stmt->bindParam(2, $this->id_tipe);
    $stmt->bindParam(3, $this->id_user);
    $stmt->bindParam(4, $this->tanggal_asesmen);
    $stmt->bindParam(5, $this->usia);


    if($stmt->execute()){
      return true;
    }

    return false;

  }

  function lastInsertedId(){
    return $this->conn->lastInsertId();
  }

}
?>
