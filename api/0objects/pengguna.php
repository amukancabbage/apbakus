<?php
include("../../0model/model_basic.php");
class Pengguna extends Model_Basic {
  public  $nama_tabel="pengguna";
  public $nama_user;
  public $user_password;
  public $nama_lengkap;
  public $no_kontak;
  public $level;
  public $avatar;
  public $com_code;
  public $forgot;
  private  $basic_query="SELECT * FROM pengguna";
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
    status =:status, nama_user=:nama_user, user_password=:user_password, nama_lengkap=:nama_lengkap, no_kontak=:no_kontak, level=:level, avatar=:avatar, com_code=:com_code, forgot=:forgot";
    $stmt = $this->conn->prepare($query);

    $this->status=htmlspecialchars(strip_tags($this->status));
    $this->nama_user=htmlspecialchars(strip_tags($this->nama_user));
    $this->user_password=htmlspecialchars(strip_tags($this->user_password));
    $this->nama_lengkap=htmlspecialchars(strip_tags($this->nama_lengkap));
    $this->no_kontak=htmlspecialchars(strip_tags($this->no_kontak));
    $this->level=htmlspecialchars(strip_tags($this->level));
    $this->avatar=htmlspecialchars(strip_tags($this->avatar));
    $this->com_code=htmlspecialchars(strip_tags($this->com_code));
    $this->forgot=htmlspecialchars(strip_tags($this->forgot));


    $stmt->bindParam(":status", $this->status);
    $stmt->bindParam(":nama_user", $this->nama_user);
    $stmt->bindParam(":user_password", $this->user_password);
    $stmt->bindParam(":nama_lengkap", $this->nama_lengkap);
    $stmt->bindParam(":no_kontak", $this->no_kontak);
    $stmt->bindParam(":level", $this->level);
    $stmt->bindParam(":avatar", $this->avatar);
    $stmt->bindParam(":com_code", $this->com_code);
    $stmt->bindParam(":forgot", $this->forgot);

    if($stmt->execute()){
      return true;
    }

    return false;

  }

  function lastInsertedId(){
    return $this->conn->lastInsertId();
  }

  function email_check(){
    $query = "SELECT * FROM " . $this->nama_tabel . " WHERE nama_user = ?";
    $stmt = $this->conn->prepare($query);
    $this->nama_user=htmlspecialchars(strip_tags($this->nama_user));
    $stmt->bindParam(1, $this->nama_user);
    $stmt->execute();
    return $stmt;
  }

  function confirm_check(){
    $query = "SELECT * FROM " . $this->nama_tabel . " WHERE nama_user = ? AND com_code = ?";
    $stmt = $this->conn->prepare($query);
    $this->nama_user=htmlspecialchars(strip_tags($this->nama_user));
    $this->com_code=htmlspecialchars(strip_tags($this->com_code));
    $stmt->bindParam(1, $this->nama_user);
    $stmt->bindParam(2, $this->com_code);
    $stmt->execute();
    return $stmt;
  }

  function confirm(){
    $query = "UPDATE " . $this->nama_tabel . " SET com_code=NULL, status=2 WHERE com_code=? AND nama_user=?";
    $stmt = $this->conn->prepare($query);

    $this->nama_user=htmlspecialchars(strip_tags($this->nama_user));
    $this->com_code=htmlspecialchars(strip_tags($this->com_code));

    $stmt->bindParam(2, $this->nama_user);
    $stmt->bindParam(1, $this->com_code);

    if($stmt->execute()){
      return true;
    }

    return false;
  }

  function update(){
    $query = "UPDATE " . $this->nama_tabel . "
    SET
    status = :status, nama_user=:nama_user, user_password=:user_password, nama_lengkap=:nama_lengkap, no_kontak=:no_kontak, level=:level, avatar=:avatar, com_code=:com_code, forgot=:forgot
    WHERE
    id = :id";
    $stmt = $this->conn->prepare($query);

    $this->status=htmlspecialchars(strip_tags($this->status));
    $this->nama_user=htmlspecialchars(strip_tags($this->nama_user));
    $this->user_password=htmlspecialchars(strip_tags($this->user_password));
    $this->nama_lengkap=htmlspecialchars(strip_tags($this->nama_lengkap));
    $this->no_kontak=htmlspecialchars(strip_tags($this->no_kontak));
    $this->level=htmlspecialchars(strip_tags($this->level));
    $this->avatar=htmlspecialchars(strip_tags($this->avatar));
    $this->com_code=htmlspecialchars(strip_tags($this->com_code));
    $this->forgot=htmlspecialchars(strip_tags($this->forgot));
    $this->id=htmlspecialchars(strip_tags($this->id));

    $stmt->bindParam(':status', $this->status);
    $stmt->bindParam(":nama_user", $this->nama_user);
    $stmt->bindParam(":user_password", $this->user_password);
    $stmt->bindParam(":nama_lengkap", $this->nama_lengkap);
    $stmt->bindParam(":no_kontak", $this->no_kontak);
    $stmt->bindParam(":level", $this->level);
    $stmt->bindParam(":avatar", $this->avatar);
    $stmt->bindParam(":com_code", $this->com_code);
    $stmt->bindParam(":forgot", $this->forgot);
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
    $this->nama_user = $row['nama_user'];
    $this->user_password = $row['user_password'];
    $this->nama_lengkap = $row['nama_lengkap'];
    $this->no_kontak = $row['no_kontak'];
    $this->level = $row['level'];
    $this->avatar = $row['avatar'];
    $this->com_code = $row['com_code'];
    $this->forgot = $row['forgot'];
  }


}
?>
