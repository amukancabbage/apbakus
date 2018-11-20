<?php
$isi_teks_fungsi_delete = "  function delete(){
  \$query = \"DELETE FROM \" . \$this->table_name . \" WHERE id = ?\";
  \$stmt = \$this->conn->prepare(\$query);
  \$this->id=htmlspecialchars(strip_tags(\$this->id));
  \$stmt->bindParam(1, \$this->id);
  if(\$stmt->execute()){
    return true;
  }
  return false;

}\n";

$isi_teks_fungsi_search = "function search(\$keywords){
  \$query = \$basic_query.\"  WHERE  butir LIKE ?  ORDER BY  butir\";
  \$stmt = \$this->conn->prepare(\$query);

  \$keywords=htmlspecialchars(strip_tags(\$keywords));
  \$keywords = \"%{\$keywords}%\";

  \$stmt->bindParam(1, \$keywords);
  \$stmt->execute();

  return \$stmt;
}";
$isi_teks_fungsi_count = "public function count(){
  \$query = \"SELECT COUNT(id) as total_rows FROM \" . \$this->table_name . \"\";

  \$stmt = \$this->conn->prepare( \$query );
  \$stmt->execute();
  \$row = \$stmt->fetch(PDO::FETCH_ASSOC);

  return \$row['total_rows'];
}";


 ?>
