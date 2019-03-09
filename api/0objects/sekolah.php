<?php
  include("../../0model/model_basic.php");
  class Sekolah extends Model_Basic {
    public  $nama_tabel="sekolah"; 
public $nama_sekolah;
public $alamat;
public $kontak;
    private  $basic_query="SELECT * FROM sekolah";
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
      status =:status, nama_sekolah=:nama_sekolah, alamat=:alamat, kontak=:kontak";
      $stmt = $this->conn->prepare($query);

      $this->status=htmlspecialchars(strip_tags($this->status));
       $this->nama_sekolah=htmlspecialchars(strip_tags($this->nama_sekolah)); 
 $this->alamat=htmlspecialchars(strip_tags($this->alamat)); 
 $this->kontak=htmlspecialchars(strip_tags($this->kontak)); 


      $stmt->bindParam(":status", $this->status);
      $stmt->bindParam(":nama_sekolah", $this->nama_sekolah); 
$stmt->bindParam(":alamat", $this->alamat); 
$stmt->bindParam(":kontak", $this->kontak); 

      if($stmt->execute()){
        return true;
      }

      return false;

    }

function update(){
      $query = "UPDATE " . $this->nama_tabel . "
      SET
      status = :status, nama_sekolah=:nama_sekolah, alamat=:alamat, kontak=:kontak
      WHERE
      id = :id";
      $stmt = $this->conn->prepare($query);

      $this->status=htmlspecialchars(strip_tags($this->status));
       $this->nama_sekolah=htmlspecialchars(strip_tags($this->nama_sekolah)); 
 $this->alamat=htmlspecialchars(strip_tags($this->alamat)); 
 $this->kontak=htmlspecialchars(strip_tags($this->kontak)); 
 $this->id=htmlspecialchars(strip_tags($this->id));

      $stmt->bindParam(':status', $this->status);
      $stmt->bindParam(":nama_sekolah", $this->nama_sekolah); 
$stmt->bindParam(":alamat", $this->alamat); 
$stmt->bindParam(":kontak", $this->kontak); 
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
      $this->nama_sekolah = $row['nama_sekolah'];
$this->alamat = $row['alamat'];
$this->kontak = $row['kontak'];

    } 


 }
?>