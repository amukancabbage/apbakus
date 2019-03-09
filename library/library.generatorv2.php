<?php
function get_nama_kolom($decoded_json){
  $i = 4;
  $result[] = array();
  $result[0] = "id";
  $result[1] = "created_at";
  $result[2] = "updated_at";
  $result[3] = "status";
  foreach ($decoded_json->kolom as $item) {
    $result[$i] = $item->nama_kolom;
    $i++;
  }
  return $result;
}

function get_nama_kolom_konteks($decoded_json){
  $i = 0;
  $result[] = array();
  foreach ($decoded_json->kolom as $item) {
    $result[$i] = $item->nama_kolom;
    $i++;
  }
  return $result;
}

function buat_read(){
  buat_fungsi_read();
  buat_file_read();
}

function buat_fungsi_read(){

}

function buat_file_read($nama_tabel, $nama_koloms){
  $jumlah_kolom = count($nama_koloms);
  $var_array = ambil_var_array($jumlah_kolom,$nama_koloms);
  $i = 0;
  if(file_exists ("api/".$nama_tabel."/read.php"))
  unlink("api/".$nama_tabel."/read.php");
  $myfile = fopen("api/".$nama_tabel."/read.php", "w") or die("Unable to open file!");
  fwrite($myfile, " <?php
  header(\"Access-Control-Allow-Origin: *\");
  header(\"Content-Type: application/json; charset=UTF-8\");

  include_once '../config/database.php';
  include_once '../0objects/$nama_tabel.php';

  \$database = new Database();
  \$db = \$database->getConnection();

  \$$nama_tabel = new ".ucwords($nama_tabel)."(\$db);

  \$stmt = \$".$nama_tabel."->read();
  \$num = \$stmt->rowCount();

  if(\$num>0){
    \$".$nama_tabel."s_arr=array();
    \$".$nama_tabel."s_arr[\"records\"]=array();

    while (\$row = \$stmt->fetch(PDO::FETCH_ASSOC)){
      extract(\$row);
      \$".$nama_tabel."_item=array( \n".$var_array.");

      array_push(\$".$nama_tabel."s_arr[\"records\"], \$".$nama_tabel."_item);
    }

    http_response_code(200);
    echo json_encode(\$".$nama_tabel."s_arr);
  }

  else{

    http_response_code(404);
    echo json_encode(
      array(\"message\" => \"data masih kosong.\")
    );
  }
  ?>");
  fclose($myfile);
}

function buat_file_create($nama_tabel, $nama_koloms){
  $jumlah_kolom = count($nama_koloms);
  $i = 0;
  if(file_exists ("api/".$nama_tabel."/create.php"))
  unlink("api/".$nama_tabel."/create.php");
  $myfile = fopen("api/".$nama_tabel."/create.php", "w") or die("Unable to open file!");
  fwrite($myfile, " <?php
  header(\"Access-Control-Allow-Origin: *\");
  header(\"Content-Type: application/json; charset=UTF-8\");
  header(\"Access-Control-Allow-Methods: POST\");
  header(\"Access-Control-Max-Age: 3600\");
  header(\"Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With\");

  include_once '../config/database.php';
  include_once '../0objects/$nama_tabel.php';

  \$database = new Database();
  \$db = \$database->getConnection();

  \$$nama_tabel = new ".ucwords($nama_tabel)."(\$db);
  \$data = json_decode(file_get_contents(\"php://input\"));

  if(
    !empty(\$data->status) ".ambil_var_cek_kosong($jumlah_kolom,$nama_koloms)."
  ){

    \$".$nama_tabel."->status = \$data->status; ".ambil_var_json($nama_tabel,$jumlah_kolom,$nama_koloms)."

    if(\$".$nama_tabel."->create()){
      http_response_code(201);
      echo json_encode(array(\"message\" => \"".ucwords($nama_tabel)." berhasil disimpan.\"));
    }
    else{
      http_response_code(503);
      echo json_encode(array(\"message\" => \"".ucwords($nama_tabel)." gagal disimpan\"));
    }
  }else{

    http_response_code(400);
    echo json_encode(array(\"message\" => \"Lengkapi Data ".ucwords($nama_tabel)."\"));
  } ?>");
  fclose($myfile);
}

function buat_file_update($nama_tabel, $nama_koloms){
  $jumlah_kolom = count($nama_koloms);
  $i = 0;
  if(file_exists ("api/".$nama_tabel."/update.php"))
  unlink("api/".$nama_tabel."/update.php");
  $myfile = fopen("api/".$nama_tabel."/update.php", "w") or die("Unable to open file!");
  fwrite($myfile, " <?php header(\"Access-Control-Allow-Origin: *\");
  header(\"Content-Type: application/json; charset=UTF-8\");
  header(\"Access-Control-Allow-Methods: POST\");
  header(\"Access-Control-Max-Age: 3600\");
  header(\"Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With\");

  include_once '../config/database.php';
  include_once '../0objects/".$nama_tabel.".php';

  \$database = new Database();
  \$db = \$database->getConnection();
  \$".$nama_tabel." = new ".ucwords($nama_tabel)."(\$db);

  \$data = json_decode(file_get_contents(\"php://input\"));
  \$".$nama_tabel."->id = \$data->id;
  \$".$nama_tabel."->status = \$data->status;".ambil_var_json($nama_tabel,$jumlah_kolom,$nama_koloms)."

  if(\$".$nama_tabel."->update()){
    http_response_code(200);
    // echo json_encode(array(\"message\" => \"".ucwords($nama_tabel)." Sudah Diubah.\"));
  }else{
    http_response_code(503);
    // echo json_encode(array(\"message\" => \"".ucwords($nama_tabel)." GAGAL Diubah.\"));
  }\n?>");
  fclose($myfile);
}

function buat_file_delete($nama_tabel, $nama_koloms){
  $jumlah_kolom = count($nama_koloms);
  $i = 0;
  if(file_exists ("api/".$nama_tabel."/delete.php"))
  unlink("api/".$nama_tabel."/delete.php");
  $myfile = fopen("api/".$nama_tabel."/delete.php", "w") or die("Unable to open file!");
  fwrite($myfile, " <?php \nheader(\"Access-Control-Allow-Origin: *\");
  header(\"Content-Type: application/json; charset=UTF-8\");
  header(\"Access-Control-Allow-Methods: POST\");
  header(\"Access-Control-Max-Age: 3600\");
  header(\"Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With\");

  include_once '../config/database.php';
  include_once '../0objects/".$nama_tabel.".php';

  \$database = new Database();
  \$db = \$database->getConnection();
  \$".$nama_tabel." = new ".ucwords($nama_tabel)."(\$db);
  \$data = json_decode(file_get_contents(\"php://input\"));
  \$".$nama_tabel."->id = \$data->id;

  if(\$".$nama_tabel."->delete()){

    http_response_code(200);
    echo json_encode(array(\"message\" => \"".ucwords($nama_tabel)." sudah dihapus.\"));
  }else{
    http_response_code(503);
    echo json_encode(array(\"message\" => \"".ucwords($nama_tabel)." GAGAL dihapus.\"));
  } ?>");
  fclose($myfile);
}

function buat_file_read_one($nama_tabel, $nama_koloms){
  $jumlah_kolom = count($nama_koloms);
  $i = 0;
  if(file_exists ("api/".$nama_tabel."/read_one.php"))
  unlink("api/".$nama_tabel."/read_one.php");
  $myfile = fopen("api/".$nama_tabel."/read_one.php", "w") or die("Unable to open file!");
  fwrite($myfile, " <?php \n
  header(\"Access-Control-Allow-Origin: *\");
  header(\"Access-Control-Allow-Headers: access\");
  header(\"Access-Control-Allow-Methods: GET\");
  header(\"Access-Control-Allow-Credentials: true\");
  header('Content-Type: application/json');

  include_once '../config/database.php';
  include_once '../0objects/".$nama_tabel.".php';

  \$database = new Database();
  \$db = \$database->getConnection();

  \$".$nama_tabel." = new ".ucwords($nama_tabel)."(\$db);

  \$".$nama_tabel."->id = isset(\$_GET['id']) ? \$_GET['id'] : die();
  \$".$nama_tabel."->readOne();

  if(\$".$nama_tabel."->".$nama_koloms[4]."!=null){

      \$".$nama_tabel."_arr = array(
          \"id\" => \$".$nama_tabel."->id".ambil_var_read_one($nama_tabel,$jumlah_kolom,$nama_koloms)."
      );

      http_response_code(200);
      echo json_encode(\$".$nama_tabel."_arr);
  }

  else{
      http_response_code(404);
      echo json_encode(array(\"message\" => \"".ucwords($nama_tabel)." tidak ditemukan\"));
  }
 ?>");
  fclose($myfile);
}

function json_to_create_query($decoded_json){
  $result = "CREATE TABLE ".$decoded_json->nama_tabel." ( \r   `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL ";
  foreach ($decoded_json->kolom as $item) {
    $result = $result.", \r `".$item->nama_kolom."`  ".$item->tipe_kolom;
  }

  return $result." , PRIMARY KEY (`id`) \r) ENGINE = InnoDB;";
}

function buat_model($nama_tabel,$nama_koloms){
  $folder_model = "api/0objects";
  $folder_output = "api/".$nama_tabel;
  $jumlah_kolom = count($nama_koloms);

  if (!file_exists($folder_output)) {
    mkdir($folder_output, 0777, true);
  }

  if(file_exists ($folder_model."/".$nama_tabel.".php"))
  unlink($folder_model."/".$nama_tabel.".php");
  $myfile = fopen($folder_model."/".$nama_tabel.".php", "w") or die("Unable to open file!");

  fwrite($myfile, "<?php
  include(\"../../0model/model_basic.php\");
  class ".ucwords($nama_tabel)." extends Model_Basic {
    public  \$nama_tabel=\"".$nama_tabel."\"; ".ambil_var_atribut($jumlah_kolom,$nama_koloms)."
    private  \$basic_query=\"SELECT * FROM $nama_tabel\";
    public function __construct(\$db){
      \$this->conn = \$db;
    } \n\n");

    fwrite($myfile, ambil_isi_teks_fungsi_read());
    fwrite($myfile, ambil_isi_teks_fungsi_delete());
    fwrite($myfile, ambil_isi_teks_fungsi_search());
    fwrite($myfile, ambil_isi_teks_fungsi_count());
    fwrite($myfile, ambil_isi_teks_fungsi_create($jumlah_kolom,$nama_koloms));
    fwrite($myfile, ambil_isi_teks_fungsi_update($jumlah_kolom,$nama_koloms));
    fwrite($myfile, ambil_isi_teks_fungsi_read_one($jumlah_kolom,$nama_koloms));

    fwrite($myfile, "\n }\n?>");

    fclose($myfile);

    buat_file_create($nama_tabel, $nama_koloms);
    buat_file_read($nama_tabel, $nama_koloms);
    buat_file_update($nama_tabel, $nama_koloms);
    buat_file_delete($nama_tabel, $nama_koloms);
    buat_file_read_one($nama_tabel, $nama_koloms);
  }


  function ambil_isi_teks_fungsi_read(){
    return "  function read(){
      \$query = \"SELECT * FROM \" . \$this->nama_tabel . \" ORDER BY id ASC\";
      \$stmt = \$this->conn->prepare(\$query);
      \$stmt->execute();
      return \$stmt;
    } \n\n";
  }

  function ambil_isi_teks_fungsi_delete(){
    return "  function delete(){
      \$query = \"DELETE FROM \" . \$this->nama_tabel . \" WHERE id = ?\";
      \$stmt = \$this->conn->prepare(\$query);
      \$this->id=htmlspecialchars(strip_tags(\$this->id));
      \$stmt->bindParam(1, \$this->id);
      if(\$stmt->execute()){
        return true;
      }
      return false;

    }\n";
  }

  function ambil_isi_teks_fungsi_search(){
    return "function search(\$keywords){
      \$query = \$this->basic_query.\"  WHERE  butir LIKE ?  ORDER BY  butir\";
      \$stmt = \$this->conn->prepare(\$query);

      \$keywords=htmlspecialchars(strip_tags(\$keywords));
      \$keywords = \"%{\$keywords}%\";

      \$stmt->bindParam(1, \$keywords);
      \$stmt->execute();

      return \$stmt;
    }\n\n";
  }

  function ambil_isi_teks_fungsi_count(){
    return "public function count(){
      \$query = \"SELECT COUNT(id) as total_rows FROM \" . \$this->nama_tabel . \"\";

      \$stmt = \$this->conn->prepare( \$query );
      \$stmt->execute();
      \$row = \$stmt->fetch(PDO::FETCH_ASSOC);

      return \$row['total_rows'];
    }\n\n";
  }

  function ambil_isi_teks_fungsi_create($jumlah_kolom,$nama_koloms){
    $var_set = ambil_var_set($jumlah_kolom,$nama_koloms);
    $var_special_char = ambil_var_special_char($jumlah_kolom,$nama_koloms);
    $var_bind_param = ambil_var_bind_param($jumlah_kolom,$nama_koloms);

    return "function create(){
      \$query = \"INSERT INTO
      \" . \$this->nama_tabel . \"
      SET
      status =:status".$var_set."\";
      \$stmt = \$this->conn->prepare(\$query);

      \$this->status=htmlspecialchars(strip_tags(\$this->status));
      ".$var_special_char."

      \$stmt->bindParam(\":status\", \$this->status);
      ".$var_bind_param."
      if(\$stmt->execute()){
        return true;
      }

      return false;

    }\n\n";
  }



  function ambil_isi_teks_fungsi_update($jumlah_kolom,$nama_koloms){
    $var_set = ambil_var_set($jumlah_kolom,$nama_koloms);
    $var_special_char = ambil_var_special_char($jumlah_kolom,$nama_koloms);
    $var_bind_param = ambil_var_bind_param($jumlah_kolom,$nama_koloms);
    return "function update(){
      \$query = \"UPDATE \" . \$this->nama_tabel . \"
      SET
      status = :status".$var_set."
      WHERE
      id = :id\";
      \$stmt = \$this->conn->prepare(\$query);

      \$this->status=htmlspecialchars(strip_tags(\$this->status));
      ".$var_special_char." \$this->id=htmlspecialchars(strip_tags(\$this->id));

      \$stmt->bindParam(':status', \$this->status);
      ".$var_bind_param." \$stmt->bindParam(':id', \$this->id);

      if(\$stmt->execute()){
        return true;
      }

      return false;
    }\n\n";
  }

  function ambil_isi_teks_fungsi_read_one($jumlah_kolom,$nama_koloms){
    $var_this_row = ambil_var_this_row($jumlah_kolom,$nama_koloms);
    return "function readOne(){
      \$query = \$this->basic_query.\"  WHERE id = ?  LIMIT 0,1\";
      \$stmt = \$this->conn->prepare( \$query );
      \$stmt->bindParam(1, \$this->id);
      \$stmt->execute();

      \$row = \$stmt->fetch(PDO::FETCH_ASSOC);

      \$this->id = \$row['id'];
      ".$var_this_row."
    } \n\n";
  }


  function ambil_var_read_one($nama_tabel,$jumlah_kolom,$nama_koloms){
    $var_atribut = "";
    $i = 4;
    while ($i<$jumlah_kolom) {
      $var_atribut = $var_atribut.",\n\"".$nama_koloms[$i]."\" => \$".$nama_tabel."->".$nama_koloms[$i];
      $i++;
    }
    return $var_atribut;
  }

  function ambil_var_atribut($jumlah_kolom,$nama_koloms){
    $var_atribut = "";
    $i = 4;
    while ($i<$jumlah_kolom) {
      $var_atribut = $var_atribut."\npublic \$$nama_koloms[$i];";
      $i++;
    }
    return $var_atribut;
  }
  function ambil_var_cek_kosong($jumlah_kolom,$nama_koloms){
    $var_cek_kosong = "";
    $i = 4;
    while ($i<$jumlah_kolom) {
      $var_cek_kosong = $var_cek_kosong." & \n!empty(\$data->$nama_koloms[$i])";
      $i++;
    }
    return $var_cek_kosong;
  }

  function ambil_var_json($nama_tabel,$jumlah_kolom,$nama_koloms){
    $var_json = "";
    $i = 4;
    while ($i<$jumlah_kolom) {
      $var_json = $var_json."\n\$".$nama_tabel."->$nama_koloms[$i] = \$data->$nama_koloms[$i];";
      $i++;
    }
    return $var_json;
  }


  function ambil_var_array($jumlah_kolom,$nama_koloms){
    $var_array = "";
    $i=0;
    while($i<$jumlah_kolom){
      if($i==0)
      $var_array = "\"$nama_koloms[$i]\" => \$$nama_koloms[$i]";
      else
      $var_array = $var_array.", \n \"$nama_koloms[$i]\" => \$$nama_koloms[$i]";
      $i++;
    }
    return $var_array;
  }
  function ambil_var_set($jumlah_kolom,$nama_koloms){
    $var_set = "";
    $i = 4;
    while ($i<$jumlah_kolom) {
      $var_set = $var_set.", ".$nama_koloms[$i]."=:".$nama_koloms[$i];
      $i++;
    }
    return $var_set;
  }

  function ambil_var_special_char($jumlah_kolom,$nama_koloms){
    $var_special_char = "";
    $i=4;
    while ($i<$jumlah_kolom) {
      $var_special_char = $var_special_char." \$this->".$nama_koloms[$i]."=htmlspecialchars(strip_tags(\$this->".$nama_koloms[$i].")); \n";
      $i++;
    }
    return $var_special_char;
  }

  function ambil_var_bind_param($jumlah_kolom,$nama_koloms){
    $var_bind_param = "";
    $i=4;
    while ($i<$jumlah_kolom) {
      $var_bind_param =  $var_bind_param."\$stmt->bindParam(\":".$nama_koloms[$i]."\", \$this->".$nama_koloms[$i]."); \n";
      $i++;
    }
    return $var_bind_param;
  }

  function ambil_var_this_row($jumlah_kolom,$nama_koloms){
    $var_this_row = "";
    $i=4;
    while ($i<$jumlah_kolom) {
      $var_this_row =  $var_this_row."\$this->".$nama_koloms[$i]." = \$row['".$nama_koloms[$i]."'];\n";
      $i++;
    }
    return $var_this_row;
  }


  ?>
