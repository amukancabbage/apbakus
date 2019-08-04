<?php
include("../../0model/model_basic.php");
class Anak extends Model_Basic {
  public  $nama_tabel="anak";
  public $nama;
  public $jenis_kelamin;
  public $tanggal_lahir;
  public $nama_ortu;
  public $alamat;
  public $no_kontak;
  public $id_sekolah;
  public $id_pengguna;
  public $username;
  public $password;
  private  $basic_query="SELECT * FROM anak";
  public function __construct($db){
    $this->conn = $db;
  }

  function read(){
    $query = "SELECT * FROM " . $this->nama_tabel . " where id_pengguna=? ORDER BY id ASC ";
    $stmt = $this->conn->prepare($query);
    $this->id_pengguna=htmlspecialchars(strip_tags($this->id_pengguna));
    $stmt->bindParam(1, $this->id_pengguna);
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
    $query = $this->basic_query."  WHERE  nama LIKE ?  and id_pengguna = ? ORDER BY  nama";
    $stmt = $this->conn->prepare($query);

    $this->id_pengguna=htmlspecialchars(strip_tags($this->id_pengguna));
    $keywords=htmlspecialchars(strip_tags($keywords));
    $keywords = "%{$keywords}%";

    $stmt->bindParam(1, $keywords);
    $stmt->bindParam(2, $this->id_pengguna);
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

  public function lastId(){
    $query = "SELECT MAX(id) as last_id FROM " . $this->nama_tabel . "";

    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    return $row['last_id'];
  }

  function user_check(){
    $query = "SELECT * FROM " . $this->nama_tabel . " WHERE username = ?";
    $stmt = $this->conn->prepare($query);
    $this->username=htmlspecialchars(strip_tags($this->username));
    $stmt->bindParam(1, $this->username);
    $stmt->execute();
    return $stmt;
  }

  function create(){
    $query = "INSERT INTO
    " . $this->nama_tabel . "
    SET
    status =:status, nama=:nama, jenis_kelamin=:jenis_kelamin, tanggal_lahir=:tanggal_lahir, nama_ortu=:nama_ortu, alamat=:alamat, no_kontak=:no_kontak, id_sekolah=:id_sekolah, id_pengguna=:id_pengguna, username=:username, password=:password";
    $stmt = $this->conn->prepare($query);

    $this->status=htmlspecialchars(strip_tags($this->status));
    $this->nama=htmlspecialchars(strip_tags($this->nama));
    $this->jenis_kelamin=htmlspecialchars(strip_tags($this->jenis_kelamin));
    $this->tanggal_lahir=htmlspecialchars(strip_tags($this->tanggal_lahir));
    $this->nama_ortu=htmlspecialchars(strip_tags($this->nama_ortu));
    $this->alamat=htmlspecialchars(strip_tags($this->alamat));
    $this->no_kontak=htmlspecialchars(strip_tags($this->no_kontak));
    $this->id_sekolah=htmlspecialchars(strip_tags($this->id_sekolah));
    $this->id_pengguna=htmlspecialchars(strip_tags($this->id_pengguna));
    $this->username=htmlspecialchars(strip_tags($this->username));
    $this->password=htmlspecialchars(strip_tags($this->password));


    $stmt->bindParam(":status", $this->status);
    $stmt->bindParam(":nama", $this->nama);
    $stmt->bindParam(":jenis_kelamin", $this->jenis_kelamin);
    $stmt->bindParam(":tanggal_lahir", $this->tanggal_lahir);
    $stmt->bindParam(":nama_ortu", $this->nama_ortu);
    $stmt->bindParam(":alamat", $this->alamat);
    $stmt->bindParam(":no_kontak", $this->no_kontak);
    $stmt->bindParam(":id_sekolah", $this->id_sekolah);
    $stmt->bindParam(":id_pengguna", $this->id_pengguna);
    $stmt->bindParam(":username", $this->username);
    $stmt->bindParam(":password", $this->password);

    if($stmt->execute()){
      return true;
    }

    return false;

  }

  function update(){
    $query = "UPDATE " . $this->nama_tabel . "
    SET
    status = :status, nama=:nama, jenis_kelamin=:jenis_kelamin, tanggal_lahir=:tanggal_lahir, nama_ortu=:nama_ortu, alamat=:alamat, no_kontak=:no_kontak, id_sekolah=:id_sekolah, id_pengguna=:id_pengguna, username=:username, password=:password
    WHERE
    id = :id";
    $stmt = $this->conn->prepare($query);

    $this->status=htmlspecialchars(strip_tags($this->status));
    $this->nama=htmlspecialchars(strip_tags($this->nama));
    $this->jenis_kelamin=htmlspecialchars(strip_tags($this->jenis_kelamin));
    $this->tanggal_lahir=htmlspecialchars(strip_tags($this->tanggal_lahir));
    $this->nama_ortu=htmlspecialchars(strip_tags($this->nama_ortu));
    $this->alamat=htmlspecialchars(strip_tags($this->alamat));
    $this->no_kontak=htmlspecialchars(strip_tags($this->no_kontak));
    $this->id_sekolah=htmlspecialchars(strip_tags($this->id_sekolah));
    $this->id_pengguna=htmlspecialchars(strip_tags($this->id_pengguna));
    $this->username=htmlspecialchars(strip_tags($this->username));
    $this->password=htmlspecialchars(strip_tags($this->password));
    $this->id=htmlspecialchars(strip_tags($this->id));

    $stmt->bindParam(':status', $this->status);
    $stmt->bindParam(":nama", $this->nama);
    $stmt->bindParam(":jenis_kelamin", $this->jenis_kelamin);
    $stmt->bindParam(":tanggal_lahir", $this->tanggal_lahir);
    $stmt->bindParam(":nama_ortu", $this->nama_ortu);
    $stmt->bindParam(":alamat", $this->alamat);
    $stmt->bindParam(":no_kontak", $this->no_kontak);
    $stmt->bindParam(":id_sekolah", $this->id_sekolah);
    $stmt->bindParam(":id_pengguna", $this->id_pengguna);
    $stmt->bindParam(":username", $this->username);
    $stmt->bindParam(":password", $this->password);
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
    $this->nama = $row['nama'];
    $this->jenis_kelamin = $row['jenis_kelamin'];
    $this->tanggal_lahir = $row['tanggal_lahir'];
    $this->nama_ortu = $row['nama_ortu'];
    $this->alamat = $row['alamat'];
    $this->no_kontak = $row['no_kontak'];
    $this->id_sekolah = $row['id_sekolah'];
    $this->id_pengguna = $row['id_pengguna'];
    $this->username = $row['username'];
    $this->password = $row['password'];

  }

  function createByMobile(){
    $query = "INSERT INTO
    " . $this->nama_tabel . "
    SET
    status =:status, nama=:nama, jenis_kelamin=:jenis_kelamin, tanggal_lahir=:tanggal_lahir, nama_ortu=:nama_ortu, alamat=:alamat, no_kontak=:no_kontak, id_sekolah=:id_sekolah, id_pengguna=:id_pengguna, username=:username, password=:password";
    $stmt = $this->conn->prepare($query);

    $this->status=htmlspecialchars(strip_tags($this->status));
    $this->nama=htmlspecialchars(strip_tags($this->nama));
    $this->jenis_kelamin=htmlspecialchars(strip_tags($this->jenis_kelamin));
    $this->tanggal_lahir=htmlspecialchars(strip_tags($this->tanggal_lahir));
    $this->nama_ortu=htmlspecialchars(strip_tags($this->nama_ortu));
    $this->alamat=htmlspecialchars(strip_tags($this->alamat));
    $this->no_kontak=htmlspecialchars(strip_tags($this->no_kontak));
    $this->id_sekolah=htmlspecialchars(strip_tags($this->id_sekolah));
    $this->id_pengguna=htmlspecialchars(strip_tags($this->id_pengguna));
    $this->username=htmlspecialchars(strip_tags($this->username));
    $this->password=htmlspecialchars(strip_tags($this->password));


    $stmt->bindParam(":status", $this->status);
    $stmt->bindParam(":nama", $this->nama);
    $stmt->bindParam(":jenis_kelamin", $this->jenis_kelamin);
    $stmt->bindParam(":tanggal_lahir", $this->tanggal_lahir);
    $stmt->bindParam(":nama_ortu", $this->nama_ortu);
    $stmt->bindParam(":alamat", $this->alamat);
    $stmt->bindParam(":no_kontak", $this->no_kontak);
    $stmt->bindParam(":id_sekolah", $this->id_sekolah);
    $stmt->bindParam(":id_pengguna", $this->id_pengguna);
    $stmt->bindParam(":username", $this->username);
    $stmt->bindParam(":password", $this->password);

    if($stmt->execute()){
      return true;
    }

    return false;

  }


}
?>
